<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use common\models\Energy;
use common\models\Coat;
use common\models\Size;
use common\models\Breed;
use common\models\BreedEnergy;
use common\models\BreedCoat;
use common\models\BreedSize;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['index', 'profile', 'breed'],
                        'allow' => true,
                        'roles' => ['kennel']
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;

        if ($exception !== null) {
            $statusCode = $exception->statusCode;
            $name = $exception->getName();
            $message = $exception->getMessage();


            return $this->render('error', [
                'exception' => $exception,
                'statusCode' => $statusCode,
                'name' => $name,
                'message' => $message,
                'preurl' => Yii::$app->request->referrer
            ]);
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $profileKennel = User::findIdentity(Yii::$app->user->id)->kennel;

        $kennelAnimals = array_slice($profileKennel->kennelAnimals, 0, 10);

        //$this->layout = 'blank';

        return $this->render('index', [
            'kennelAnimals' => $kennelAnimals
        ]);
    }



    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) return $this->goHome();
        
        /* Initalize Login Form */
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionProfile()
    {
        $user = Yii::$app->user->identity;
        $profile = $user->kennel;
        $nAnimais = count($profile->kennelAnimals);
        $nAdocoes = 0;

        return $this->render('profile', [
            'profileInfo' => $profile,
            'nAnimais' => $nAnimais,
            'nAdocoes' => $nAdocoes,
            'user' => $user,
        ]);
    }


    public function actionChangePassword()
    {
        $user = Yii::$app->user->identity;
        $loadPost = $user->load(Yii::$app->request->post());
        $valid = $model->validate();

        if ($loadPost && $user->validate()) {
            $user->password = md5($user->new_password);

            if ($user->save()) $this->redirect(['profile']);
            else $this->redirect(['profile']);
        } else $this->redirect(['profile']);

    }

    public function actionBreed()
    {
        $msg = '';
        $energy = Energy::find()->asArray()->all();
        $coat = Coat::find()->asArray()->all();
        $size = Size::find()->asArray()->all();
        $breed = Breed::find()->where(['id_parent' => null])->asArray()->all();

        $modelBreed = new Breed();
        $modelBreedEnergy = new BreedEnergy();
        $modelBreedCoat = new BreedCoat();
        $modelBreedSize = new BreedSize();


        if (Yii::$app->request->post() != null) {
            if ($modelBreed->load(Yii::$app->request->post())) {
                $modelBreed->id_parent = (Yii::$app->request->post('Breed')['id_parent'] == null) ? null : Yii::$app->request->post('Breed')['id_parent'];
                $valid = $modelBreed->save();

                $id_breed = $modelBreed->id;

                if ($valid) {
                    if (Yii::$app->request->post('BreedEnergy')['id_energy'] != null) {
                        foreach (Yii::$app->request->post('BreedEnergy')['id_energy'] as $id_energy) {
                            $breedEnergy = new BreedEnergy();
                            $breedEnergy->id_energy = $id_energy;
                            $breedEnergy->id_breed = $id_breed;

                            $valid = $breedEnergy->save() && $valid;
                        }
                    }
                    if (Yii::$app->request->post('BreedCoat')['id_coat'] != null) {
                        foreach (Yii::$app->request->post('BreedCoat')['id_coat'] as $id_coat) {
                            $breedCoat = new BreedCoat();
                            $breedCoat->id_coat = $id_coat;
                            $breedCoat->id_breed = $id_breed;

                            $valid = $breedCoat->save() && $valid;
                        }
                    }
                    if (Yii::$app->request->post('BreedSize')['id_size'] != null) {
                        foreach (Yii::$app->request->post('BreedSize')['id_size'] as $id_size) {
                            $breedSize = new BreedSize();
                            $breedSize->id_size = $id_size;
                            $breedSize->id_breed = $id_breed;

                            $valid = $breedSize->save() && $valid;
                        }
                    }

                    if ($valid) {
                        $msg = $breed.' Inserted with Success';
                    }
                }
            }
        }

        return $this->render('breed', [
            'msg' => $msg,
            'energy' => $energy,
            'coat' => $coat,
            'size' => $size,
            'breed' => $breed,
            'modelBreed' => $modelBreed,
            'modelEnergy' => $modelBreedEnergy,
            'modelCoat' => $modelBreedCoat,
            'modelSize' => $modelBreedSize
        ]);
    }



    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}

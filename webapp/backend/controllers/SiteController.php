<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
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
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'profile'],
                        'allow' => true,
                        'roles' => ['kennel'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@']
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
        $perfil = User::findIdentity(Yii::$app->user->id)->profile;

        $canilAnimals = array_slice($perfil->canilAnimals, 0, 10);

        return $this->render('index', [
            'canilAnimals' => $canilAnimals
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
        $profile = Yii::$app->user->identity->profile;
        $nAnimais = count($profile->canilAnimals);
        $nAdocoes = count($profile->adocaos);
        $user = Yii::$app->user->identity;

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

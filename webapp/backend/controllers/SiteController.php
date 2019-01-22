<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/* Common Models */
use common\models\LoginForm;
use common\models\User;
use common\models\Energy;
use common\models\Coat;
use common\models\Size;
use common\models\Breed;
use common\models\BreedEnergy;
use common\models\BreedCoat;
use common\models\BreedSize;
use backend\models\ScheduleForm;

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
        // $profileKennel = User::findIdentity(Yii::$app->user->id)->kennel;

        // $kennelAnimals = array_slice($profileKennel->kennelAnimals, 0, 10);

        //$this->layout = 'blank';
        return $this->render('index', [
            'kennelAnimals' => null
        ]);
    }


/* User Related Actions */

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
            if (!Yii::$app->user->can('kennel')) Yii::$app->user->logout();
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
        $schedules = $profile->schedules;

        $result = [];

        $model_schedule = new ScheduleForm();

        foreach ($schedules as $value) {
            $model_schedule->days_week[] = '' . $value->day;
            $model_schedule->hours['open'] = $value->open_time;
            $model_schedule->hours['close'] = $value->close_time;
            $model_schedule->hours_lunch['open'] = $value->lunch_open;
            $model_schedule->hours_lunch['close'] = $value->lunch_close;
            if ($model_schedule->hours_lunch['open']) $model_schedule->has_lunch = 1;
        }

        /* Schedule */
        if ($model_schedule->load(Yii::$app->request->post())) {
            $model_schedule->id_kennel = $profile->id;
            $result = $model_schedule->saveSchedule();
            if (array_key_exists("success", $result)) {
                return $this->redirect(['site/profile']);
            }
        }

        $nAnimais = count($profile->kennelAnimals);
        $nAdocoes = 0;

        return $this->render('profile', [
            'profile' => $profile,
            'nAnimais' => $nAnimais,
            'nAdocoes' => $nAdocoes,
            'schedules' => $schedules,
            'model_schedule' => $model_schedule,
            'result' => $result
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

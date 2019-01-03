<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

use common\models\LoginForm;
use common\models\Local;

use frontend\models\SignupForm;
use frontend\models\Adopter;
use frontend\models\Kennel;


class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['authentication', 'registration', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['authentication', 'registration'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
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

    public function actionAuthentication()
    {
        if (!Yii::$app->user->isGuest) return $this->goHome();

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) return $this->goBack();

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);

    }

    public function actionRegistration($check)
    {
        if (!Yii::$app->user->isGuest) return $this->goHome();

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_type = $check;
            if ($user = $model->signup()) return $this->redirect(["user/authentication"]);
        }
        
        //Check its User (0) Or Kennel (1)
        if ($check == SignupForm::SELF_ADOPTER) {
            return $this->render('signupAdopter', [
                'model' => $model,
            ]);
        } else {
            if ($check == SignupForm::SELF_KENNEL) {
                $mainLocals = Local::find()->asArray()->where(['id_parent' => null])->all();
                $locals = [];

                foreach ($mainLocals as $key => $mainLocal) {
                    $locals[$mainLocal['name']] = ArrayHelper::map(Local::find()->asArray()->where(['id_parent' => $mainLocal['id']])->all(), 'id', 'name');
                }

                return $this->render('signupKennel', [
                    'model' => $model,
                    'locals' => $locals,
                ]);
            }
        }
    }

    public function acitonLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

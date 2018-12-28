<?php

namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/* Models */
use common\models\User;
use common\models\LoginForm;
use api\mosquitto\phpMQTT;
use api\models\ServerProperties;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public $message = [];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['authentication', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['authentication'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'],
            $actions['view'],
            $actions['update'],
            $actions['delete']);
        return $actions;
    }

    public function actionAuthentication($username, $password)
    {
        if (!Yii::$app->user->isGuest) return Yii::$app->user->identity->username . " is already logged";

        $loginForm = new LoginForm();
        $loginForm->username = $username;
        $loginForm->password = $password;

        if ($loginForm->login()) return $username . " has successfully logged in";

        return "Error, please check if the username or password are correct";
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return "You have successfully logged out";
    }

}

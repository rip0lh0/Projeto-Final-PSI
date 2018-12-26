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

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['authentication', 'logout', 'subscribe', 'create-channel'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create-channel'],
                        'roles' => ['kennel']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['subscribe'],
                        'roles' => ['adopter']
                    ],
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


    public function actionSubscribe($channelName)
    {

    }

    public function actionCreateChannel($channelName)
    {

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

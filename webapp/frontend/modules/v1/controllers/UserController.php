<?php

namespace frontend\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\Json;
use yii\web\ForbiddenHttpException;

/* Models */
use common\models\User;
use common\models\LoginForm;
use yii\web\NotFoundHttpException;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // $behaviors['access'] = [
        //     'class' => AccessControl::className(),
        //     'only' => ['profile'],
        //     'rules' => [
        //         [
        //             'allow' => true,
        //             'roles' => ['@'],
        //         ],
        //     ],
        // ];
        $behaviors['basicAuth'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'authentication']
        ];
        return $behaviors;
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



    public function authentication($username, $password)
    {
        if (empty($username) || empty($password)) return null;

        $user = User::find()->where(['username' => $username])->one();
        if ($user->validatePassword($password)) return $user;

        return null;
    }

    // public function actionAuthentication()
    // {
    //     $request = Yii::$app->request;

    //     $username = $request->post('username');
    //     $password = $request->post('password');

    // }

    public function actionProfile($username)
    {
        $user = User::find()->where(['username' => $username])->one();

        if (empty($user)) throw new NotFoundHttpException();

        return $user;
    }



    public function actionLogout()
    {
        Yii::$app->user->logout();

        return ['success' => 'Logout successful'];
    }
}

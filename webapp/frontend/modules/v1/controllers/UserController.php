<?php

namespace frontend\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Model;
use yii\base\ErrorException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\Json;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/* Models */
use common\models\User;
use common\models\LoginForm;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['basicAuth'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'authorization']
        ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'profile') if (Yii::$app->user->isGuest) throw new ForbiddenHttpException('Apenas Utilizadores registados podem executar' . $action);
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



    public function authorization($username, $password)
    {
        if (empty($username) || empty($password)) return null;

        $user = User::find()->where(['username' => $username])->one();
        if ($user->validatePassword($password)) return $user;

        return null;
    }

    public function actionAuthentication()
    {
        $request = Yii::$app->request;

        $username = $request->post('username');
        $password = $request->post('password');

        $user = User::findByUsername($username);

        if ($user->validatePassword($password)) return Yii::$app->user->login($user);
        else throw new ErrorException("Faild to Authenticate");
    }

    public function actionProfile($username)
    {
        if ($username != Yii::$app->user->identity->username) throw new ForbiddenHttpException();

        $user = User::find()->where(['username' => $username])->one();

        if (empty($user)) throw new NotFoundHttpException();

        return $user;
    }



    public function actionLogout()
    {
        if (Yii::$app->user->isGuest) throw new ErrorException("No session available");

        Yii::$app->user->logout(true);

        return ['success' => 'Logout successful'];
    }
}

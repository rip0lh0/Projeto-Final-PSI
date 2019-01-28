<?php

namespace frontend\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
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
use common\models\Adopter;
use frontend\modules\v1\models\AuthClient;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'],
            $actions['view'],
            $actions['update'],
            $actions['delete']);
        return $actions;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['basicAuth'] = [
            'class' => HttpBasicAuth::className(),
            'except' => ['signup'],
            'auth' => [AuthClient::class, 'auth'],
        ];
        return $behaviors;
    }

    public function actionProfile($username)
    {
        if ($username != Yii::$app->user->identity->username) throw new ForbiddenHttpException();

        $user = User::find()->where(['username' => $username, 'status' => User::STATUS_ACTIVE])->one();

        if (empty($user)) throw new NotFoundHttpException();
        unset($user['password_hash']);

        return ["success" => $user];
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) throw new ErrorException("No session available");

        $username = Yii::$app->request->post("username");
        $name = Yii::$app->request->post("name");
        $email = Yii::$app->request->post("email");
        $password = Yii::$app->request->post("password");

        $user = new User();
        $adopter = new Adopter();

        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();

        if (!$user->validate() && !$user->save()) {
            return ["error" => "Server Error: User"];
        }

        $adopter->id_user = $user->id;
        $adopter->name = $name;
        $adopter->cellphone = null;

        if (!$adopter->validate() && !$adopter->save()) {
            $user->delete();
            return ["error" => "Server Error: Adopter"];
        }

        /* Creates Adopters */
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole('adopter');
        $auth->assign($role, $user->getId());

        return ["success" => "Account created with success"];

    }

    public function actionLogout()
    {
        if (Yii::$app->user->isGuest) throw new ErrorException("No session available");

        Yii::$app->user->logout(true);

        return ['success' => 'Logout successful'];
    }
}

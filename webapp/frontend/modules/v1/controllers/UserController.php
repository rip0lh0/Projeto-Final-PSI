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
use common\models\Adoption;


use frontend\modules\v1\models\AuthClient;
use frontend\models\ProfileForm;
use common\models\Message;

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
            'except' => ['signup', 'profile', 'adoptions', 'messages', 'change-profile'],
            'auth' => [AuthClient::class, 'auth'],
        ];
        return $behaviors;
    }

    public function actionLogin()
    {
        if (Yii::$app->user->isGuest) ["error" => "Not Found"];

        $user = User::find()->where(['username' => Yii::$app->user->identity->username, 'status' => User::STATUS_ACTIVE])->one();

        if (empty($user)) ["error" => "Not Found"];
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

        if (!$user->validate()) {
            return ["error" => "Server Error: User"];
        }
        $user->save();


        $adopter->id_user = $user->id;
        $adopter->name = $name;
        $adopter->cellphone = null;

        if (!$adopter->validate()) {
            $user->delete();
            return ["error" => "Server Error: Adopter"];
        }

        $adopter->save();


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

    public function actionProfile($username)
    {
        $user = User::find()->where(['username' => $username, 'status' => User::STATUS_ACTIVE])->one();
        if (!$user) ["error" => "Not Found"];

        $adopter = $user->adopter;
        if (!$adopter) ["error" => "Not Found"];
        unset($user['password_hash']);

        $user_profile = [];
        $user_profile = $adopter->attributes;
        $user_profile["username"] = $user->username;
        $user_profile["email"] = $user->email;
        $user_profile["created_at"] = date("d/m/Y", $user->created_at);

        return ["success" => $user_profile];
    }

    public function actionChangeProfile($username)
    {
        $user = User::find()->where(['username' => $username, 'status' => User::STATUS_ACTIVE])->one();
        if (!$user) return ["error" => "Not Found"];

        $adopter = $user->adopter;
        if (!$adopter) return ["error" => "Not Found"];
        
        /* Load Values */
        $user->email = Yii::$app->request->post("email");
        $adopter->name = Yii::$app->request->post("name");
        $adopter->cellphone = Yii::$app->request->post("phone");

        if (!$user->validate() || !$adopter->validate()) return ["error" => "Changes Not Saved"];
        if (!$user->update() && !$adopter->update()) return ["error" => "Changes Not Saved"];

        return ["success" => "Changes Saved"];
    }

    public function actionAdoptions($username)
    {
        $user = User::find()->where(['username' => $username, 'status' => User::STATUS_ACTIVE])->one();
        if (!$user) return ["error" => "Not Found"];

        $raw_adoptions = Adoption::find()->where(['id_adopter' => $user->id])->orderBy(["created_at" => SORT_ASC])->all();
        $adoptions = [];

        foreach ($raw_adoptions as $key => $value) {
            $adoptions[$key] = $value->attributes;
            $adoptions[$key]["kennelAnimal"] = $value->kennelAnimal->attributes;
            $adoptions[$key]["kennelAnimal"]["animal"] = $value->kennelAnimal->animal->attributes;

            $adoptions[$key]["kennelAnimal"]["animal"]["energy"] = $value->kennelAnimal->animal->energy->energy;
            $adoptions[$key]["kennelAnimal"]["animal"]["coat"] = $value->kennelAnimal->animal->coat->coat_size;
            $adoptions[$key]["kennelAnimal"]["animal"]["size"] = $value->kennelAnimal->animal->size->size;

            $adoptions[$key]["kennelAnimal"]["kennel"] = $value->kennelAnimal->kennel->attributes;

            $local = $value->kennelAnimal->kennel->local;
            $local_name = ($local != null && $local->parent != null) ? $local->parent->name . ', ' . $local->name : $local->name;
            $adoptions[$key]["kennelAnimal"]["kennel"]["local"] = $local_name;

            foreach ($value->messages as $key_message => $message) {
                $adoptions[$key]["messages"][$key_message] = $message->attributes;
                $adoptions[$key]["messages"][$key_message]["username"] = $message->user->username;
            }

            unset($adoptions[$key]["kennel"]["id_local"]);
            unset($adoptions[$key]["kennelAnimal"]["animal"]["id_energy"]);
            unset($adoptions[$key]["kennelAnimal"]["animal"]["id_coat"]);
            unset($adoptions[$key]["kennelAnimal"]["animal"]["id_size"]);
        }

        return ["success" => $adoptions];
    }

    public function actionMessages($id_adoption)
    {
        $raw_messages = Message::find()->where(['id_adoption' => $id_adoption])->all();

        $messages = [];

        foreach ($raw_messages as $key => $value) {
            $messages[$key] = $value->attributes;
            $messages[$key]["username"] = $value->user->username;
        }

        return ["success" => $messages];
    }


}

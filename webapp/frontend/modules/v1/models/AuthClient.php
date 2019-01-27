<?php

namespace frontend\modules\v1\models;

use Yii;
use yii\base\ErrorException;
use yii\web\NotFoundHttpException;

use yii\filters\auth\HttpBasicAuth;

use common\models\User;

class AuthClient
{
    public static function auth($username, $password)
    {
        if (empty($username) || empty($password)) return null;

        $user = User::findByUsername($username);
        if ($user == null) return null;

        $user_role = Yii::$app->authManager->getRolesByUser($user->id);

        if (key_exists("kennel", $user_role)) return null;

        if ($user->status != User::STATUS_ACTIVE) return null;
        if ($user->validatePassword($password)) {

            Yii::$app->user->login($user);

            return $user;
        }

        return null;
    }

}
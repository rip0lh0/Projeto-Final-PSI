<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/* Models */
use common\models\LoginForm;
use common\models\Local;

use frontend\models\Adopter;
use frontend\models\Kennel;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;

/* Exceptions */
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;


class UserController extends Controller
{
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

    public function actionRegistration($signupType)
    {
        if (!Yii::$app->user->isGuest) return $this->goHome();

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_type = $signupType;
            if ($user = $model->signup()) return $this->redirect(["user/authentication"]);
        }
        
        // SignupType its User (0) Or Kennel (1)
        if ($signupType == SignupForm::SELF_ADOPTER) {
            return $this->render('signupAdopter', [
                'model' => $model,
            ]);
        } else {
            if ($signupType == SignupForm::SELF_KENNEL) {
                $mainLocals = Local::find()->asArray()->where(['id_parent' => null])->all();
                $locals = [];

                foreach ($mainLocals as $key => $mainLocal) {
                    $locals[$mainLocal['name']] = ArrayHelper::map(Local::find()->asArray()->where(['id_parent' => $mainLocal['id']])->all(), 'id', 'name');
                }

                return $this->render('signupKennel', [
                    'model' => $model,
                    'locals' => $locals,
                ]);
            } else {
                throw new \yii\web\NotFoundHttpException();
            }

        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'signupType your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

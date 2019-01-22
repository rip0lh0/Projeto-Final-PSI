<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

use yii\base\DynamicModel;

/* Models */
use common\models\LoginForm;
use common\models\Local;
use common\models\Message;

use frontend\models\Adopter;
use frontend\models\Kennel;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;

/* Exceptions */
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use common\models\User;
use common\models\Adoption;


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
        $error = '';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->login()) {
                return $this->goBack();
            }
        } else {
            $error = $model->errors;
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
            'error' => $error
        ]);

    }

    public function actionRegistration($signupType)
    {
        if (!Yii::$app->user->isGuest) return $this->goHome();

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_type = $signupType;
            // $model->signup();
            if ($model->signup()) return $this->redirect(["user/authentication"]);
        }
        
        // SignupType its User (0) Or Kennel (1)
        if ($signupType == User::TYPE_ADOPTER) {
            return $this->render('signupAdopter', [
                'model' => $model,
            ]);
        } else {
            if ($signupType == User::TYPE_KENNEL) {
                $locals = ArrayHelper::map(Local::find()->asArray()->where(['id_parent' => null])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');
                $sublocals = ArrayHelper::map(Local::find()->asArray()->where(['id_parent' => ((!empty($model->local)) ? $model->local : key($locals))])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');

                return $this->render('signupKennel', [
                    'model' => $model,
                    'locals' => $locals,
                    'sublocals' => $sublocals
                ]);
            } else {
                throw new \yii\web\NotFoundHttpException();
            }

        }
    }


    public function actionSubLocals($id_parent)
    {
        $sublocals[] = ArrayHelper::map(Local::find()->asArray()->where(['id_parent' => $id_parent])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');
        if (!empty($sublocals)) {
            foreach ($sublocals[0] as $key => $sublocal) {
                echo "<option value='" . $key . "'>" . $sublocal . "</option>";
            }
        } else {
            echo "<option>-</option>";
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


    public function actionMessages()
    {
        $adopter = Yii::$app->user->identity->adopter;
        $adoptions = $adopter->adoptions;

        return $this->render('messages', [
            'adoptions' => $adoptions
        ]);
    }

    public function actionMessage($id_adoption)
    {
        $adoption = Adoption::find()->where(['id' => $id_adoption])->one();

        $messages = $adoption->messages;

        $model = new DynamicModel(['KOMENTAR']);
        $model->addRule(['KOMENTAR'], 'string', ['max' => 128]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $msg_answer = new Message();

            $msg_answer->id_adoption = $adoption->id;
            $msg_answer->message = $model->KOMENTAR;
            $msg_answer->id_user = Yii::$app->user->id;

            if ($msg_answer->save()) return $this->redirect(['user/messages']);
        }

        return $this->renderAjax('message', [
            'messages' => $messages,
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Criar Utilizador';
$this->params['breadcrumbs'][] = $this->title;

// $userName = Yii::$app->user->identity->username;
// $local = Yii::$app->user->identity->local;

?>
<section class="signup">
    <div class="container" style="margin-top: 80px;">
        <?php $form = ActiveForm::begin(
            [
                'id' => 'login-form',
                'fieldConfig' => [
                    'autoPlaceholder' => true
                ],
                'formConfig' => ['showErrors' => false]
            ]
        ); ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="menu-panel">
                <div class="mp-header" style="background-color: rgba(33,150,243 ,1); padding: 3%;">
                    <h1><?= $this->title ?></h1>
                </div>
                <div class="mp-body" style="padding: 5% 10%;">
                        <?= $form->field($model, 'username', [
                            'feedbackIcon' => [
                                'prefix' => 'fa fa-',
                                'default' => 'user',
                                'success' => 'check-circle',
                                'error' => 'exclamation-circle',
                                'defaultOptions' => ['class' => 'text-primary']
                            ]
                        ])->textInput([
                            'autofocus' => true,
                            'class' => 'input-flat'
                        ]) ?>

                        <?= $form->field($model, 'email', [
                            'options' => ['style' => 'margin-top: 30px;'],
                            'feedbackIcon' => [
                                'prefix' => 'fa fa-',
                                'default' => 'envelope',
                                'success' => 'check-circle',
                                'error' => 'exclamation-circle',
                                'defaultOptions' => ['class' => 'text-primary']
                            ]
                        ])->textInput([
                            'autofocus' => true,
                            'class' => 'input-flat'
                        ]) ?>
                        <?= $form->field($model, 'password', [
                            'options' => ['style' => 'margin-top: 30px;'],
                            'feedbackIcon' => [
                                'prefix' => 'fa fa-',
                                'default' => 'lock',
                                'success' => 'check-circle',
                                'error' => 'exclamation-circle',
                                'defaultOptions' => ['class' => 'text-primary']
                            ]
                        ])->passwordInput([
                            'class' => 'input-flat'
                        ]) ?>

                        <?= Html::submitButton('Registar', ['class' => 'btn btn-blue btn-block btn-flat', 'style' => 'margin-top: 30px; min-height: 45px;', 'name' => 'login-button']) ?>
                        <?= $form->errorSummary($model, ['header' => '', 'class' => 'mp-error', 'style' => 'background-color: #ef5350']); ?>  
                </div>
                
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>

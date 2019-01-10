<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\select2\Select2;

$this->title = 'Associação';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="signup row-fluid bg-image" style="background-image: url('<?= Url::base(true) ?>/images/bg_2.jpg');">
    <div class="container" style="padding: 120px 0;">
        <?php $form = ActiveForm::begin(
            [
                'id' => 'login-form',
                'fieldConfig' => [
                    'autoPlaceholder' => true
                ],
                'formConfig' => ['showErrors' => false]
            ]
        ); ?>
        <div class="col-md-10 col-md-offset-1">
            <div class="menu-panel">
                <div class="mp-header" style="background-color: rgba(255,167,38 ,1); padding: 3%;">
                    <h1><?= $this->title ?></h1>
                </div>
                <div class="mp-body" style="padding: 5% 10%;">
                    <div class="col-md-12" >
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
                            'class' => 'input-flat',
                            'style' => 'margin-top: 0px;'
                        ]) ?>

                        <?= $form->field($model, 'name', [
                            'feedbackIcon' => [
                                'prefix' => 'fa fa-',
                                'default' => 'user',
                                'success' => 'check-circle',
                                'error' => 'exclamation-circle',
                                'defaultOptions' => ['class' => 'text-primary']
                            ]
                        ])->textInput([
                            'class' => 'input-flat',
                            'style' => 'margin-top: 0px;'
                        ]) ?>

                        <?= $form->field($model, 'email', [
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

                    </div>
                    <div class="col-md-6" style="margin-top: 0;">
                        <?= $form->field($model, 'phone', [
                            'feedbackIcon' => [
                                'prefix' => 'fa fa-',
                                'default' => 'phone',
                                'success' => 'check-circle',
                                'error' => 'exclamation-circle',
                                'defaultOptions' => ['class' => 'text-primary']
                            ]
                        ])->widget('yii\widgets\MaskedInput', [
                            'mask' => '999-999-999',
                            'class' => 'input-flat'
                        ])->textInput([
                            'class' => 'input-flat'
                        ]) ?>

                        <?= $form->field($model, 'address', [
                            'feedbackIcon' => [
                                'prefix' => 'fa fa-',
                                'default' => 'map-marker',
                                'success' => 'check-circle',
                                'error' => 'exclamation-circle',
                                'defaultOptions' => ['class' => 'text-primary']
                            ]
                        ])->textInput([
                            'class' => 'input-flat'
                        ]) ?>

                    </div>
                    <div class="col-md-6" style="margin-top: 0;">
                        <?= $form->field($model, 'nif', [
                            'feedbackIcon' => [
                                'prefix' => 'fa fa-',
                                'default' => 'list-alt',
                                'success' => 'check-circle',
                                'error' => 'exclamation-circle',
                                'defaultOptions' => ['class' => 'text-primary']
                            ]
                        ])->textInput([
                            'class' => 'input-flat'
                        ]) ?>

                        <?= $form->field($model, 'local')->widget(Select2::classname(), [
                            'data' => $locals,
                            'options' => [
                                'class' => 'input-flat',
                                'placeholder' => 'Localidade'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>

                    </div>
                    <?= Html::submitButton('Registar', ['class' => 'btn btn-orange btn-block btn-flat', 'style' => 'margin-top: 30px; min-height: 45px;', 'name' => 'login-button']) ?>
                    <?= $form->errorSummary($model, ['header' => '', 'class' => 'mp-error', 'style' => 'background-color: #ef5350']); ?>  
                </div>
                
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>

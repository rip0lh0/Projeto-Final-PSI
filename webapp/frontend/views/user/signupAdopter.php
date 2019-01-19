<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;

use kartik\form\ActiveForm;

$this->title = 'Utilizador';
$this->params['breadcrumbs'][] = $this->title;

// $userName = Yii::$app->user->identity->username;
// $local = Yii::$app->user->identity->local;

?>

<div class="breadcumb_area bg-img" style="background-image: url('<?= Url::base(true) ?>/images/bg_2.jpg');">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2><?= $this->title ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="checkout_area section-padding-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="checkout_details_area clearfix">
                     <?php $form = ActiveForm::begin(
                        [
                            'id' => 'signup-form',
                            'formConfig' => ['showErrors' => false]
                        ]
                    ); ?>
                        <div class="row justify-content-center">
                            <div class="col-md-12 mb-3">
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <?= $form->field($model, 'name')->textInput() ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                 <?= $form->field($model, 'email')->input('email') ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <?= $form->field($model, 'password')->passwordInput() ?>
                            </div>
                            <div class="col-6" style="margin: 20px;">
                                <?= Html::submitButton('Registar', ['class' => 'btn btn-primary btn-lg btn-block', 'style' => 'font-size: 2em;', 'name' => 'signup-button']) ?>
                            </div>
                            <div class="container">
                                <?= $form->errorSummary($model, ['header' => '', 'class' => 'alert alert-danger']) ?>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

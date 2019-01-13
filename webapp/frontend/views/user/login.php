<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;

use kartik\form\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="breadcumb_area bg-img" style="background-image: url('<?= Url::base(true) ?>/images/bg_1.jpg');">
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
                            'id' => 'login-form',
                            // 'fieldConfig' => [
                            //     'autoPlaceholder' => true
                            // ],
                            'formConfig' => ['showErrors' => false]
                        ]
                    ); ?>
                        <div class="row justify-content-center">
                            <div class="col-md-12 mb-3">
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <?= $form->field($model, 'password')->passwordInput() ?>
                            </div>
                           <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="rememberme">
                                    <label class="custom-control-label" for="rememberme">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button', 'style' => 'font-size: 2em;']) ?>
                            </div>
                            <?php if ($model) ?>
                            <div class="container">
                                <div class="alert alert-danger" role="alert">
                                    <?= var_dump($error) ?>
                                </div>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

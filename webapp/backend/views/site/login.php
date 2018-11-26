<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\popover\PopoverX;
use backend\assets\LoginAsset;


LoginAsset::register($this);

$this->title = 'Admin Login';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="login-box">
    <div class="login-logo">
        <a><b>Pet</b>4<b>All</b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'type' => ActiveForm::TYPE_VERTICAL
        ]); ?>
        <!-- Username Input -->
        <?= $form->field($model, 'username', [
            'addon' => ['append' => ['content' => '<i class="fa fa-user"></i>']]
        ])->textInput([
            'autofocus' => true,
            'placeholder' => 'Username',
            'class' => 'form-group'
        ])->label(false); ?>
        <!-- Password Input -->
        <?= $form->field($model, 'password', [
            'addon' => ['append' => ['content' => '<i class="fa fa-lock"></i>']]
        ])->passwordInput([
            'placeholder' => 'Password',
            'data-toggle' => 'tooltip',
            'class' => 'form-group'
        ])->label(false); ?>
        <!-- Submit Button -->
        <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>
        <?= Html::a('Forgot Password?', ['#'], ['style' => 'margin-top: 10px; text-align: center; display: block;']) ?>
    </div>
</div>

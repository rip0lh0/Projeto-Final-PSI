<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\popover\PopoverX;
use backend\assets\LoginAsset;


LoginAsset::register($this);

$this->title = 'Admin Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="login-form">
        <div class="main-div">
            <div class="panel">
                <h2 ><?= $this->title ?></h2>
                <p>Please enter your Username and Password</p>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'type' => ActiveForm::TYPE_VERTICAL
            ]); ?>
            <!-- Username Input -->
            <?= $form->field($model, 'username', [
                'addon' => ['prepend' => ['content' => '<i class="fa fa-user"></i>']]
            ])->textInput([
                'autofocus' => true,
                'placeholder' => 'Username',
                'class' => 'form-group'
            ])->label(false); ?>
            <!-- Password Input -->
            <?= $form->field($model, 'password', [
                'addon' => ['prepend' => ['content' => '<i class="fa fa-lock"></i>']]
            ])->passwordInput([
                'placeholder' => 'Password',
                'data-toggle' => 'tooltip',
                'class' => 'form-group'
            ])->label(false); ?>
            <!-- Submit Button -->
            <?= Html::submitButton('Login', ['class' => 'btn btn-warning btn-lg btn-block', 'name' => 'login-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
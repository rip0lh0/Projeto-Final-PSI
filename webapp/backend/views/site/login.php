<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use backend\assets\LoginAsset;

LoginAsset::register($this);

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-login">
        <div class="panel-login-heading">
            <h3 class="panel-login-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'type' => ActiveForm::TYPE_VERTICAL
            ]); ?>
                <!-- Username Input -->
                <?= $form->field($model, 'username', ['addon' => ['prepend' => ['content' => '<i class="fa fa-user"></i>']]])->textInput([
                    'autofocus' => true,
                    'placeholder' => 'Username',
                    'class' => ''
                ])->label(false); ?>
                <!-- Password Input -->
                <?= $form->field($model, 'password', ['addon' => ['prepend' => ['content' => '<i class="fa fa-lock"></i>']]])->passwordInput([
                    'placeholder' => 'Password'
                ])->label(false); ?>

                <?= Html::submitButton('Login', ['class' => 'btn btn-default btn-lg btn-block', 'name' => 'login-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

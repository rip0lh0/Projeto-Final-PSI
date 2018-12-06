<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
// selected box inports
use yii\helpers\ArrayHelper;
use backend\models\Standard;
use common\models\User;

$this->title = 'Criar Utilizador';
$this->params['breadcrumbs'][] = $this->title;

// $userName = Yii::$app->user->identity->username;
// $local = Yii::$app->user->identity->local;

?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Insira os dados de Utilizador:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'name') ?>
                <!-- <?= $form->field($model, 'local') ?> -->

                

                   
                 

                    
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>

            
        </div>
    </div>
</div>


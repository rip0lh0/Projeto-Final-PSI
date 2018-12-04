<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

namespace common\models;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'User Profile'
?>
<div class="site-userprofile">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create your Profile</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-userprofile']); ?>

               



            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
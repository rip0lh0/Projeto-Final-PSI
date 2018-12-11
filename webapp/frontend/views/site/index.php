<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Pet4All';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="intro row-fluid bg-image" style="background-image: url('images/bg_3.jpg');">
    <div class="container-fluid" style="padding: 90px 0 500px 0;">
        <div class="search-nav">
            <form class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>
    </div>
</section>

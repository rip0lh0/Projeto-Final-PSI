<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Pet4All';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- WELCOME AREA START -->
<section class="welcome_area bg-img background-overlay" style="background-image: url('<?= Url::base(true) ?>/images/bg_3.jpg');">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="hero-content">
                    <h6>asoss</h6>
                    <h2>New Collection</h2>
                    <a href="#" class="btn essence-btn">view collection</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- WELCOME AREA END -->

<div class="top_catagory_area section-padding-80 clearfix">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Single Catagory -->
            <div class="col-12 col-sm-6 col-md-6">
                <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url('<?= Url::base(true) ?>/images/catagory_dogs.jpg');">
                    <div class="catagory-content">
                        <a href="#">Cão</a>
                    </div>
                </div>
            </div>
            <!-- Single Catagory -->
            <div class="col-12 col-sm-6 col-md-6">
                <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url('<?= Url::base(true) ?>/images/catagory_cats.jpg');">
                    <div class="catagory-content">
                        <a href="#">Gato</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

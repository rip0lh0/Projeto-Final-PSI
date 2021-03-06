<?php

use yii\helpers\Url;
use yii\helpers\Html;


$user = Yii::$app->user->identity;
?>

 <!-- ##### Right Side Cart Area ##### -->
<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">
    <!-- Cart Button -->
    <!-- <div class="cart-button">
        <a href="#" id="rightSideCart"><img src="images/main_logo.png" alt=""> <span>3</span></a>
    </div> -->

    <div class="cart-content d-flex user-sidebar">
        <div class="container">
            <div class="row us-landscape bg-img  justify-content-md-center" style="background-image: url('<?= Url::base(true) ?>/images/profile_bg.jpg');">
                <div class="col-12">
                    <img src="<?= Url::base(true) ?>/images/photo_placeholder.jpg" class="circle img-thumbnail mx-auto d-block us-photo" alt="...">
                </div>
                <div class="col-12">
                    <h3 class="us-username"><?= $user->username; ?></h3>
                    <h6 class="us-since">Membro desde: <?= date('d-m-Y', $user->created_at); ?></h6>
                </div>
            </div>
            <!-- <div class="row justify-content-md-center">
                <div class="col-8" style="padding: 10px;">
                    <div class="row us-stat">
                        <div class="col-3 us-stat-icon">
                            <i class="fas fa-envelope fa-3x"></i>
                        </div>
                        <div class="col-9">
                            <h4>Email</h4>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row align-top">
                <div class="col" style="margin-top: 10px;">
                    <?= Html::a('Mensagens', ['user/messages'], ['class' => 'btn btn-outline-primary btn-lg btn-block']) ?>
                </div>
                <div class="col" style="margin-top: 10px;">
                    <?= Html::a('Perfil', ['user/profile'], ['class' => 'btn btn-outline-secondary btn-lg btn-block']) ?>
                </div>
                <div style="position: absolute; bottom: 0; width: 100%;">
                    <?= Html::a('Sign out', ['user/logout'], ['data-method' => 'post', 'class' => 'btn btn-outline-danger btn-lg btn-block', 'style' => 'border-radius: 0; border-left: none; border-right: none;']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Right Side Cart End ##### -->
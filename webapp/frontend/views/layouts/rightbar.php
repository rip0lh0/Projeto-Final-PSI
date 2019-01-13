<?php

use yii\helpers\Url;

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
                    <h3 class="us-username">Username</h3>
                    <h6 class="us-since">Membro desde: 20/20/2019</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12 us-stat">
                    <div class="col-3">
                        <i class="fas fa-envelope fa-3x"></i>
                    </div>
                    <div class="col-9">

                    </div>
                </div>
            </div>
            <!-- <div class="row align-bottom">
                <div class="col">
                    <a href="#" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Primary link</a>
                </div>
                <div class="col">
                    <a href="#" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Primary link</a>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- ##### Right Side Cart End ##### -->
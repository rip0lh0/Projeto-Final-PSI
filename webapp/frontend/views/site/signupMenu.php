<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div style="position: absolute; z-index: -1; top: 0;"><img src="images/bg_1.jpg" alt="" class="bg-image"></div>
<section class="signup-menu">
    <div class="container"  style="margin-top: 80px;">
        <div class="col-md-4 col-md-offset-1 menu-panel">
            <div class="mp-header" style="background-color: rgba(66,165,245 ,1);">
                 <i class="fa fa-user"></i>
            </div>
            <div class="mp-body" style="padding-top: 1%;">
                <h3 class="mp-title">Utilizador</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <?= Html::a('Registar', ['site/signup'], ['class' => 'btn btn-blue btn-block btn-flat']); ?>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-2 menu-panel">
            <div class="mp-header" style="background-color: rgba(255,167,38 ,1);">
                <i class="fa fa-group"></i>
            </div>
            <div class="mp-body" style="padding-top: 1%;">
                <h3 class="mp-title">Associção</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <?= Html::a('Registar', ['site/signup', 'check' => '1'], ['class' => 'btn btn-purple btn-block btn-flat']); ?>
            </div>
        </div>
    </div>
</section>
    

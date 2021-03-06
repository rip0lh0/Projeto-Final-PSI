<?php

use yii\helpers\HTML;
use yii\helpers\Url;

?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?= Html::a(Html::img(['images/logo_500x150_2.png'], ['class' => 'logo']), Url::home()); ?>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="main-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav pull-right">
                <?php if (Yii::$app->user->isGuest) { ?>
                    <li class="hvrcenter"><?= Html::a('Login', ['user/authentication'],['id'=>'loginButton']) ?></li>
                    <li class="hvrcenter"><?= Html::a('Signup', ['site/menu'],['id' => 'signupButton']) ?></li>
                    <?php 
                } else { ?>
                    <li class="hvrcenter"><?= Html::a('Logout', ['user/logout'], ['data-method' => 'post']); ?></li>
                    <?php 
                } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use common\models\User;

$UserName = Yii::$app->user->identity->username;

AppAsset::register($this);
?>
<header class="main-header">
    <?= Html::a('<span class="logo-mini">ADM</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="https://dummyimage.com/160x160/000/fff" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= $UserName ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="https://dummyimage.com/160x160/000/fff" class="img-circle"
                                 alt="User Image"/>
                            <p><?= $UserName ?></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a('Sign out', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
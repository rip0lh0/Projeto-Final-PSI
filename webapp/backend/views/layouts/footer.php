<?php

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>

<footer class="main-footer fixed-bottom">
    <strong>Copyright © 2018 - 2019 All rights reserved.</strong>
    <div class="pull-right hidden-xs">
        <b>Version</b> <?= Yii::$app->version ?>
    </div>
</footer>
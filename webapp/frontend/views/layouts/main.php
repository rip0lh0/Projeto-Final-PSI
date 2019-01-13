<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="animsition">
<?php $this->beginBody() ?>
    <?= $this->render('header'); ?>
    <?= (!Yii::$app->user->isGuest) ? $this->render('rightbar') : ''; ?>
    
    <?= $content ?>

    <?= $this->render('footer'); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


 
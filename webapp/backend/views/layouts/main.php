<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\User;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

use backend\assets\AppAsset;
use dmstr\helpers\AdminLteHelper;
use dmstr\web\AdminLteAsset;

AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="<?= AdminLteHelper::skinClass() ?> <?= (User::isKennel()) ? '' : 'sidebar-collapse' ?>">
        <?php $this->beginBody() ?>

        <?php if (User::isKennel()) {
            echo $this->render("@backend/views/layouts/header");
            echo $this->render("@backend/views/layouts/sidebar");
        } ?>

        <div class="content-wrapper">
        <?php if (User::isKennel()) { ?>
            <section class="content-header">
                <h1><?= $this->title ?></h1>
            </section>
            <?php 
        } ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>

        <?= $this->render("@backend/views/layouts/footer"); ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

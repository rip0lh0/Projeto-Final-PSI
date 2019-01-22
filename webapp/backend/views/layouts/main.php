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

$isKennel = (Yii::$app->user->can('kennel')) ? true : false;

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
    <body class="<?= AdminLteHelper::skinClass() ?>">
        <?php $this->beginBody() ?>
        <?= ($isKennel) ? '<div class="wrapper" style="height: auto; min-height: 100%;">' : ''; /* Start wrapper */ ?>
            <?= ($isKennel) ? $this->render("@backend/views/layouts/header") : ''; ?>
            <?= ($isKennel) ? $this->render("@backend/views/layouts/sidebar") : ''; ?>
            <?= ($isKennel) ? '<div class="content-wrapper" style="min-height: 1170px;">' : '';/* Start content-wrapper */ ?>
                <?php if ($isKennel) { ?>
                    <section class="content-header">
                        <h1><?= $this->title ?></h1>
                    </section>
                    <?php 
                } ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                <?= ($isKennel) ? '</div>' : ''; /*End Content-wrapper*/ ?>
            <?= $this->render("@backend/views/layouts/footer"); ?>
        <?= ($isKennel) ? '</div>' : '' /* End wrapper */ ?>
        
        <?php $this->endBody() ?>
        <script>
        Dropzone.autoDiscover = false;// Fix Some Dropzone Errors
        $(function () {
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
        </script>
    </body>
</html>
<?php $this->endPage() ?>

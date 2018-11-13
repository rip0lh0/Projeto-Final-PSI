<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use common\models\User;
use yii\helpers\Html;

$this->title = $name;
?>

<div class="container">
    <div class="col-md-12 text-center">
        <h1 class="error-status-code"><?= $statusCode ?><h1>
        <h2 calss="error-message"><?= nl2br(Html::encode($message)) ?></h2>
        <p calss="error">The above error occurred while the Web server was processing your request.</p>
        <?php 
        if (User::isKennel()) {
            echo Html::a('Go Back!!', $preurl, ['class' => 'btn btn-default btn-flat']);
        } else {
            echo Html::a('Go Back!!', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']);
        }
        ?>
    </div>
</div>

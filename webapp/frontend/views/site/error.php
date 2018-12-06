<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use common\models\User;
use yii\helpers\Html;

$this->title = $name;
?>

<section class="content">
    <div class="error-page">
        <h2 class="headline text-yellow"><?= $statusCode ?></h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! <?= nl2br(Html::encode($message)) ?></h3>

            <p calss="error">The above error occurred while the Web server was processing your request.</p>
            <?php 
            if (false)
                echo Html::a('Go Back!!', $preurl, ['class' => 'btn btn-warning btn-flat']);
            else
                echo Html::a('Go Back!!', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-warning btn-flat']);
            ?>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </div>
</section>

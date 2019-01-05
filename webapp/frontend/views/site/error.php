<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use common\models\User;
use yii\helpers\Url;

use yii\helpers\Html;

//var_dump($exception);


$this->title = $name;
?>
<section class="signup row-fluid bg-image" style="background-image: url('<?= Url::base(true) ?>/images/error_dog.jpg'); padding: 120px 0;">
    <div class="container">
        <div class="col-md-4 col-md-offset-8 menu-panel" style="margin-top: 25%;">
            <div class="menu-panel" style="margin-top: 0;">
                <div class="mp-header">
                    <h2 class="text-yellow"><?= $statusCode ?></h2>
                </div>
                
                <div class="mp-body" style="padding-top: 0;">
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! <?= nl2br(Html::encode($message)) ?></h3>

                    <p calss="error">The above error occurred while the Web server was processing your request.</p>
                    <?= Html::a('Go Back!!', $preurl, ['class' => 'btn btn-orange btn-block btn-flat']); ?>
                </div>
            </div>
        </div>
    </div>
</section>

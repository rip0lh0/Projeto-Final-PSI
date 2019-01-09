<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\Url;
use common\models\Animal;

$this->title = 'Pet4All';
$this->params['breadcrumbs'][] = $this->title;

$itemsPerRow = 4;

?>
<section class="animals container-fluid" style="padding-top: 100px;" >
    <div class="navbar navbar-default visible-xs">
        <div class="container-fluid">
            <button class="btn btn-default btn-block navbar-btn" data-toggle="collapse" data-target="#filter-sidebar">
                Filtrar
            </button>
        </div>
    </div>
    <div class="row">
        <!-- filter sidebar -->
        <div id="filter-sidebar" class="col-xs-6 col-sm-2 visible-sm visible-md visible-lg collapse sliding-sidebar">
            <div class="filter-panel">
                <h4 data-toggle="collapse" data-target="#size">
                    <i class="fa fa-fw fa-caret-down parent-expanded"></i>
                    <i class="fa fa-fw fa-caret-right parent-collapsed"></i>
                    Artist
                </h4>
                <div class="collapse in filter-options">
                    <a href="#">John Lennon</a>
                    <a  href="#">John Lennon</a>
                    <a  href="#">John Lennon</a>
                    <a  href="#">John Lennon</a>
                </div>
            </div>
        </div>
    
        <div class="col-sm-10 animals-list" style="padding: 0px 20px 20px 20px;">
            <?php 
            $count = 0;
            foreach ($animals as $animal) {
                ?>
            <?= ($count % $itemsPerRow == 0) ? '<div class="line row"><!-- Line -->' : ''; ?>
                <div class="col-md-<?= (12 / $itemsPerRow) ?>" style="margin-top: 20px;"><!-- Card -->
                    <div class="card">
                        <div class="card-header">
                            <?= $animal->getImage('0'); ?>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?= $animal->name ?>
                                <small><?= $animal->size->size ?></small>
                            </h3>
                            
                            <p class="card-text block-ellipsis"><?= $animal->description ?></p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group" aria-label="...">
                                <a type="button" class="btn btn-purple" style="width: 60%;">Adotar</a>
                                <a type="button" class="btn btn-blue"><i class="fa fa-eye"></i></a>
                                <a type="button" class="btn btn-primary"><i class="fa fa-share-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- END Card -->
                <?php $count++; ?>
            <?= ($count % $itemsPerRow == 0) ? '</div><!-- END Line -->' : ''; ?>
            
            <?php 
        } ?>
        </div>
    </div>
</section>



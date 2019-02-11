<?php 

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

use common\models\Schedule;

$this->title = $animal->name;
$this->params['breadcrumbs'][] = $this->title;

$images = $animal->allImages;
$kennel = $animal->kennelAnimal->kennel;
?>

<section class="single_product_details_area d-flex align-items-center">
    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        <div class="product_thumbnail_slides owl-carousel">
            <?php 
            foreach ($images as $image) {
                echo '<img src="data:image/jpeg;base64, ' . $image . '" />';
            }
            ?>
        </div>
    </div>

    <!-- Single Product Description -->
    <div class="single_product_desc clearfix">
        <h2><?= $animal->name; ?></h2>
        <p><span class="badge badge-<?= ($animal->gender == 'M') ? 'blue' : 'pink'; ?>" style="width: fit-content;"><?= $animal->animalGender ?></span></p>
        <p><?= ($animal->age) ? $animal->age . ' Anos.' : ''; ?></p>
        <!-- <p class="product-price"><span class="old-price">$65.00</span> $49.00</p> -->
        <p class="product-desc"><?= $animal->description ?></p>
        <div class="row justify-content-center">
            <div class="order-details-confirmation col-6" style="padding: 0px 20px;">
                <ul class="order-details-form">
                    <li>
                        <span>Tamanho</span>
                        <span>
                            -
                            <?php 
                            $has_found = false;
                            foreach ($sizes as $key => $size) {

                                if ($has_found) {
                                    echo "<i class='far fa-square'></i> ";
                                } else {
                                    echo "<i class='fas fa-square success'></i> ";
                                }
                                if ($size->id == $animal->size->id) $has_found = true;
                            } ?>
                            +
                        </span>
                    </li>
                    <li>
                        <span>Pelo</span>
                        <span>
                            -
                            <?php 
                            $has_found = false;
                            foreach ($coats as $key => $coat) {

                                if ($has_found) {
                                    echo "<i class='far fa-square'></i> ";
                                } else {
                                    echo "<i class='fas fa-square success'></i> ";
                                }
                                if ($coat->id == $animal->coat->id) $has_found = true;
                            } ?>
                            +
                        </span>
                    </li>
                    <li>
                        <span>Energia</span>
                        <span>
                            -
                            <?php 
                            $has_found = false;
                            foreach ($energies as $key => $energy) {

                                if ($has_found) {
                                    echo "<i class='far fa-square'></i> ";
                                } else {
                                    echo "<i class='fas fa-square success'></i> ";
                                }
                                if ($energy->id == $animal->energy->id) $has_found = true;
                            } ?> 
                            +
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kennelContactModal" style="margin-top: 3em;">Contactar</button>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="kennelContactModal" tabindex="-1" role="dialog" aria-labelledby="kennelContactModalLabel" aria-hidden="true">

    <?php $form = ActiveForm::begin(
        [
            'id' => 'message-form'
        ]
    ); ?>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kennelContactModalLabel">Contacto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $form->field($model, 'message')->textInput(['autofocus' => true]) ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times"></i></button>
                <?= Html::submitButton('<i class="fas fa-paper-plane"></i>', ['class' => 'btn btn-info', 'name' => 'submit-button']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>


<div class="row" style="padding: 50px 20px; background-color: #f5f7f9">
    <div class="container">
        <div class="col-12">
            <h2 class="text-center"><?= $kennel->name ?></h2>
        </div>
        <div class="row kennel-contacts ">
            <div class="col text-center">
                <h4>Contactos</h4>
                <p><?= $kennel->address ?>, <?= ($kennel->local != null) ? $kennel->local->name : ''; ?><?= ($kennel->local->parent != null) ? ', ' . $kennel->local->parent->name : ''; ?></p>
                <?php if ($kennel->phone != null) { ?>
                <p><?= $kennel->phone ?></p>
                    <?php 
                } ?>
                <?php if ($kennel->cell_phone != null) { ?>
                <p><?= $kennel->cell_phone ?></p>
                    <?php 
                } ?>
                <p><a href="mailto:contact@essence.com" ><?= $kennel->user->email ?></a></p>
            </div>
            <div class="col text-center">
                <h4>Horario</h4>
                <?php if ($kennel->schedules) { ?>
                    <div class="row">
                        <div class="col-md-6 text-right" style="padding-right: 0;">
                            <?php
                            foreach (Schedule::DAY_WEEK as $key => $value) {
                                echo '<p>' . $value . ':</p>';
                            }
                            ?>
                        </div>
                        <div class="col-md-6 text-left">
                            <?php

                            foreach (Schedule::DAY_WEEK as $key => $value) {
                                $hour_open = null;
                                $hour_close = null;
                                $hour_lunch_open = null;
                                $hour_lunch_close = null;

                                foreach ($kennel->schedules as $key_schedule => $schedule) {
                                    if ($schedule->day == (string)$key) {
                                        $hour_open = date("H:i", strtotime($schedule->open_time));
                                        $hour_close = date("H:i", strtotime($schedule->close_time));
                                        if ($schedule->lunch_open) {
                                            $hour_lunch_open = date("H:i", strtotime($schedule->lunch_open));
                                            $hour_lunch_close = date("H:i", strtotime($schedule->lunch_close));
                                        }
                                    }
                                }

                                if ($hour_open) {
                                    echo '<p>';
                                    echo $hour_open . '-';
                                    if ($hour_lunch_open) {
                                        echo $hour_lunch_open . ' e ';
                                        echo $hour_lunch_close . '-';
                                    }
                                    echo $hour_close;

                                    echo '</p>';
                                } else {
                                    echo '<p>Fechado</p>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php 
                } ?>
            </div>
        </div>
    </div>
</div>



<?php 
$scriptCarousel = "
    $(function() {
        var owl = $('.product_thumbnail_slides');
        owl.owlCarousel({
            items: 1,
            margin: 10,
            nav: true,
            navText: ['" . '<i class="fas fa-arrow-left"></i>' . "', '" . '<i class="fas fa-arrow-right"></i>' . "'],
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1000
        });
        owl.trigger('refresh.owl.carousel');
    });
";

$this->registerJs($scriptCarousel);

?>
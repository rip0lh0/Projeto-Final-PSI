<?php 

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = $animal->name;
$this->params['breadcrumbs'][] = $this->title;

$images = $animal->allImages;

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

<!-- <a class="floatbtn" href="<?= Yii::$app->request->referrer; ?>" style="position: fixed; z-index: 1000;" ><i class="fas fa-angle-left"></i></a> -->



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
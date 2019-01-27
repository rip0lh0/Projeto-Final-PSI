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

$itemsPerRow = 3;
?>

<section class="shop_grid_area section-padding-80">
    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="shop_grid_product_area">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-topbar d-flex align-items-center justify-content-between">
                                <!-- Total Products -->
                                <div class="total-products">
                                    <p><span><?= count($animals) ?></span> Animais encontrados</p>
                                </div>
                                <!-- Sorting -->
                                <!-- <div class="product-sorting d-flex">
                                    <p>Sort by:</p>
                                    <form action="#" method="get">
                                        <select name="select" id="sortByselect">
                                            <option value="value">Highest Rated</option>
                                            <option value="value">Newest</option>
                                            <option value="value">Price: $$ - $</option>
                                            <option value="value">Price: $ - $$</option>
                                        </select>
                                        <input type="submit" class="d-none" value="">
                                    </form>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <?php 
                    $count = 0;
                    foreach ($animals as $animal) {
                        if ($count % $itemsPerRow == 0) echo '<div class="row">';
                        ?>
                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div id="animalimage-<?php echo $count; ?>" class="product-img">
                                    
                                    <img src="data:image/jpeg;base64, <?= $animal->getImage('0.jpg'); ?>" alt="">
                                    <!-- Hover Thumb -->
                                    <?php if (count($animal->allImages) >= 2) { ?>
                                    <img class="hover-img" src="data:image/jp$this->id_Kennelg;base64, <?= $animal->getImage('1.jpg'); ?>" alt="">
                                        <?php 
                                    } ?>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span><?= $animal->size->size ?></span>
                                    <?= Html::a('<h6>' . $animal->name . '</h6>', ['animal/adopt', 'id_animal' => $animal->id]) ?>
                                    <span class="badge badge-<?= ($animal->gender == 'M') ? 'blue' : 'pink'; ?>"><?= $animal->animalGender ?></span>
                                    <span><?= ($animal->age) ? $animal->age . ' Anos.' : ''; ?></span>

                                    <!-- Hover Content -->
                                    <!-- <div class="hover-content"> -->
                                        <!-- Add to Cart -->
                                        <!-- <div class="add-to-cart-btn"> -->
                                            <?= Html::a('Adotar', ['animal/adopt', 'id_animal' => $animal->id], ['id' => 'btn-a'] ,['class' => 'btn essence-btn']) ?>
                                        <!-- </div> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <?php 
                        $count++;
                        if ($count % $itemsPerRow == 0) echo '</div>';

                    }
                    ?>
                </div>
                <!-- Pagination -->
                <!-- <nav aria-label="navigation">
                    <ul class="pagination mt-50 mb-70">
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">21</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </nav> -->
            </div>
        </div>
    </div>
</section>




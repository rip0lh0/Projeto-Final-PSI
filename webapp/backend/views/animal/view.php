<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

//var_dump($model);

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'animal-form']); ?>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informação Básica</h3>
                    </div>
                    <div class="box-body">
                        <!-- Name -->
                        <?= $form->field($animal, 'name')->textInput(['disabled' => true]); ?>
                         <!-- Description -->
                        <?= $form->field($animal, 'description')->textInput(['disabled' => true]); ?>
                        <!-- Chip Number -->
                        <?= $form->field($animal, 'chip')->textInput(['disabled' => true]); ?>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ficha Do Animal</h3>
                    </div>
                    <div class="box-body">
                         <?= $form->field($animal->energy, 'energy')->textInput(['disabled' => true]); ?>

                        <?= $form->field($animal->coat, 'coat_size')->textInput(['disabled' => true]); ?>

                        <?= $form->field($animal->size, 'size')->textInput(['disabled' => true]); ?>
                        <!-- Animal Gender -->
                        <?= $form->field($animal, 'gender')->textInput(['disabled' => true]); ?>
                        <!-- Animal Size -->
                        <?= $form->field($animal, 'weight')->textInput(['disabled' => true]); ?>
                        <!-- Animal Age -->
                        <?= $form->field($animal, 'age')->textInput(['disabled' => true]); ?>
                        <!-- Animal Neutered -->
                        <?= $form->field($animal, 'neutered')->textInput(['disabled' => true]); ?>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fotos</h3>
                    </div>
                    <div class="box-body"> 
                        <div class="container">
                        <div id="profile-photos" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <?php 
                                $counter = 0;
                                foreach ($animal->images as $image) { ?>
                                    <li data-target="#profile-photos" data-slide-to="<?= $counter ?>" <?= ($counter == 0) ? 'class="active"' : ''; ?>></li>
                                    <?php 
                                    $counter++;
                                } ?>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <?php 
                                $activeItem = true;
                                foreach ($animal->images as $image) { ?>
                                    <div class="item <?= ($activeItem) ? 'active' : ''; ?>">
                                        <?= $animal->getImage($image); ?>
                                    </div>
                                    <?php 
                                    $activeItem = false;
                                } ?>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#profile-photos" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#profile-photos" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>        
    </div>
</div>

                            
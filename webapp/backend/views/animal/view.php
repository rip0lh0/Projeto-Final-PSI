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
                        <?php 
                        $count = 0;
                        foreach ($animal->allImages as $image) {
                            if ($count % 6 == 0) echo '<div class="row" style="margin-top: 30px;">';
                            echo '<div class="col-md-2">';
                            echo '<img src="data:image/jpeg;base64, ' . $image . '" style="width: 100%; height: 200px; object-fit: cover;"/>';
                            echo '</div>';
                            $count++;
                            if ($count % 6 == 0) echo '</div>';
                        } ?>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>        
    </div>
</div>

                            
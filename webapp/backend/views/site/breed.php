<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use backend\assets\AppAsset;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;

$this->title = 'Inserir Raças';
AppAsset::register($this);
?>
<section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Raças</h3>
                </div>
                
                <?php $form = ActiveForm::begin(['id' => 'breed-form']); ?>
                <div class="box-body">
                    <?php if ($msg != '') { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i><?= $msg ?></h4>
                            
                        </div>
                        <?php 
                    } ?>

                    <?= $form->field($modelBreed, 'name')->textInput(); ?>
                    <?= $form->field($modelBreed, 'lifespan')->textInput(); ?>
                    <?= $form->field($modelBreed, 'origin')->textInput(); ?>
                    <?= $form->field($modelBreed, 'description')->textarea(['class' => 'textarea', 'style' => 'width: 100%;']); ?>
                    <?= $form->field($modelBreed, 'id_parent')->widget(Select2::classname(), [
                        'value' => 'id',
                        'attribute' => 'parent',
                        'value' => 'id',
                        'data' => ArrayHelper::map($breed, 'id', 'name'),
                        'options' => ['multiple' => true, 'search' => true, 'placeholder' => 'Select Breed Energy...'],
                    ]); ?>
                    <?= $form->field($modelEnergy, 'id_energy')->widget(Select2::classname(), [
                        'value' => 'id',
                        'attribute' => 'energy',
                        'value' => 'id',
                        'data' => ArrayHelper::map($energy, 'id', 'energy'),
                        'options' => ['multiple' => true, 'search' => true, 'placeholder' => 'Select Breed Energy...'],
                    ]); ?>
                    <?= $form->field($modelCoat, 'id_coat')->widget(Select2::classname(), [
                        'value' => 'id',
                        'attribute' => 'coat',
                        'value' => 'id',
                        'data' => ArrayHelper::map($coat, 'id', 'coat_size'),
                        'options' => ['multiple' => true, 'search' => true, 'placeholder' => 'Select Breed Energy...'],
                    ]); ?>
                    <?= $form->field($modelSize, 'id_size')->widget(Select2::classname(), [
                        'value' => 'id',
                        'attribute' => 'size',
                        'value' => 'id',
                        'data' => ArrayHelper::map($size, 'id', 'size'),
                        'options' => ['multiple' => true, 'search' => true, 'placeholder' => 'Select Breed Energy...'],
                    ]); ?>
                </div>
                <div class="box-footer">
                    <!-- Submit Button -->
                    <?= Html::submitButton('Salvar', ['class' => 'btn btn-success pull-right', 'name' => 'submit-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            <!-- /.box-body -->
            </div>
            
        </div>
    </div>
</section>

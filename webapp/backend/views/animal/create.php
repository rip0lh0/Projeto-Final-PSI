<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\fileupload\FileUploadUI;

/* @var $this yii\web\View */
/* @var $model common\models\animal */

$this->title = 'Novo Animal';
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
                        <!-- Info Name -->
                        <?= $form->field($animalModel, 'nome') ?>
                        <!-- Info Type Of Animal -->
                         <?= $form->field($animalModel, 'id_tipo')->dropDownList($tiposAnimais); ?>
                        <!-- Info Description -->
                        <?= $form->field($animalModel, 'descricao') ?>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ficha Do Animal</h3>
                    </div>
                    <div class="box-body">
                        <!-- Breed Name -->
                        <?= $form->field($racaModel, 'nome') ?>
                        <!-- Breed Description -->
                        <?= $form->field($racaModel, 'tipo')->dropDownList([
                            'Indefinida' => 'Indefinida',
                            'Pura' => 'Pura',
                            'Cruzada' => 'Cruzada'
                        ]); ?>
                        <!-- Animal File Has Chip -->
                        <?= $form->field($fichaModel, 'chip')->dropDownList([
                            '0' => 'Não',
                            '1' => 'Sim'
                        ]); ?>
                        <!-- Animal Gender -->
                        <?= $form->field($fichaModel, 'genero')->dropDownList([
                            'M' => 'Masculino',
                            'F' => 'Feminino'
                        ]); ?>
                        <!-- Animal Size -->
                        <?= $form->field($fichaModel, 'tamanho') ?>
                        <!-- Animal Age -->
                        <?= $form->field($fichaModel, 'idade') ?>
                        <!-- Animal Neutered -->
                        <?= $form->field($fichaModel, 'castrado') ?>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Extra</h3>
                    </div>
                    <div class="box-body">
                        <!-- Breed Name -->
                        <?= $form->field($canilAnimalModel, 'descricao')->textarea(['rows' => '8']) ?>
                        <!-- Imagens -->
                        <?= $form->field($uploadModel, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                    </div>

                    <div class="box-footer">
                        <!-- Submit Button -->
                        <?= Html::submitButton('Finalizar', ['class' => 'btn btn-info btn-lg pull-right', 'name' => 'submit-button']) ?>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

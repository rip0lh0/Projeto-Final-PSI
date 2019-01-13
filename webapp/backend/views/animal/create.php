<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var  $this yii\web\View */
/* @var  $model common\models\animal */

$this->title = 'Novo Animal';

$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$script =
    '$.post("' . Url::to(['animal/subbreed', 'id' => '']) . '" + $(this).val(), function( data ) { 
        $("#animalform-breeds").html( data );
    });';

?>
<div class="content">
    <div class="row">
       <?php $form = ActiveForm::begin(['id' => 'create-animal-form']); ?>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informação Básica</h3>
                    </div>
                    <div class="box-body">
                        <!-- Name -->
                        <?= $form->field($model, 'name')->textInput(); ?>
                        <!-- Description -->
                        <?= $form->field($model, 'description')->textInput(); ?>
                        <!-- Chip Number -->
                        <?= $form->field($model, 'chip')->textInput(); ?>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ficha Do Animal</h3>
                    </div>
                    <div class="box-body">
                        <?= $form->field($model, 'id_energy')->dropDownList(
                            ArrayHelper::map($energy, 'id', 'energy')
                        ); ?>
                        <?= $form->field($model, 'id_coat')->dropDownList(
                            ArrayHelper::map($coat, 'id', 'coat_size')
                        ); ?>
                        <?= $form->field($model, 'id_size')->dropDownList(
                            ArrayHelper::map($size, 'id', 'size')
                        ); ?>
                        <!-- Animal Gender -->
                        <?= $form->field($model, 'gender')->dropDownList([
                            'M' => 'Masculino',
                            'F' => 'Feminino'
                        ]); ?>
                        <!-- Animal Size -->
                        <?= $form->field($model, 'weight') ?>
                        <!-- Animal Age -->
                        <?= $form->field($model, 'age') ?>
                        <!-- Animal Neutered -->
                        <?= $form->field($model, 'neutered')->dropDownList([
                            '0' => 'Sim',
                            '1' => 'Não'
                        ]); ?>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fotos</h3>
                    </div>
                    <div class="box-body">
                        <?= $form->field($model, 'photos[]')->widget(FileInput::classname(), [
                            'options' => [
                                'accept' => 'image/*',
                                'multiple' => true
                            ],
                            'pluginOptions' => [
                                'showUpload' => false,
                                'showRemove' => true,
                                'maxFileCount' => 4
                            ]
                        ]); ?>
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

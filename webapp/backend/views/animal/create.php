<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kato\DropZone;
use frontend\assets\AppAsset;

/* @var  $this yii\web\View */
/* @var  $model common\models\animal */

$this->title = 'Novo Animal';

$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$pro_files = '';
if (!array_key_exists('error', $files)) {
    foreach ($files as $key => $file) {
        $mockfile = [
            'name' => $file['name'],
            'size' => $file['size'],
        // 'imageId' => $file['id'],
        // 'title' => $file['name']
        ];

        $pro_files .= 'var mockFile = ' . Json::encode($mockfile) . ';';

        $pro_files .= 'myDropzone.files.push(mockFile);';
        $pro_files .= 'myDropzone.emit("addedfile", mockFile);';
        $pro_files .= 'myDropzone.createThumbnailFromUrl(mockFile, "' . (Url::base(true) . '/' . $file['url']) . '");';
    }
}


$dropzoneScript = '
    $("#previews").addClass("container-fluid");  
    $(function() {
        ' . $pro_files . '
    });
';

$this->registerJs($dropzoneScript);
?>



<div class="content">
    <div class="row">
        <?php 
        $form = ActiveForm::begin([
            'id' => 'create-animal-form'
        ]); ?>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informação Básica</h3>
                    </div>
                    <div class="box-body">
                        <?php 
                        if (array_key_exists('Error', $result)) {
                            echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="fas fa-ban"></i> Error</h4>';

                            foreach ($result['Error'] as $key => $value) {
                                echo '<p>' . $value['0'] . '</p>';
                            }

                            echo '</div>';
                        }
                        ?>
                        <!-- Name -->
                        <?= $form->field($model, 'name')->textInput(); ?>
                        <!-- Description -->
                        <?= $form->field($model, 'description')->textarea(['rows' => '6']); ?>
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
                        <div id="loading-overlay" class="loading" hidden><i class="fas fa-sync fa-4x fa-spin"></i></div>
                        <?=
                        DropZone::widget([
                            'options' => [
                                'class' => 'row',
                                'thumbnailWidth' => '250',
                                'thumbnailHeight' => '250',
                                'paramName' => 'uploaded_file',
                                'acceptedFiles' => 'image/jpeg, image/png',
                                'url' => Url::to(['animal/upload-temp-file']),
                                'maxFilesize' => '6',
                                'previewTemplate' => '
                                    <div class="col-md-2">
                                        <div class="dz-details bg-overlay">
                                            <div class="dz-size" data-dz-size></div>
                                            <img data-dz-thumbnail/>
                                            <i class="far fa-times-circle fa-2x" data-dz-remove></i>
                                        </div>
                                        <div class="dz-progress progress">
                                            <div data-dz-upload class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress>
                                            </div>
                                        </div>
                                    </div>
                                '
                            ],
                            'clientEvents' => [
                                'addedfile' => '
                                    function(file) {
                                        if(this.files.length > this.options.maxFilesize){
                                            $("#maxfiles").attr("hidden", false);
                                            this.removeFile(file);
                                        }else {
                                            if (this.files.length) {
                                                var _i, _len;
                                                for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) // -1 to exclude current file
                                                {
                                                    if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString())
                                                    {
                                                        $("#samefiles").attr("hidden", false);
                                                        this.removeFile(file);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ',
                                'processing' => '
                                    function () {
                                        $("#loading-overlay").attr("hidden", false);
                                    }
                                ',
                                'queuecomplete' =>
                                    'function () {
                                        $("#loading-overlay").attr("hidden", true);
                                    }
                                ',
                                'removedfile' => "
                                    function(file){
                                        $.ajax({
                                            type: 'POST',
                                            url: '" . Url::to(['animal/remove-temp-file']) . "',
                                            data: {
                                                name: file.name
                                            },
                                            sucess: function(data){
                                                console.log('success: ' + data);
                                            }
                                        });
                                    }"
                            ],
                        ]);
                        ?>
                        <br>
                        <div id="maxfiles" class="alert alert-danger alert-dismissible" hidden>
                            Numero Máximo de Ficheiros: 6
                        </div>
                        <div id="samefiles" class="alert alert-danger alert-dismissible" hidden>
                            Ficheiro com nome igual 
                        </div>
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


                       

<?php 
/* Helpers */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/* Kartik */
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* Kato */
use kato\DropZone;
use common\models\KennelAnimal;

$pro_files = '';

if (!array_key_exists('error', $files)) {
    foreach ($files as $key => $file) {
        $mockfile = [
            'name' => $file['name'],
            'size' => $file['size']
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

?>

<?php $form = ActiveForm::begin(['id' => 'update-animal-form']); ?>
<div class="row">
    <!-- Animal Basic Info -->
    <div class="col-md-6">

            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Informação Básica</h3>
            </div>
            <div class="box-body">
               
                <div class="col-md-8">
                    <!-- Name -->   
                    <?= $form->field($model, 'name')->textInput(); ?>
                </div>
                
                <div class="col-md-4">
                    <?= $form->field($model, 'status')->dropDownList(
                        [
                            KennelAnimal::STATUS_FOR_ADOPTION => KennelAnimal::status(KennelAnimal::STATUS_FOR_ADOPTION)["msg"],
                            KennelAnimal::STATUS_IN_KENNEL => KennelAnimal::status(KennelAnimal::STATUS_IN_KENNEL)["msg"],
                            KennelAnimal::STATUS_ADOPTED => KennelAnimal::status(KennelAnimal::STATUS_ADOPTED)["msg"],
                            KennelAnimal::STATUS_IN_TREATMENT => KennelAnimal::status(KennelAnimal::STATUS_IN_TREATMENT)["msg"]
                        ]
                    ); ?>
                </div>
                <div class="col-md-12">
                    <!-- Description -->
                    <?= $form->field($model, 'description')->textarea(['rows' => '4', 'style' => 'min-width: 100%; max-width: 100%;']); ?>
                </div>
            </div>
        </div>

    </div>
    <!-- Animal File -->
    <div class="col-md-6">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">Ficha Do Animal</h3>
            </div>
            <div class="box-body">

                <div class="col-md-12">
                    <!-- Chip Number -->
                    <?= $form->field($model, 'chip')->textInput(['disabled' => ($model->chip) ? true : false]); ?>
                </div>

                <div class="col-md-4">
                <?= $form->field($model, 'id_energy')->dropDownList(
                    ArrayHelper::map($energy, 'id', 'energy')
                ); ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'id_coat')->dropDownList(
                        ArrayHelper::map($coat, 'id', 'coat_size')
                    ); ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'id_size')->dropDownList(
                        ArrayHelper::map($size, 'id', 'size')
                    ); ?>
                </div>

                <div class="col-md-4">
                    <!-- Animal Gender -->
                    <?= $form->field($model, 'gender')->dropDownList([
                        'M' => 'Masculino',
                        'F' => 'Feminino'
                    ]); ?>
                </div>

                <div class="col-md-4">
                    <!-- Animal Size -->
                    <?= $form->field($model, 'weight') ?>
                </div>

                <div class="col-md-4">
                    <!-- Animal Age -->
                    <?= $form->field($model, 'age') ?>
                </div>
                
                <div class="col-md-12">
                    <!-- Animal Neutered -->
                    <?= $form->field($model, 'neutered')->dropDownList([
                        '0' => 'Sim',
                        '1' => 'Não'
                    ]); ?>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Photos Upload -->
<div class="row">
    <div class="col-md-12">
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
                        'maxFiles' => '6',
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
                        'queuecomplete' => '
                            function () {
                                $("#loading-overlay").attr("hidden", true);
                            }
                        ',
                        'maxfilesexceeded' => '
                            function(file) {
                                $("#maxfiles").attr("hidden", false);
                                this.removeFile(file);
                            }   
                        ',
                        'removedfile' => '
                            function(file){
                                $.ajax({
                                    type: "POST",
                                    url: "' . Url::to(['animal/remove-temp-file']) . '",
                                    data: {
                                        name: file.name
                                    },
                                    sucess: function(data){
                                        
                                    }
                                });
                            }'
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
</div>
<?php ActiveForm::end(); ?>


<?php $this->registerJs($dropzoneScript); ?>
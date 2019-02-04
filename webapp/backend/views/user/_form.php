<?php

use backend\assets\AppAsset;

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = "Editar Perfil";

$script_locals =
    '$.post("' . Yii::$app->urlManager->createUrl('user/sub-locals?id_parent=') . '" + $(this).val(), 
        function( data ) {
            $("select#profileform-id_sublocal" ).html( data );
            $("select").niceSelect("update");
        }
    );';


$script_edit = '
    $("#profile-edit-btn").on("click", function(){
        $("#kennel-profile-form").find(":disabled").attr("disabled", false);
        $("#kennel-profile-form").find("#profileform-username").attr("disabled", true);
        $("#kennel-profile-form").find("button[type=\'submit\']").removeClass("hidden");

        $(this).hide();
    });
';

$this->registerJs($script_edit);

AppAsset::register($this);
?>

<?php $form = ActiveForm::begin(['id' => 'kennel-profile-form']); ?>
<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">Profile</h3>
    </div>

    <div class="box-body">
        <div class="col-md-12">
            <?= $form->field($model_profile, 'username')->textInput(['disabled' => true]); ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model_profile, 'name')->textInput(['disabled' => true]); ?>  
        </div>
        <div class="col-md-12">
            <?= $form->field($model_profile, 'email')->textInput(['disabled' => true]); ?>   
        </div>
        <div class="col-md-3">
            <?= $form->field($model_profile, 'id_local')->dropDownList($locals, [
                'onchange' => $script_locals,
                'disabled' => true
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model_profile, 'id_sublocal')->dropDownList(
                $sub_locals,
                [
                    'disabled' => true
                ]
            ); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model_profile, 'address')->textInput(['disabled' => true]); ?>   
        </div>
        <div class="col-md-4">
            <?= $form->field($model_profile, 'facebook')->textInput(['disabled' => true]); ?>   
        </div>
        <div class="col-md-4">
            <?= $form->field($model_profile, 'instagram')->textInput(['disabled' => true]); ?>   
        </div>
        <div class="col-md-4">
            <?= $form->field($model_profile, 'youtube')->textInput(['disabled' => true]); ?>   
        </div>
        <div class="col-md-6">
            <?= $form->field($model_profile, 'phone')->textInput(['disabled' => true]); ?>   
        </div>
        <div class="col-md-6">
            <?= $form->field($model_profile, 'cell_phone')->textInput(['disabled' => true]); ?>   
        </div>
    </div>
    
    <div class="box-footer">
        <?= Html::submitButton('Finalizar', ['class' => 'btn btn-info pull-right hidden', 'name' => 'submit-button']) ?>
        <?= Html::button('Editar', ['id' => 'profile-edit-btn', 'class' => 'btn btn-default pull-right']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

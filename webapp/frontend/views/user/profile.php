<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;

$this->title = 'Pet4All - Profile';
$this->params['breadcrumbs'][] = $this->title;


$script_edit = '
    $("#profile-edit-btn").on("click", function(){
        $("#profile-form").find(":disabled").attr("disabled", false);
        $("#profile-form").find("#profileform-username").attr("disabled", true);
        $("#profile-form").find("button[type=\'submit\']").removeClass("hidden");

        $(this).hide();
    });
';

$this->registerJs($script_edit);

?>

<div class="breadcumb_area bg-img" style="background-image: url('<?= Url::base(true) ?>/images/profile_bg.jpg'); height: 100%;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 align-content-center">
                <img src="<?= Url::base(true) ?>/images/photo_placeholder.jpg" class="circle img-thumbnail mx-auto d-block us-photo" style="margin: 60px 0;">
            </div>
        </div>
    </div>
</div>

<div class="checkout_area section-padding-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="checkout_details_area clearfix">
                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'profile-form',
                        'formConfig' => ['showErrors' => false]
                    ]
                ); ?>
                <div class="row justify-content-center">
                    <div class="col-md-12 mb-3">
                        <?= $form->field($model_profile, 'username')->textInput(['autofocus' => true, 'disabled' => true]) ?>
                    </div>
                    <div class="col-md-12 mb-3">
                        <?= $form->field($model_profile, 'name')->textInput(['disabled' => true]) ?>
                    </div>
                    <div class="col-md-6 mb-3">
                            <?= $form->field($model_profile, 'email')->textInput(['disabled' => true]) ?>
                    </div>
                    <div class="col-md-6 mb-3">
                            <?= $form->field($model_profile, 'phone')->textInput(['disabled' => true]) ?>
                    </div>
                    <div class="col-12" style="margin: 20px;">
                        <?= Html::submitButton('Salvar', ['class' => 'btn btn-info pull-right hidden', 'style' => 'font-size: 1.0em;', 'name' => 'submit-button']) ?>
                        <?= Html::button('Editar', ['id' => 'profile-edit-btn', 'class' => 'btn btn-primary pull-right btn-lg ', 'style' => 'font-size: 1.0em;']) ?>
                    </div>
                    <div class="container">
                        <?= $form->errorSummary($model_profile, ['header' => '', 'class' => 'alert alert-danger']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

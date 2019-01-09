<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;



$this->title = $profileInfo->name;
AppAsset::register($this);
?>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?= Html::img('@web/img/default-user.png', ['class' => 'profile-user-img img-responsive img-circle']); ?>

                    <h3 class="profile-username text-center"><?= $profileInfo->name ?></h3>

                    <p class="text-muted text-center"><?= $user->local->name ?></p>

                    <ul class="list-group list-group-unbordered">
                        <hr>
                        <strong><i class="fa fa-paw"></i><b> Animais</b> <a class="pull-right"><?= $nAnimais ?></a></strong>
                        <hr>
                        <strong><i class="fa fa-book"></i><b> Adoções</b> <a class="pull-right"><?= $nAdocoes ?></a></strong>
                    </ul>
                </div>
            <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Profile</h3>
                </div>
                <?php $form = ActiveForm::begin(['id' => 'profile-form']); ?>
                <div class="box-body">
                    <?= $form->field($profileInfo, 'name')->textInput(['disabled' => true]); ?>
                    <?= $form->field($profileInfo, 'nif')->textInput(['disabled' => true]); ?>
                </div>
                <div class="box-footer">
                    <!-- Submit Button -->
                    <?= Html::submitButton('<i class="fa fa-pencil"></i> Editar', ['class' => 'btn btn-default pull-right', 'name' => 'submit-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            <!-- /.box-body -->
            </div>
            
        </div>
    </div>
</section>

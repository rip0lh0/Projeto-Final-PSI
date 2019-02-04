<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$script = '
    $("#message-modal").modal("show");
    $("#message-modal").on("hide.bs.modal", function (e) {
        $("#message-modal-container").empty();
    });
';


$this->registerJs($script);
?>
<div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <?php 
        $form = ActiveForm::begin([
            'id' => 'answer-form'
        ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                
                <div class="col-10">
                    <?= $form->field($model, 'KOMENTAR', ['options' => ['class' => 'input-group-sm']])->textInput()->label(false); ?>
                </div>
                <div class="col-2">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-info btn-sm btn-block', 'name' => 'submit-button']) ?>
                </div>
            </div>
            <div class="modal-body">
                <?php foreach ($messages as $key => $message) { ?>
                <div class="media">
                    <div class="media-body">
                        <h5 class="media-heading"><?= ($message->user->kennel) ? $message->user->kennel->name : $message->user->adopter->name; ?> </h5>
                        <span class="message-date"><?= date('d-m-Y H:i', $message->created_at); ?></span>
                        <p class="message-text"><?= $message->message ?></p>
                    </div>
                </div>
                <hr>
                    <?php 
                } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

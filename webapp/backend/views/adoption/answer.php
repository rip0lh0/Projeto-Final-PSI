<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="col-md-12">
    <!-- Box Comment -->
    <div class="box box-widget">
        <div class="box-header">
                <?php 
                $form = ActiveForm::begin([
                    'id' => 'answer-form'
                ]); ?>
                <div class="col-md-11">
                    <?= $form->field($model, 'KOMENTAR')->textInput()->label(false); ?>
                </div>
                <div class="col-md-1">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-info btn-sm btn-block', 'name' => 'submit-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </form>

        </div>
        <div class="box-body box-comments">
            <div class="box-comment">
                <?php foreach ($msg as $key => $value) { ?>
                     <div class="comment-text">
                        <span class="username" style="margin-left: -40px; margin-bottom: 15px;">
                            <?= ($value->user->kennel) ? 'Você' : $value->user->adopter->name; ?>
                            <span class="text-muted pull-right"><?= date('d-m-Y H:i', $value->created_at); ?></span>
                        </span><!-- /.username -->
                       <?= $value->message ?>
                    </div>
                    <hr>
                    <?php 
                } ?>

            </div>
        </div>
    </div>
<!-- /.box -->
</div>

<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use backend\assets\AppAsset;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\widgets\ActiveForm;
use common\models\Schedule;
use yii\helpers\ArrayHelper;



$this->title = $profile->name;
$local = $profile->local;

$script = '
    $(":checkbox").change(function() {
        var container =  $("#hours_lunch_container");

        if(this.checked) {
            container.attr("hidden", false);
        }else{
            container.attr("hidden", true);
        }
    });
';

$this->registerJs($script);

AppAsset::register($this);
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php 
            if (array_key_exists('error', $result)) {
                echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="fas fa-ban"></i> Error</h4>';

                foreach ($result['error'] as $key => $value) {
                    echo '<p>' . $value . '</p>';
                }

                echo '</div>';
            }
            ?>
        </div>
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?= Html::img('@web/img/default-user.png', ['class' => 'profile-user-img img-responsive img-circle']); ?>

                    <h3 class="profile-username text-center"><?= $profile->name ?></h3>

                    <p class="text-muted text-center"><?= ($local != null && $local->parent != null) ? $local->parent->name . ', ' : ''; ?><?= ($local != null) ? $local->name : ''; ?></p>

                    <ul class="list-group list-group-unbordered">
                        <hr>
                        <strong><i class="fa fa-paw"></i><b> Animais</b> <a class="pull-right"> <?= $nAnimais ?></a></strong>
                        <hr>
                        <strong><i class="fa fa-book"></i><b> Adoções</b> <a class="pull-right"> <?= $nAdocoes ?></a></strong>
                    </ul>
                </div>
            <!-- /.box-body -->
            </div>

            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?php if ($schedules) { ?>
                    <div class="row">
                        <div class="col-md-3" style="padding-right: 0;">
                            <?php
                            foreach (Schedule::DAY_WEEK as $key => $value) {
                                echo '<h4 class="text-right">' . $value . ':</h4>';
                            }
                            ?>
                        </div>
                        <div class="col-md-9">
                            <?php

                            foreach (Schedule::DAY_WEEK as $key => $value) {
                                $hour_open = null;
                                $hour_close = null;
                                $hour_lunch_open = null;
                                $hour_lunch_close = null;

                                foreach ($schedules as $key_schedule => $schedule) {
                                    if ($schedule->day == (string)$key) {
                                        $hour_open = date("H:i", strtotime($schedule->open_time));
                                        $hour_close = date("H:i", strtotime($schedule->close_time));
                                        if ($schedule->lunch_open) {
                                            $hour_lunch_open = date("H:i", strtotime($schedule->lunch_open));
                                            $hour_lunch_close = date("H:i", strtotime($schedule->lunch_close));
                                        }
                                    }
                                }

                                if ($hour_open) {
                                    echo '<h4>';
                                    echo $hour_open . '-';
                                    if ($hour_lunch_open) {
                                        echo $hour_lunch_open . ' e ';
                                        echo $hour_lunch_close . '-';
                                    }
                                    echo $hour_close;

                                    echo '</h4>';
                                } else {
                                    echo '<h4>Fechado</h4>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                        <?php 
                    } ?>
                    <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#myModal">Alterar Horário</button>
                </div>
            <!-- /.box-body -->
            </div>
        </div>

        <!-- Profile Form -->
        <div class="col-md-9">
            <?= $this->render("_form", [
                'model_profile' => $model_profile,
                'locals' => $locals,
                'sub_locals' => $sub_locals
            ]); ?>
        </div>
        <!-- END Profile Form -->
    </div>
</section>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <?php 
    $form = ActiveForm::begin(['id' => 'schedule-form']); ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-15">
                    <div class="col-md-12">
                        <?=
                        $form->field($model_schedule, 'days_week')->widget(Select2::className(), [
                            'data' => Schedule::DAY_WEEK,
                            'size' => Select2::MEDIUM,
                            'hideSearch' => true,
                            'options' => [
                                'placeholder' => 'Dias',
                                'multiple' => true
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label(false); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                            <h5>Abertura: </h5>
                    </div>
                    <div class="col-md-10">
                        <?=
                        // Oping
                        $form->field($model_schedule, 'hours[open]')->widget(TimePicker::className(), [
                            'pluginOptions' => [
                                'defaultTime' => '08:00',
                                //'showSeconds' => true,
                                'showMeridian' => false,
                                'minuteStep' => 15,
                            ]
                        ])->label(false);
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model_schedule, 'has_lunch')->checkbox(); ?>
                    </div>
                </div>

                <div id="hours_lunch_container" class="row" <?= (!$model_schedule->has_lunch) ? 'hidden' : '' ?>>
                    <div class="col-md-2">
                            <h5>Almoço: </h5>
                    </div>
                    <div class="col-md-5">
                        <?=
                        $form->field($model_schedule, 'hours_lunch[open]')->widget(TimePicker::className(), [
                            'pluginOptions' => [
                                'defaultTime' => '13:00',
                                //'showSeconds' => true,
                                'showMeridian' => false,
                                'minuteStep' => 15,
                            ]
                        ])->label(false);
                        ?>
                    </div>
                    <div class="col-md-5">
                        <?=
                        $form->field($model_schedule, 'hours_lunch[close]')->widget(TimePicker::className(), [
                            'pluginOptions' => [
                                'defaultTime' => '14:00',
                                //'showSeconds' => true,
                                'showMeridian' => false,
                                'minuteStep' => 15,
                            ]
                        ])->label(false);
                        ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2">
                            <h5>Fecho: </h5>
                    </div>
                        <div class="col-md-10">
                            <?=
                            $form->field($model_schedule, 'hours[close]')->widget(TimePicker::className(), [
                                'pluginOptions' => [
                                    'defaultTime' => '18:00',
                                    'showMeridian' => false,
                                    'minuteStep' => 15,
                                ]
                            ])->label(false);
                            ?>
                        </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    <?php ActiveForm::end(); ?>
</div><!-- /.modal -->
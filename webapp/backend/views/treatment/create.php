<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;

use kartik\date\DatePicker;


$this->title = 'Criar Tratamento';

$this->params['breadcrumbs'][] = $this->title;

$valueScript = '';

if (!empty($model->vaccine_date)) {
    foreach ($model->vaccine_date as $key => $value) {
        $valueScript .= '
            $(function() {
                var template = $("#vaccine-model").clone(true);
                var lastRow = $("#vaccine .row:last-child");

                var arr_input = template.find("input");
                var input = arr_input[1];
                var id = template.find(input).attr("id");

                template.find(arr_input[0]).val("' . $model->vaccine_name[$key] . '");
                template.find(arr_input[1]).val("' . $model->vaccine_date[$key] . '");

                id += numvaccine;

                template.removeAttr("id");
                template.attr("hidden", false);

                template.find(input).attr("id", id);
                template.find(input).kvDatepicker();
                
                template.insertBefore(lastRow);
                numvaccine++;
            });
        ';
    }
}

$formScript = '
    var numvaccine = 0;
    
    $("#add-new-vaccine").click(function() {
        var template = $("#vaccine-model").clone(true);
        var lastRow = $("#vaccine .row:last-child");

        var input = template.find("input")[1];
        var id = template.find(input).attr("id");

        id += numvaccine;

        template.removeAttr("id");
        template.attr("hidden", false);

        template.find(input).attr("id", id);
        template.find(input).kvDatepicker();
        
        template.insertBefore(lastRow);
        numvaccine++;
    });

    $(".remove-vaccine").click(function() {
        $(this).parent().parent().remove();
    });
';





$this->registerJs($formScript);
$this->registerJs($valueScript);
?>

<div class="content">
    <div class="row">
        <?php 
        $form = ActiveForm::begin([
            'id' => 'create-treatment-form'
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
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vacinas</h3>
                    </div>
                    <div id="vaccine" class="box-body">
                        <div id="vaccine-model" class="row" hidden>
                            <div class="col-md-9">
                                <?= $form->field($model, 'vaccine_name[]', [
                                    'addon' => [

                                        'prepend' => ['content' => '<i class="fa fa-syringe" ></i>']

                                    ]
                                ])->textInput()->label(false); ?>
                            </div>
                            <div class="col-md-2">
                                    <?= $form->field($model, 'vaccine_date[]')->widget(DatePicker::classname(), [
                                        'options' => [
                                            'placeholder' => 'Data',
                                        ],
                                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                        'pluginOptions' => [
                                            'format' => 'dd/mm/yyyy',
                                            'autoclose' => true,
                                        ],
                                    ])->label(false); ?>
                                <?php
                                ?>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-block remove-vaccine"><i class="fas fa-times"></i></button>                                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button id="add-new-vaccine" type="button" class="btn btn-blue btn-block"><i class="fas fa-plus"></i></button>
                            </div>
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
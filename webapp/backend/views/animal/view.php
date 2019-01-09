<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\animal */

var_dump($model);


//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
<div class="row">
       <?php $form = ActiveForm::begin(['id' => 'animal-form']); ?>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informação Básica</h3>
                    </div>
                    <div class="box-body">
                        
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ficha Do Animal</h3>
                    </div>
                    <div class="box-body">
                       
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Extra</h3>
                    </div>
                    <div class="box-body">
                       
                    </div>

                    <div class="box-footer">

                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>

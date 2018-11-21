<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnimalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tabela</h3>
                    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']) . ' Novo Animal', ['create'], ['class' => 'btn btn-sm btn-warning pull-right']) ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Animal</th>
                                    <th>Raca</th>
                                    <th>Data Entrada</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cão</td>
                                    <td>Elias</td>
                                    <td>12/12/12</td>
                                    <td><span class="label label-success">Para Adoção</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= print_r($animais) ?>

    
</div>

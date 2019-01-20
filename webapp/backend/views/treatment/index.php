<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;
use common\models\KennelAnimal;

$this->title = 'Tratamentos: ' . $animal->name;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <?= Html::a('<i class="fa fa-plus"></i> Adicionar', ['treatment/create', 'id_animal' => $animal->id], ['class' => 'btn bg-purple pull-right']) ?>
                </div>
                <div class="box-body">
                    <?= DataTables::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table table-bordered table-striped'],
                        'clientOptions' => [
                            'info' => true,
                            'responsive' => true,
                            'searching' => false,
                        ],
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'headerOptions' => ['width' => '150'],
                            ],
                            [
                                // 'headerOptions' => ['width' => '300'],
                                'attribute' => 'name',
                            ],
                            [
                                // 'headerOptions' => ['width' => '300'],
                                'attribute' => 'description',
                            ],
                            [
                                'headerOptions' => ['width' => '140'],
                                'label' => 'Ações',
                                'format' => 'html',
                                'value' => function ($data) {
                                    $htmlData = "";
                                    /* Animal View */
                                    $htmlData .= Html::a('<i class="far fa-eye"></i>', ['treatment/view', 'id_treatment' => $data->id], ['class' => 'btn btn-info btn-xs', 'style' => 'margin: 0 2px;', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Ver Dados']);
                                    $htmlData .= Html::a('<i class="far fa-edit"></i>', ['treatment/update', 'id_treatment' => $data->id], ['class' => 'btn btn-warning btn-xs', 'style' => 'margin: 0 2px;', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Editar Dados']);
                                    /* Delete Animal */
                                    $htmlData .= Html::a(
                                        '<i class="far fa-trash-alt"></i>',
                                        [
                                            'treatment/delete', 'id_treatment' => $data->id
                                        ],
                                        [
                                            'class' => 'btn btn-danger btn-xs',
                                            'style' => 'margin: 0 2px;',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'title' => 'Eliminar'
                                        ]
                                    );
                                    return $htmlData;
                                },
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
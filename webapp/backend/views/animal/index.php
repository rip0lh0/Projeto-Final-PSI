<?php

use yii\helpers\Html;
use common\models\AnimalState;
use fedemotta\datatables\DataTables;

$this->title = 'Animals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= $this->title ?></h3>
                    <?= Html::a('<i class="fa fa-plus"></i> Adicionar', ['/animal/create'], ['class' => 'btn bg-purple pull-right']) ?>
                </div>
                <div class="box-body">
                    <?= DataTables::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table table-bordered table-striped'],
                        'clientOptions' => [
                            'info' => true,
                            'responsive' => true,
                            'searching' => false,
                        ],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'animal.animalFile.chip',
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:d/m/Y']
                            ],
                            [
                                'attribute' => 'state',
                                'format' => 'html',
                                'value' => function ($data) {
                                    return '<span class="label label-danger">' . $data->state . '</span>';
                                },
                            ],
                            [
                                'label' => 'Ações',
                                'format' => 'html',
                                'value' => function ($data) {
                                    return Html::a('Ver', ['animal/view', 'id' => $data->id], ['class' => 'btn btn-primary btn-sm']);
                                },
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>
</div>

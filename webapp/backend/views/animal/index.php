<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;
use common\models\KennelAnimal;

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
                            [
                                'headerOptions' => ['width' => '300'],
                                'attribute' => 'animal.name',
                            ],
                            [
                                'headerOptions' => ['width' => '140'],
                                'attribute' => 'animal.chip'
                            ],
                            [
                                //'headerOptions' => ['width' => '60'],
                                'attribute' => 'animal.age'
                            ],
                            [
                                //'headerOptions' => ['width' => '60'],
                                'attribute' => 'animal.weight'
                            ],
                            [
                                'headerOptions' => ['width' => '140'],
                                'attribute' => 'animal.size.size'
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:d/m/Y']
                            ],
                            [
                                'headerOptions' => ['width' => '80'],
                                'attribute' => 'status',
                                'options' => ['class' => 'teste'],
                                'format' => 'html',
                                'value' => function ($data) {
                                    $state = KennelAnimal::status($data->status);
                                    $htmlData = "";
                                    $htmlData .= '<h4 style="margin: 0;"><span class="label label-' . $state['options'] . '">' . $state['msg'] . '</span></h4>';
                                    //$htmlData .= Html::a($state['msg'] . ' <i class="fa fa-eye"></i>', ['animal/view', 'id' => $data->id], ['class' => 'btn btn-info btn-xs btn-block']);
                                    return $htmlData;
                                },
                            ],
                            [
                                'headerOptions' => ['width' => '140'],
                                'label' => 'Ações',
                                'format' => 'html',
                                'value' => function ($data) {
                                    $htmlData = "";
                                    $htmlData .= Html::a('<i class="fa fa-eye"></i>', ['animal/view', 'id' => $data->id], ['class' => 'btn btn-info btn-xs', 'style' => 'margin: 0 2px;']);
                                    if ($data->status != KennelAnimal::STATUS_ADOPTED && $data->status != KennelAnimal::STATUS_BAN) {
                                        if ($data->status == KennelAnimal::STATUS_DELETED) {
                                            $htmlData .= Html::a('<i class="fa fa-history"></i>', ['animal/delete', 'id_animal' => $data->id], ['class' => 'btn btn-success btn-xs', 'style' => 'margin: 0 2px;']);
                                        } else {
                                            $htmlData .= Html::a('<i class="fa fa-pencil"></i>', ['animal/update', 'id_animal' => $data->id], ['class' => 'btn btn-warning btn-xs', 'style' => 'margin: 0 2px;']);
                                            $htmlData .= Html::a('<i class="fa fa-medkit"></i>', ['animal/medical', 'id_animal' => $data->id], ['class' => 'btn btn-success btn-xs', 'style' => 'margin: 0 2px;']);
                                            $htmlData .= Html::a('<i class="fa fa-trash"></i>', ['animal/delete', 'id_animal' => $data->id], ['class' => 'btn btn-danger btn-xs', 'style' => 'margin: 0 2px;']);
                                        }
                                    }
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


<script>

</script>
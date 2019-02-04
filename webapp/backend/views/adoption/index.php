<?php

use fedemotta\datatables\DataTables;


use yii\helpers\Html;
use common\models\User;
use common\models\Message;


$this->title = 'Adoções';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= $this->title ?></h3>
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
                                'label' => 'Nome do adotante',
                                'attribute' => 'adopter',
                                'format' => 'html',
                                'value' => function ($data) {
                                    $htmlData = "";
                                    $htmlData = User::find()->where(['id' => $data->id_adopter])->one()->adopter->name;
                                    foreach ($data->messages as $key => $value) {
                                        if ($value->status == Message::STATUS_UNREAD) {
                                            $htmlData .= "<span class='label label-primary pull-right'>New</span>";
                                            break;
                                        }
                                    }
                                    return $htmlData;
                                },
                            ],
                            [
                                'label' => 'Animal',
                                'attribute' => 'kennelAnimal.animal.name'
                            ],
                            [
                                'label' => 'Chip do Animal',
                                'attribute' => 'kennelAnimal.animal.chip'
                            ],
                            [
                                'headerOptions' => ['width' => '300'],
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:d/m/Y']
                            ],
                            [
                                'headerOptions' => ['width' => '140'],
                                'label' => 'Ações',
                                'format' => 'html',
                                'value' => function ($data) {
                                    $htmlData = "";
                                    /* Animal View */
                                    $htmlData .= Html::a('<i class="far fa-eye"></i>', ['adoption/answer', 'id_adoption' => $data->id], ['class' => 'btn btn-info btn-xs', 'style' => 'margin: 0 2px;']);
                                    /* Delete Animal */
                                    //$htmlData .= Html::a('<i class="far fa-trash-alt"></i>', ['animal/delete', 'id_kennelAnimal' => $data->id], ['class' => 'btn btn-' . (($data->status == KennelAnimal::STATUS_DELETED) ? 'success' : 'danger') . ' btn-xs', 'style' => 'margin: 0 2px;', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Tooltip on top']);

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
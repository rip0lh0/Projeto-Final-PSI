<?php

use yii\helpers\Html;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;

use common\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
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
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'username',
                            'email:email',
                            [
                                'headerOptions' => ['width' => '140'],
                                'label' => 'Ações',
                                'format' => 'html',
                                'value' => function ($data) {
                                    $htmlData = "";
                                    /* Animal View */
                                    $htmlData .= Html::a('<i class="far fa-eye"></i>', ['view', 'id' => $data->id], ['class' => 'btn btn-info btn-xs', 'style' => 'margin: 0 2px;', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Ver Dados']);
                                    if ($data->status != User::STATUS_DELETED) {
                                        if ($data->status != User::STATUS_ACTIVE) $htmlData .= Html::a('<i class="fas fa-check"></i>', ['activate', 'id' => $data->id], ['class' => 'btn btn-success btn-xs', 'style' => 'margin: 0 2px;', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Ver Dados']);

                                        if (Yii::$app->user->id != $data->id) $htmlData .= Html::a('<i class="far fa-trash-alt"></i>', ['delete', 'id' => $data->id], [
                                            'class' => 'btn btn-danger btn-xs',
                                            'data-method' => 'post',
                                        ]);
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

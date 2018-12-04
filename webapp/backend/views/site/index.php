<?php

use yii\helpers\Html;
use common\models\AnimalState;

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <!-- Info Boxes -->
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-facebook-f"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Shares <small>(Total)</small></span>
                    <span class="info-box-number">93,139</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-twitter"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tweets <small>(Total)</small></span>
                    <span class="info-box-number">93,139</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-share-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Adoções <small>(Total)</small></span>
                    <span class="info-box-number">93,139</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Adoption Table -->
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Pedidos De Adoção <small>(Recentes)</small></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Tipo Animal</th>
                                    <th>Raca</th>
                                    <th>Data Entrada <small>(Animal)</small></th>
                                    <th>Data Pedido</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                    <td>Cão</td>
                                    <td>Elias</td>
                                    <td><span class="label label-success">Adotado</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-right">Ver Todas</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Animal Table -->
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Animais <small>(Recentes)</small></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Tipo Animal</th>
                                    <th>Raca</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <?= Html::a('Ver Todas', ['/animal/index'], ['class' => 'btn btn-sm btn-info btn-flat pull-right']) ?>
                </div>
            </div>
        </div>
    </div>
</div>


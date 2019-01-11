<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Treatment */

$this->title = 'Create Treatment';
$this->params['breadcrumbs'][] = ['label' => 'Treatments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treatment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

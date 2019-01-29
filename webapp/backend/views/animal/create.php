<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kato\DropZone;
use frontend\assets\AppAsset;

/* @var  $this yii\web\View */
/* @var  $model common\models\animal */

$this->title = 'Novo Animal';

$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<section class="content">
   <?= $this->render('_form', [
       // Pre Define Values
        'coat' => $coat,
        'energy' => $energy,
        'size' => $size,
        'files' => $files,
      // Model
        'model' => $model,
      // UI Messages
        'result' => $result
    ]) ?>
</section>


                       

<?php

/* Helpers */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/* Kartik */
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* Kato */
use kato\DropZone;

/* @var $this yii\web\View */
/* @var $model common\models\animal */

$this->title = 'Editar: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>

<section class="content">
   <div class="row">
   <?php 
   if (array_key_exists('Error', $result)) {
      echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="fas fa-ban"></i> Error</h4>';
      foreach ($result['Error'] as $key => $value) {
         echo '<p>' . $value['0'] . '</p>';
      }
      echo '</div>';
   }
   ?>
   </div>

   <?= $this->render('_form', [
       // Pre Define Values
      'coat' => $coat,
      'energy' => $energy,
      'size' => $size,
      'files' => $files,
      // Model
      'model' => $model
   ]) ?>

</section>

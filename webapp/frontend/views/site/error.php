<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Erro:';
?>
<div class="raw">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="jumbotron">
                <h1>Não existe uma conta associada!</h1>
                <p>...</p>
                <p><a class="btn btn-primary btn-lg" href="site/signupMenu" role="button">Criar Utilizador!</a></p>
    </div> 

    

</div>

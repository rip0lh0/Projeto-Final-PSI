<?php

namespace frontend\controllers;

/* Common Models */
use common\models\Animal;
use yii\web\Controller;
use yii\helpers\Url;

class AnimalController extends Controller
{
    public function actionIndex()
    {
        $animals = Animal::find()->all();

        return $this->render('animals', [
            'animals' => $animals
        ]);
    }

    public function actionView()
    {

    }

    public function actionAdopt()
    {

    }

}

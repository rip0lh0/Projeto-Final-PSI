<?php

namespace frontend\controllers;

use yii\rest\ActiveController;

/* Common Models */
use common\models\Animal;



class AnimalController extends ActiveController
{
    public $modelClass = 'common\models\Animal';

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

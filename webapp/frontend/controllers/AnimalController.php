<?php

namespace frontend\controllers;

/* Common Models */
use common\models\Animal;
use common\models\KennelAnimal;
use yii\web\Controller;
use yii\helpers\Url;

class AnimalController extends Controller
{
    public function actionIndex()
    {
        $animals = Animal::find()->join('JOIN', KennelAnimal::tableName(), 'animal.id = id_animal')->where([(KennelAnimal::tableName() . '.status') => KennelAnimal::STATUS_FOR_ADOPTION])->orderBy(['created_at' => SORT_DESC])->all();

        return $this->render('index', [
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

<?php
namespace api\controllers;

use yii\rest\ActiveController;
use common\models\Animal;

class SiteController extends ActiveController
{
    public $modelClass = 'common\models\Animal';

    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    public function actionAnimal()
    {
        $count = Animal::find()->all();
        return count($count);
    }
}
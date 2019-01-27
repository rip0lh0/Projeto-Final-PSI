<?php

namespace frontend\controllers;

use frontend\models\MessageForm;
use yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\AccessControl;

/* Common Models */
use common\models\Animal;
use common\models\KennelAnimal;
use common\models\Energy;
use common\models\Coat;
use common\models\Size;
use yii\web\NotFoundHttpException;

class AnimalController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['adopt'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['adopt'],
                        'roles' => ['Adopter']
                    ],
                ],
            ],
        ];
    }

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

    public function actionAdopt($id_animal)
    {
        $animal = Animal::find()->join('JOIN', KennelAnimal::tableName(), 'animal.id = id_animal')->where([(KennelAnimal::tableName() . '.status') => KennelAnimal::STATUS_FOR_ADOPTION, 'animal.id' => $id_animal])->one();
        $adopter = Yii::$app->user->identity->adopter;
        if ($animal == null) throw new NotFoundHttpException();
        //var_dump($adopter);
        $model = new MessageForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_adopter = $adopter->id;
            $model->id_animal = $animal->kennelAnimal->id;

            $model->saveMessage();
        }

        $energies = Energy::find()->all();
        $coats = Coat::find()->all();
        $sizes = Size::find()->all();

        return $this->render('adopt', [
            'animal' => $animal,
            'model' => $model,
            'energies' => $energies,
            'coats' => $coats,
            'sizes' => $sizes,
        ]);
    }

}

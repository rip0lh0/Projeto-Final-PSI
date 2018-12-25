<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Model;

/* @Models */
use common\models\Animal;
use common\models\AnimalFile;

class AnimalController extends ActiveController
{
    public $modelClass = 'common\models\Animal';

    /**
     * Selects All the Animals with a certain age
     *
     * @return mixed
     */
    public function actionFilterByAnimalAge($min_age)
    {
        $filteredAnimals = AnimalFile::find()
            ->where(['>=', 'age', $min_age])
            ->andWhere(['not', ['age' => null]])
            ->all();

        return $filteredAnimals;
    }


    /**
     * Inserts A New Animal And His Medical File
     *
     * @return mixed
     */
    public function actionNewAnimal()
    {
        $postData = Yii::$app->request->post();

        $animalData = new Animal();
        $fileData = new AnimalFile();

        /* Post Data To Animal */
        $animalData->name = $postData["name"];
        $animalData->description = $postData["description"];

        /* Post Data To Animal File */
        $fileData->chip = $postData["chip"];
        $fileData->neutered = $postData["neutered"];
        $fileData->gender = $postData["gender"];
        $fileData->weight = $postData["weight"];
        $fileData->age = $postData["age"];

        /* Validate And Save  */
        if ($animalData->validate() != null && $animalData->save() != null) {
            $fileData->id_animal = $animalData->id;
            $fileData->created_at = date('Y-m-d H:i:s');
            $fileData->updated_at = date('Y-m-d H:i:s');

            if ($fileData->validate() != null && $fileData->save() != null)
                return Yii::$app->request->post();
            else
                $animalData->delete();
        }

        return "Error Saving Data";
    }
}
<?php 

namespace backend\models;

use Yii;
use yii\base\Model;

/* @Models */
use common\models\Animal;
use common\models\AnimalFile;
use common\models\KennelAnimal;
use common\models\Breed;
use common\models\FileBreed;

class AnimalForm extends Model
{
    /* Animal */
    public $name;
    public $description;
    /* File */
    public $chip;
    public $gender;
    public $neutered;
    public $weight;
    public $age;
    /* FileBreed */
    public $id_breeds = [];
    public $id_breed;

    public function rules()
    {
        return [
            /* Animal */
            [['name', 'description', 'neutered', 'gender'], 'required'],
            [['name', 'description', 'chip'], 'string', 'max' => 255],
            /* File */
            [['neutered', 'gender'], 'required'],
            [['neutered', 'age'], 'integer'],
            [['neutered', 'gender'], 'required'],
            [['weight'], 'number'],
            [['id_breeds'], 'each', 'rule' => ['number']]

            //['id_breeds', 'each', 'rule' => ['integer', 'targetClass' => Breed::className(), 'targetAttribute' => ['id_breed' => 'id']]]
        ];
    }

    public function saveData()
    {

        if (!$this->validate()) return null;

        $animal = new Animal();
        $animalFile = new AnimalFile();
        $kennelAnimal = new KennelAnimal();
        
        /* Animal */
        $animal->name = $this->name;
        $animal->description = $this->description;

        if ($animal->save() == null) return null;

        /* Animal File */
        $animalFile->id_animal = $animal->id;
        $animalFile->chip = $this->chip;
        $animalFile->neutered = $this->neutered;
        $animalFile->gender = $this->gender;
        $animalFile->weight = $this->weight;
        $animalFile->age = $this->age;
        $animalFile->created_at = date('Y-m-d H:i:s');
        $animalFile->updated_at = date('Y-m-d H:i:s');

        if ($animalFile->save() == null) return null;

        /* File Breed */
        if (!empty($this->id_breeds)) {
            foreach ($this->id_breeds as $id_breed) {
                $fileBreed = new FileBreed();

                $fileBreed->id_breed = $id_breed;
                $fileBreed->id_file = $animalFile->id;

                $fileBreed->save();
            }
        }

        /* Kennel Animal */
        $kennelAnimal->id_animal = $animal->id;
        $kennelAnimal->id_kennel = Yii::$app->user->id;
        $kennelAnimal->created_at = date('Y-m-d H:i:s');
        $kennelAnimal->updated_at = date('Y-m-d H:i:s');

        if ($kennelAnimal->save() == null) return null;

        return true;
    }
}
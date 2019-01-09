<?php 

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/* @Models */
use common\models\Animal;
use common\models\KennelAnimal;
use common\models\Breed;
use common\models\FileBreed;

class AnimalForm extends Model
{
    /* Animal */
    public $name;
    public $description;
    public $chip;
    public $gender;
    public $neutered;
    public $weight;
    public $age;
    public $energy;
    public $size;
    public $coat;
    /* FileBreed */
    //public $breeds;
    //public $parentBreed;

    /**
     * @var UploadedFile[]
     */
    public $photos;

    public function rules()
    {
        return [
            /* Animal */
            [['name', 'description', 'neutered', 'gender', 'energy', 'coat', 'size'], 'required'],
            [['name', 'description', 'chip'], 'string', 'max' => 255],
            [['neutered', 'age'], 'integer'],
            [['weight'/*, 'parentBreed'*/ ], 'number'],

            //[[/*'breeds', */'energy', 'coat', 'size'], 'each', 'rule' => ['number']],
            /* Images */
            [['photos'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 12]
        ];
    }

    public function saveAnimal()
    {
        if (!$this->validate()) return false;

        $animal = new Animal();

        $kennel = Yii::$app->user->identity->kennel;

        /* Animal */
        $animal->name = $this->name;
        $animal->description = $this->description;
        $animal->chip = $this->chip;
        $animal->neutered = $this->neutered;
        $animal->gender = $this->gender;
        $animal->weight = $this->weight;
        $animal->age = $this->age;
        $animal->id_energy = $this->energy;
        $animal->id_coat = $this->coat;
        $animal->id_size = $this->size;

        if (!$animal->save()) return null;

        $kennelAnimal = $this->saveAnimalToKennel($animal->id, $kennel->id);

        if (!$kennelAnimal) {
            $animal->delete();
            return null;
        }

        $this->saveAnimalPhotos($kennelAnimal->created_at);

        return $animal;
    }

    /**
     * Connect Animal To Kennel
     * 
     * @return boolean
     */
    public function saveAnimalToKennel($idAnimal, $idKennel)
    {
        $kennelAnimal = new KennelAnimal();

        $kennelAnimal->id_animal = $idAnimal;
        $kennelAnimal->id_kennel = $idKennel;

        if ($kennelAnimal->save()) return $kennelAnimal;

        var_dump($kennelAnimal);

        return false;
    }

    /**
     * Connect Animal To Multiple Breeds
     * 
     * @return mixed
     */
    // public function saveAnimalBreeds($idAnimal)
    // {
    //     if (empty($this->breeds)) return false;

    //     foreach ($this->breeds as $value) {
    //         $fileBreed = new FileBreed();

    //         $fileBreed->id_breed = $value;
    //         $fileBreed->id_animal = $idAnimal;

    //         $fileBreed->save();
    //     }

    // }

    /**
     * Save Photos To Directory
     * 
     * @return mixed
     */
    public function saveAnimalPhotos($timestamp)
    {
        if (empty($this->photos)) return;

        $kennelName = Yii::$app->user->identity->email;
        $kennelName = substr($kennelName, 0, strpos($kennelName, "@"));

        $count = 0;
        $path = Yii::getAlias('@common') . '/uploads/animals/' . $kennelName . '/' . $this->name . '_' . $timestamp;

        FileHelper::createDirectory($path);

        foreach ($this->photos as $photo) {
            $photo->saveAs($path . '/' . $count . '.jpeg');
            $count++;
        }
    }
}
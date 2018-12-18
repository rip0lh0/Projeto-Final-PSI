<?php 

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

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
    public $parentBreed;
    public $breeds;
    /**
     * @var UploadedFile[]
     */
    public $photos;

    public function rules()
    {
        return [
            /* Animal */
            [['name', 'description', 'neutered', 'gender'], 'required'],
            [['name', 'description', 'chip'], 'string', 'max' => 255],
            /* Medical File */
            [['neutered', 'gender'], 'required'],
            [['neutered', 'age'], 'integer'],
            [['neutered', 'gender'], 'required'],
            [['weight', 'parentBreed'], 'number'],

            [['breeds'], 'each', 'rule' => ['number']],
            /* Images */
            [['photos'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 12]
        ];
    }

    public function saveAnimal()
    {
        if (!$this->validate()) return false;

        $animal = new Animal();
        $hasSuccess = true;
        $kennel = Yii::$app->user->identity->kennel;

        /* Animal */
        $animal->name = $this->name;
        $animal->description = $this->description;

        $hasSuccess = $hasSuccess && $animal->save();

        $hasSuccess = $hasSuccess &&
            $this->saveAnimalFile($animal->id) &&
            $this->saveKennelAnimal($animal->id, $kennel->id);

        if (!$hasSuccess) $animal->delete();

        $this->savePhotos();

        return $hasSuccess;
    }

    /**
     * Medical Information
     * 
     * @return boolean
     */
    public function saveAnimalFile($animal_ID)
    {
        $medicalFile = new AnimalFile();

        $medicalFile->id_animal = $animal_ID;
        $medicalFile->chip = $this->chip;
        $medicalFile->neutered = $this->neutered;
        $medicalFile->gender = $this->gender;
        $medicalFile->weight = $this->weight;
        $medicalFile->age = $this->age;

        $medicalFile->created_at = date('Y-m-d H:i:s');
        $medicalFile->updated_at = date('Y-m-d H:i:s');

        if ($medicalFile->save() == null) return false;

        $this->saveAnimalBreeds($medicalFile->id);

        return true;
    }

    /**
     * Connect Animal To Kennel
     * 
     * @return boolean
     */
    public function saveKennelAnimal($animal_ID, $kennel_ID)
    {
        $kennelAnimal = new KennelAnimal();

        $kennelAnimal->id_animal = $animal_ID;
        $kennelAnimal->id_kennel = $kennel_ID;

        $kennelAnimal->created_at = date('Y-m-d H:i:s');
        $kennelAnimal->updated_at = date('Y-m-d H:i:s');

        if ($kennelAnimal->save() != null) return true;

        return false;
    }

    /**
     * Connect Animal To Multiple Breeds
     * 
     * @return mixed
     */
    public function saveAnimalBreeds($file_ID)
    {
        if (!empty($this->breeds)) {
            foreach ($this->breeds as $value) {
                $fileBreed = new FileBreed();

                $fileBreed->id_breed = $value;
                $fileBreed->id_file = $file_ID;

                $fileBreed->save();
            }
        }
    }

    /**
     * Save Photos To Directory
     * 
     * @return mixed
     */
    public function savePhotos()
    {
        if (empty($this->photos)) return;

        $kennelName = Yii::$app->user->identity->email;
        $kennelName = substr($kennelName, 0, strpos($kennelName, "@"));

        $count = 0;
        $path = Yii::getAlias('@common') . '/uploads/animals/' . $kennelName . '/' . $this->name;


        FileHelper::createDirectory($path);
        foreach ($this->photos as $photo) {
            $photo->saveAs($path . '/' . $count . '.png');
            $count++;
        }
    }
}
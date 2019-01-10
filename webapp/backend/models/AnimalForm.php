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
use common\models\Kennel;

class AnimalForm extends Model
{
    public $id_Kennel;
    /* Animal */
    public $id;
    public $name;
    public $description;
    public $chip;
    public $gender;
    public $neutered;
    public $weight;
    public $age;
    public $id_energy;
    public $id_size;
    public $id_coat;
    /** @var UploadedFile[] */
    public $photos;

    public function rules()
    {
        return [
            /* Animal */
            [['name', 'description', 'neutered', 'gender', 'id_energy', 'id_coat', 'id_size', 'id_Kennel'], 'required'],
            [['name', 'description', 'chip'], 'string', 'max' => 255],
            [['neutered', 'age'], 'integer'],
            [['weight'/*, 'parentBreed'*/ ], 'number'],

            //[[/*'breeds', */'energy', 'coat', 'size'], 'each', 'rule' => ['number']],
            /* Images */
            [['photos'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 12]
        ];
    }

    public function createAnimal()
    {
        if (!$this->validate()) return false;
        $animal = new Animal();

        $animal->name = $this->name;
        $animal->description = $this->description;
        $animal->neutered = $this->neutered;
        $animal->chip = $this->chip;
        $animal->gender = $this->gender;
        $animal->weight = $this->weight;
        $animal->age = $this->age;
        $animal->id_energy = $this->id_energy;
        $animal->id_coat = $this->id_coat;
        $animal->id_size = $this->id_size;

        if (!$animal->save()) return null;

        $this->photos($animal);
        $kennel_Animal = $this->addToKennel($animal->id, $this->id_Kennel);

        if (!$kennel_Animal) {
            $animal->delete();
            return null;
        }

        return $animal;
    }

    public function updateAnimal()
    {
        $animal = Animal::findOne($this->id);

        $animal->name = $this->name;
        $animal->description = $this->description;
        $animal->neutered = $this->neutered;
        $animal->gender = $this->gender;
        $animal->weight = $this->weight;
        $animal->age = $this->age;
        $animal->id_energy = $this->id_energy;
        $animal->id_coat = $this->id_coat;
        $animal->id_size = $this->id_size;

        if (!$animal->update()) return null;

        $this->photos($animal);

        return $animal;
    }

    public function addToKennel($id_animal, $id_kennel)
    {
        $kennel_Animal = new KennelAnimal();

        $kennel_Animal->id_animal = $id_animal;
        $kennel_Animal->id_kennel = $id_kennel;

        if ($kennel_Animal->save()) return $kennelAnimal;
        else return false;
    }

    public function photos($animal)
    {
        if (empty($this->photos)) return;

        $path = Yii::getAlias('@common') . '/uploads/animals/' . $this->id_Kennel . '/' . $animal->kennelanimal->created_at;
        FileHelper::createDirectory($path);

        $count = 0;
        foreach ($this->photos as $photo) {
            $photo->saveAs($path . '/' . $count . '.jpeg');
            $count++;
        }
    }
}
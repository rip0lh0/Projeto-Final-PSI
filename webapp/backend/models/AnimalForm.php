<?php 

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

use backend\models\ImageHandler;


/* @Common Models */
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
    public $status;

    //public $photos;

    public function rules()
    {
        return [
            [
                ['name', 'description', 'neutered', 'gender', 'id_energy', 'id_coat', 'id_size', 'id_Kennel'],
                'required',
                'message' => '{attribute} não pode ficar em branco.'
            ],
            [
                ['chip'],
                'string',
                'min' => 9,
                'max' => 9,
                'message' => '{attribute} contem 9 caracteres.'
            ],
            [
                ['name'],
                'string',
                'max' => 60,
                'message' => '{attribute} contem mais de 60 caracteres.'
            ],
            [
                ['description'],
                'string',
                'max' => 255,
                'message' => '{attribute} contem mais de 255 caracteres.'
            ],
            [
                ['neutered', 'age', 'status'],
                'integer'
            ],
            [
                ['weight'],
                'number'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_kennel' => 'ID Canil',
            'name' => 'Nome',
            'description' => 'Descrição',
            'id_coat' => 'Pelo',
            'id_energy' => 'Energia',
            'id_size' => 'Tamanho',
            'chip' => 'Chip',
            'age' => 'Idade',
            'gender' => 'Género',
            'weight' => 'Peso',
            'neutered' => 'Castrado',
            'status' => 'Estado',
        ];
    }

    public function createAnimal()
    {
        if (!$this->validate()) return false;
        $animal = new Animal();

        $animal->name = $this->name;
        $animal->description = $this->description;
        $animal->neutered = $this->neutered;
        $animal->chip = ($this->chip) ? $this->chip : null;
        $animal->gender = $this->gender;
        $animal->weight = $this->weight;
        $animal->age = $this->age;

        $animal->id_energy = $this->id_energy;
        $animal->id_coat = $this->id_coat;
        $animal->id_size = $this->id_size;

        if (!$animal->save()) return ['Error' => $animal->errors];

        $kennel_Animal = $this->addToKennel($animal->id, $this->id_Kennel);


        if (!$kennel_Animal) {
            $animal->delete();
            return ['Error' => 'Fail To Create Animal'];
        }

        ImageHandler::final_upload($this->id_Kennel, ($this->id_Kennel . '/' . $kennel_Animal->created_at));

        return ['Success' => 'Animal Created with Success'];
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

        ImageHandler::final_upload($this->id_Kennel, ($this->id_Kennel . '/' . $animal->kennelAnimal->created_at));

        if (!$animal->validate()) return ['Error' => 'Fail To Update Animal'];

        $animal->update();

        $kennel_animal = KennelAnimal::find()->where(['id_animal' => $this->id, 'id_kennel' => $this->id_Kennel])->one();

        //var_dump($kennel_animal);
        $kennel_animal->status = $this->status;

        if (!$kennel_animal->validate()) return ['Error' => 'Fail To Update Animal'];
        $kennel_animal->update();

        return ['Success' => 'Animal Update with Success'];
    }

    public function addToKennel($id_animal, $id_kennel)
    {
        $kennel_Animal = new KennelAnimal();

        $kennel_Animal->id_animal = $id_animal;
        $kennel_Animal->id_kennel = $id_kennel;
        $kennel_Animal->status = $this->status;

        if ($kennel_Animal->save()) return $kennel_Animal;
        else return false;
    }
}
<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $id_coat
 * @property int $id_energy
 * @property int $id_size
 * @property string $chip
 * @property double $age
 * @property string $gender
 * @property double $weight
 * @property int $neutered
 *
 * @property Coat $coat
 * @property Energy $energy
 * @property Size $size
 * @property AnimalBreed[] $animalBreeds
 * @property KennelAnimal[] $kennelAnimals
 */
class Animal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'gender', 'neutered'], 'required'],
            [['id_coat', 'id_energy', 'id_size', 'neutered'], 'integer'],
            [['age', 'weight'], 'number'],
            [['name', 'description', 'chip'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 1],
            [['chip'], 'unique'],
            [['id_coat'], 'exist', 'skipOnError' => true, 'targetClass' => Coat::className(), 'targetAttribute' => ['id_coat' => 'id']],
            [['id_energy'], 'exist', 'skipOnError' => true, 'targetClass' => Energy::className(), 'targetAttribute' => ['id_energy' => 'id']],
            [['id_size'], 'exist', 'skipOnError' => true, 'targetClass' => Size::className(), 'targetAttribute' => ['id_size' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'id_coat' => 'Id Coat',
            'id_energy' => 'Id Energy',
            'id_size' => 'Id Size',
            'chip' => 'Chip',
            'age' => 'Age',
            'gender' => 'Gender',
            'weight' => 'Weight',
            'neutered' => 'Neutered',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoat()
    {
        return $this->hasOne(Coat::className(), ['id' => 'id_coat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnergy()
    {
        return $this->hasOne(Energy::className(), ['id' => 'id_energy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSize()
    {
        return $this->hasOne(Size::className(), ['id' => 'id_size']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalBreeds()
    {
        return $this->hasMany(AnimalBreed::className(), ['id_animal' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKennelAnimals()
    {
        return $this->hasMany(KennelAnimal::className(), ['id_animal' => 'id']);
    }
}

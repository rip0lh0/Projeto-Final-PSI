<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animal_file".
 *
 * @property int $id
 * @property int $id_animal
 * @property int $id_breed
 * @property int $chip
 * @property int $neutered
 * @property string $gender
 * @property double $weight
 * @property int $age
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Animal $animal
 * @property Breed $breed
 * @property Treatment[] $treatments
 */
class AnimalFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animal_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_animal', 'id_breed', 'chip', 'neutered', 'gender', 'created_at', 'updated_at'], 'required'],
            [['id_animal', 'id_breed', 'chip', 'neutered', 'age'], 'integer'],
            [['weight'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['gender'], 'string', 'max' => 1],
            [['id_animal'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::className(), 'targetAttribute' => ['id_animal' => 'id']],
            [['id_breed'], 'exist', 'skipOnError' => true, 'targetClass' => Breed::className(), 'targetAttribute' => ['id_breed' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_animal' => 'Id Animal',
            'id_breed' => 'Id Breed',
            'chip' => 'Chip',
            'neutered' => 'Neutered',
            'gender' => 'Gender',
            'weight' => 'Weight',
            'age' => 'Age',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animal::className(), ['id' => 'id_animal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreed()
    {
        return $this->hasOne(Breed::className(), ['id' => 'id_breed']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatments()
    {
        return $this->hasMany(Treatment::className(), ['id_animal_file' => 'id']);
    }
}

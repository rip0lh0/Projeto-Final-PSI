<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animal_file".
 *
 * @property int $id
 * @property int $id_animal
 * @property string $chip
 * @property int $neutered
 * @property string $gender
 * @property double $weight
 * @property int $age
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Animal $animal
 * @property FileBreed[] $fileBreeds
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
            [['id_animal', 'neutered', 'gender', 'created_at', 'updated_at'], 'required'],
            [['id_animal', 'neutered', 'age'], 'integer'],
            [['weight'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['chip'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 1],
            [['chip'], 'unique'],
            [['id_animal'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::className(), 'targetAttribute' => ['id_animal' => 'id']],
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
    public function getFileBreeds()
    {
        return $this->hasMany(FileBreed::className(), ['id_file' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatments()
    {
        return $this->hasMany(Treatment::className(), ['id_animal_file' => 'id']);
    }
}

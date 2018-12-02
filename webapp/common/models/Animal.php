<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property AnimalFile[] $animalFiles
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
            [['name', 'description'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalFiles()
    {
        return $this->hasMany(AnimalFile::className(), ['id_animal' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKennelAnimals()
    {
        return $this->hasMany(KennelAnimal::className(), ['id_animal' => 'id']);
    }
}

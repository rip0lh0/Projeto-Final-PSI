<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "treatment".
 *
 * @property int $id
 * @property int $id_animal_file
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AnimalFile $animalFile
 * @property Vaccine[] $vaccines
 */
class Treatment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'treatment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_animal_file', 'created_at', 'updated_at'], 'required'],
            [['id_animal_file'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['id_animal_file'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalFile::className(), 'targetAttribute' => ['id_animal_file' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_animal_file' => 'Id Animal File',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalFile()
    {
        return $this->hasOne(AnimalFile::className(), ['id' => 'id_animal_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVaccines()
    {
        return $this->hasMany(Vaccine::className(), ['id_tretment' => 'id']);
    }
}

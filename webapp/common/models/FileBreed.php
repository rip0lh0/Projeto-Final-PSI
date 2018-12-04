<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "file_breed".
 *
 * @property int $id_file
 * @property int $id_breed
 *
 * @property Breed $breed
 * @property AnimalFile $file
 */
class FileBreed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_breed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_file', 'id_breed'], 'required'],
            [['id_file', 'id_breed'], 'integer'],
            [['id_breed'], 'exist', 'skipOnError' => true, 'targetClass' => Breed::className(), 'targetAttribute' => ['id_breed' => 'id']],
            [['id_file'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalFile::className(), 'targetAttribute' => ['id_file' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_file' => 'Id File',
            'id_breed' => 'Id Breed',
        ];
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
    public function getFile()
    {
        return $this->hasOne(AnimalFile::className(), ['id' => 'id_file']);
    }
}

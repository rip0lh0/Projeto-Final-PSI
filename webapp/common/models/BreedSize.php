<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "breed_size".
 *
 * @property int $id_size
 * @property int $id_breed
 *
 * @property Breed $breed
 * @property Energy $size
 */
class BreedSize extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'breed_size';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['id_size', 'id_breed'], 'required'],
            [['id_size', 'id_breed'], 'integer'],
            [['id_breed'], 'exist', 'skipOnError' => true, 'targetClass' => Breed::className(), 'targetAttribute' => ['id_breed' => 'id']],
            [['id_size'], 'exist', 'skipOnError' => true, 'targetClass' => Energy::className(), 'targetAttribute' => ['id_size' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_size' => 'Id Size',
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
    public function getSize()
    {
        return $this->hasOne(Energy::className(), ['id' => 'id_size']);
    }
}

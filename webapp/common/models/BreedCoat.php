<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "breed_coat".
 *
 * @property int $id_coat
 * @property int $id_breed
 *
 * @property Breed $breed
 * @property Energy $coat
 */
class BreedCoat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'breed_coat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_coat', 'id_breed'], 'required'],
            [['id_coat', 'id_breed'], 'integer'],
            [['id_breed'], 'exist', 'skipOnError' => true, 'targetClass' => Breed::className(), 'targetAttribute' => ['id_breed' => 'id']],
            [['id_coat'], 'exist', 'skipOnError' => true, 'targetClass' => Energy::className(), 'targetAttribute' => ['id_coat' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_coat' => 'Pelugem',
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
    public function getCoat()
    {
        return $this->hasOne(Energy::className(), ['id' => 'id_coat']);
    }
}

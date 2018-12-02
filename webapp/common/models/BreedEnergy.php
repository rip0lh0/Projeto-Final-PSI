<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "breed_energy".
 *
 * @property int $id_energy
 * @property int $id_breed
 *
 * @property Breed $breed
 * @property Energy $energy
 */
class BreedEnergy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'breed_energy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_energy', 'id_breed'], 'required'],
            [['id_energy', 'id_breed'], 'integer'],
            [['id_breed'], 'exist', 'skipOnError' => true, 'targetClass' => Breed::className(), 'targetAttribute' => ['id_breed' => 'id']],
            [['id_energy'], 'exist', 'skipOnError' => true, 'targetClass' => Energy::className(), 'targetAttribute' => ['id_energy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_energy' => 'Energia',
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
    public function getEnergy()
    {
        return $this->hasOne(Energy::className(), ['id' => 'id_energy']);
    }
}

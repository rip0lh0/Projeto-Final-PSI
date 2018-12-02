<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "energy".
 *
 * @property int $id
 * @property string $energy
 *
 * @property BreedCoat[] $breedCoats
 * @property BreedEnergy[] $breedEnergies
 * @property BreedSize[] $breedSizes
 */
class Energy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'energy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['energy'], 'required'],
            [['energy'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'energy' => 'Energy',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreedCoats()
    {
        return $this->hasMany(BreedCoat::className(), ['id_coat' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreedEnergies()
    {
        return $this->hasMany(BreedEnergy::className(), ['id_energy' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreedSizes()
    {
        return $this->hasMany(BreedSize::className(), ['id_size' => 'id']);
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "adopter".
 *
 * @property int $id
 * @property string $name
 * @property double $cellphone
 *
 * @property Adoption[] $adoptions
 */
class Adopter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adopter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['cellphone'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'cellphone' => 'Cellphone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdoptions()
    {
        return $this->hasMany(Adoption::className(), ['id_adopter' => 'id']);
    }
}

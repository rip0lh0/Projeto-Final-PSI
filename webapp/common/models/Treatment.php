<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "treatment".
 *
 * @property int $id
 * @property string $description
 *
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
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVaccines()
    {
        return $this->hasMany(Vaccine::className(), ['id_tretment' => 'id']);
    }
}

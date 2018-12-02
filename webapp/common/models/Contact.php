<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property double $phone
 * @property double $cellphone
 * @property double $fax
 * @property string $updated_at
 *
 * @property Kennel[] $kennels
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'cellphone', 'fax'], 'number'],
            [['updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'cellphone' => 'Cellphone',
            'fax' => 'Fax',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKennels()
    {
        return $this->hasMany(Kennel::className(), ['id_contact' => 'id']);
    }
}

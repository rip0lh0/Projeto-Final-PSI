<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "adopter".
 *
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property double $cellphone
 *
 * @property User $user
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
            [['id_user', 'name'], 'required'],
            [['id_user'], 'integer'],
            [['cellphone'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'name' => 'Name',
            'cellphone' => 'Cellphone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdoptions()
    {
        return $this->hasMany(Adoption::className(), ['id_adopter' => 'id']);
    }

}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kennel".
 *
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property double $nif
 * @property string $address
 * @property int $id_local
 * @property string $phone
 * @property string $cell_phone
 * @property string $fax
 * @property string $facebook
 * @property string $instagram
 * @property string $youtube
 *
 * @property Local $local
 * @property User $user
 * @property KennelAnimal[] $kennelAnimals
 * @property Schedule[] $schedules
 */
class Kennel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kennel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'name', 'nif', 'address', 'id_local'], 'required'],
            [['id_user', 'id_local'], 'integer'],
            [['nif'], 'number'],
            [['name', 'address', 'phone', 'cell_phone', 'fax', 'facebook', 'instagram', 'youtube'], 'string', 'max' => 255],
            [['id_local'], 'exist', 'skipOnError' => true, 'targetClass' => Local::className(), 'targetAttribute' => ['id_local' => 'id']],
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
            'nif' => 'Nif',
            'address' => 'Address',
            'id_local' => 'Id Local',
            'phone' => 'Phone',
            'cell_phone' => 'Cell Phone',
            'fax' => 'Fax',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'youtube' => 'Youtube',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocal()
    {
        return $this->hasOne(Local::className(), ['id' => 'id_local']);
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
    public function getKennelAnimals()
    {
        return $this->hasMany(KennelAnimal::className(), ['id_kennel' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['id_kennel' => 'id']);
    }
}

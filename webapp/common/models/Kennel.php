<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kennel".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_contact
 * @property int $id_social
 * @property string $name
 * @property double $nif
 * @property string $address
 *
 * @property Contact $contact
 * @property Social $social
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
            [['id_user', 'id_contact', 'id_social', 'name', 'nif', 'address'], 'required'],
            [['id_user', 'id_contact', 'id_social'], 'integer'],
            [['nif'], 'number'],
            [['name', 'address'], 'string', 'max' => 255],
            [['id_contact'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::className(), 'targetAttribute' => ['id_contact' => 'id']],
            [['id_social'], 'exist', 'skipOnError' => true, 'targetClass' => Social::className(), 'targetAttribute' => ['id_social' => 'id']],
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
            'id_contact' => 'Id Contact',
            'id_social' => 'Id Social',
            'name' => 'Name',
            'nif' => 'Nif',
            'address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'id_contact']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocial()
    {
        return $this->hasOne(Social::className(), ['id' => 'id_social']);
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

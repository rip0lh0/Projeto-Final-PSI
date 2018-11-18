<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "canil_animal".
 *
 * @property int $id
 * @property int $id_Animal
 * @property int $id_Canil
 * @property string $discricao
 * @property string $created_at
 *
 * @property Adocao[] $adocaos
 * @property Animal $animal
 * @property Perfil $canil
 */
class CanilAnimal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'canil_animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Animal', 'id_Canil', 'discricao', 'created_at'], 'required'],
            [['id_Animal', 'id_Canil'], 'integer'],
            [['created_at'], 'safe'],
            [['discricao'], 'string', 'max' => 255],
            [['id_Animal'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::className(), 'targetAttribute' => ['id_Animal' => 'id']],
            [['id_Canil'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::className(), 'targetAttribute' => ['id_Canil' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_Animal' => 'Id  Animal',
            'id_Canil' => 'Id  Canil',
            'discricao' => 'Discricao',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdocaos()
    {
        return $this->hasMany(Adocao::className(), ['id_canil_animal' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animal::className(), ['id' => 'id_Animal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCanil()
    {
        return $this->hasOne(Perfil::className(), ['id' => 'id_Canil']);
    }
}

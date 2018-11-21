<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "adocao".
 *
 * @property int $id
 * @property int $id_Adotante
 * @property int $id_canil_animal
 * @property string $descricao
 * @property string $created_at
 * @property string $updated_at
 * @property int $state
 *
 * @property Perfil $adotante
 * @property CanilAnimal $canilAnimal
 */
class Adocao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adocao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Adotante', 'id_canil_animal', 'created_at', 'updated_at', 'state'], 'required'],
            [['id_Adotante', 'id_canil_animal', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['descricao'], 'string', 'max' => 255],
            [['id_Adotante'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::className(), 'targetAttribute' => ['id_Adotante' => 'id']],
            [['id_canil_animal'], 'exist', 'skipOnError' => true, 'targetClass' => CanilAnimal::className(), 'targetAttribute' => ['id_canil_animal' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_Adotante' => 'Id  Adotante',
            'id_canil_animal' => 'Id Canil Animal',
            'descricao' => 'Descricao',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'state' => 'State',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdotante()
    {
        return $this->hasOne(Perfil::className(), ['id' => 'id_Adotante']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCanilAnimal()
    {
        return $this->hasOne(CanilAnimal::className(), ['id' => 'id_canil_animal']);
    }
}

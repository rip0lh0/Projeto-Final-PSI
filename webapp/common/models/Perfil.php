<?php

namespace common\models;

use Yii;
use yii\gii\TypeAheadAsset;

/**
 * This is the model class for table "perfil".
 *
 * @property int $id
 * @property int $id_user
 * @property double $nif
 * @property string $nome
 * @property string $descricao
 * @property string $morada
 * @property string $localidade
 * @property string $nacionalidade
 * @property double $contacto
 *
 * @property Adocao[] $adocaos
 * @property CanilAnimal[] $canilAnimals
 * @property User $user
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'nif', 'nome', 'contacto'], 'required'],
            [['id_user'], 'integer'],
            [['nif', 'contacto'], 'number'],
            [['nome', 'descricao', 'morada', 'localidade', 'nacionalidade'], 'string', 'max' => 255],
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
            'nif' => 'Nif',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'morada' => 'Morada',
            'localidade' => 'Localidade',
            'nacionalidade' => 'Nacionalidade',
            'contacto' => 'Contacto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdocaos() // Used For The Adopters
    {
        return $this->hasMany(Adocao::className(), ['id_Adotante' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCanilAnimals()
    {
        return $this->hasMany(CanilAnimal::className(), ['id_Canil' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }


    public function getCanilAnimalsInBatch($limit)
    {
        return CanilAnimal::find()
            ->where(['id_Canil' => 'id'])
            ->limit($limit)
            ->all();
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property int $id
 * @property int $id_user
 * @property double $nif
 * @property string $nome
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
            [['nome', 'morada', 'localidade', 'nacionalidade'], 'string', 'max' => 255],
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
            'morada' => 'Morada',
            'localidade' => 'Localidade',
            'nacionalidade' => 'Nacionalidade',
            'contacto' => 'Contacto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdocaos() // USED FOR THE ADOPTER
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

    public static function getProfileById($id)
    {
        return Perfil::find()->where(['id_user' => $id])->one();
    }

    public function getAnimalsInKennel()
    {
        if (!User::isKennel(Yii::$app->user->id)) return null;

        return $this->hasMany(Animal::className(), ['id' => 'id_animal'])
            ->via('canil_animal', 'getCanilAnimals');

    }


}

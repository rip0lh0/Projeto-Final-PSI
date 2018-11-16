<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property int $id
 * @property int $id_raca
 * @property string $nome
 * @property string $descricao
 */
class Animal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_raca', 'nome', 'descricao'], 'required'],
            [['id_raca'], 'integer'],
            [['nome', 'descricao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_raca' => 'Id Raca',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
        ];
    }

    public static function getAll()
    {
        return static::find()->all();
    }

    public static function getTodosAnimais($kennelID)
    {
        $id_Animais = CanilAnimal::getCanilAnimals($kennelID); 
        // TODO:: BUSCAR INFORMAÇÃO DOS ANIMAIS
        return $canilAnimals;
    }

}

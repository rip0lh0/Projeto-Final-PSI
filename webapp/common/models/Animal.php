<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property int $id
 * @property int $id_dados_veterinarios
 * @property int $id_raca
 * @property int $chip
 * @property string $nome
 * @property string $genero
 * @property double $tamanho
 * @property int $idade
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
            [['id_dados_veterinarios', 'id_raca', 'chip', 'nome', 'genero', 'tamanho', 'idade', 'descricao'], 'required'],
            [['id_dados_veterinarios', 'id_raca', 'chip', 'idade'], 'integer'],
            [['tamanho'], 'number'],
            [['nome', 'descricao'], 'string', 'max' => 255],
            [['genero'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_dados_veterinarios' => 'Id Dados Veterinarios',
            'id_raca' => 'Id Raca',
            'chip' => 'Chip',
            'nome' => 'Nome',
            'genero' => 'Genero',
            'tamanho' => 'Tamanho',
            'idade' => 'Idade',
            'descricao' => 'Descricao',
        ];
    }
}

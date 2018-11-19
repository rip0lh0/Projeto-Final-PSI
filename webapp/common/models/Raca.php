<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "raca".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 *
 * @property Animal[] $animals
 */
class Raca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'raca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'descricao'], 'required'],
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
            'nome' => 'Nome',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animal::className(), ['id_raca' => 'id']);
    }

    public static function getRacaById()
    {

    }

}

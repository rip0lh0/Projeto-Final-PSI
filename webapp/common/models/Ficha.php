<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ficha".
 *
 * @property int $id
 * @property int $id_raca
 * @property int $chip
 * @property string $genero
 * @property double $tamanho
 * @property int $idade
 * @property string $castrado
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Animal[] $animals
 * @property Raca $raca
 * @property Tratamento[] $tratamentos
 */
class Ficha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ficha';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_raca', 'chip', 'genero', 'castrado', 'created_at', 'updated_at'], 'required'],
            [['id_raca', 'chip', 'idade'], 'integer'],
            [['tamanho'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['genero'], 'string', 'max' => 1],
            [['castrado'], 'string', 'max' => 255],
            [['id_raca'], 'exist', 'skipOnError' => true, 'targetClass' => Raca::className(), 'targetAttribute' => ['id_raca' => 'id']],
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
            'chip' => 'Chip',
            'genero' => 'Genero',
            'tamanho' => 'Tamanho',
            'idade' => 'Idade',
            'castrado' => 'Castrado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animal::className(), ['id_ficha' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaca()
    {
        return $this->hasOne(Raca::className(), ['id' => 'id_raca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamentos()
    {
        return $this->hasMany(Tratamento::className(), ['id_ficha' => 'id']);
    }
}

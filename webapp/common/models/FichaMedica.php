<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ficha_medica".
 *
 * @property int $id
 * @property int $id_animal
 * @property int $chip
 * @property string $genero
 * @property double $tamanho
 * @property int $idate
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Animal $animal
 * @property Tratamento[] $tratamentos
 */
class FichaMedica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ficha_medica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_animal', 'chip', 'genero', 'created_at'], 'required'],
            [['id_animal', 'chip', 'idate', 'created_at', 'updated_at'], 'integer'],
            [['tamanho'], 'number'],
            [['genero'], 'string', 'max' => 1],
            [['id_animal'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::className(), 'targetAttribute' => ['id_animal' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_animal' => 'Id Animal',
            'chip' => 'Chip',
            'genero' => 'Genero',
            'tamanho' => 'Tamanho',
            'idate' => 'Idate',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animal::className(), ['id' => 'id_animal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamentos()
    {
        return $this->hasMany(Tratamento::className(), ['id_ficha_medica' => 'id']);
    }
}
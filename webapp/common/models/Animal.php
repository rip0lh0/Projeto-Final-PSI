<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property int $id
 * @property int $id_ficha
 * @property int $id_tipo
 * @property string $nome
 * @property string $descricao
 *
 * @property Ficha $ficha
 * @property TypeAnimal $tipo
 * @property CanilAnimal[] $canilAnimals
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
            [['id_ficha', 'id_tipo', 'tipo', 'descricao'], 'required'],
            [['id_ficha', 'id_tipo'], 'integer'],
            [['nome', 'descricao'], 'string', 'max' => 255],
            [['id_ficha'], 'exist', 'skipOnError' => true, 'targetClass' => Ficha::className(), 'targetAttribute' => ['id_ficha' => 'id']],
            [['id_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => TypeAnimal::className(), 'targetAttribute' => ['id_tipo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ficha' => 'Ficha Medica',
            'id_tipo' => 'Tipo de Animal',
            'nome' => 'Nome do Animal',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFicha()
    {
        return $this->hasOne(Ficha::className(), ['id' => 'id_ficha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TypeAnimal::className(), ['id' => 'id_tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCanilAnimals()
    {
        return $this->hasMany(CanilAnimal::className(), ['id_Animal' => 'id']);
    }
}

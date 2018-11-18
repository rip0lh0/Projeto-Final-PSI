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
 *
 * @property Raca $raca
 * @property CanilAnimal[] $canilAnimals
 * @property FichaMedica[] $fichaMedicas
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
            'nome' => 'Nome',
            'descricao' => 'Descricao',
        ];
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
    public function getCanilAnimals()
    {
        return $this->hasMany(CanilAnimal::className(), ['id_Animal' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichaMedicas()
    {
        return $this->hasMany(FichaMedica::className(), ['id_animal' => 'id']);
    }
}

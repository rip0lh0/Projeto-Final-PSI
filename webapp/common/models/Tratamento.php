<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tratamento".
 *
 * @property int $id
 * @property int $id_ficha
 * @property int $duracao
 * @property string $descricao
 * @property string $created_at
 * @property string $updated_at
 * @property string $estado
 *
 * @property Ficha $ficha
 * @property Vacina[] $vacinas
 */
class Tratamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tratamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ficha', 'duracao', 'created_at', 'updated_at', 'estado'], 'required'],
            [['id_ficha', 'duracao'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['descricao', 'estado'], 'string', 'max' => 255],
            [['id_ficha'], 'exist', 'skipOnError' => true, 'targetClass' => Ficha::className(), 'targetAttribute' => ['id_ficha' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ficha' => 'Id Ficha',
            'duracao' => 'Duracao',
            'descricao' => 'Descricao',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'estado' => 'Estado',
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
    public function getVacinas()
    {
        return $this->hasMany(Vacina::className(), ['id_tratamento' => 'id']);
    }
}

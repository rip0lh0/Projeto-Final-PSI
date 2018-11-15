<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tratamento".
 *
 * @property int $id
 * @property string $created_at
 * @property int $duracao
 * @property string $descricao
 * @property string $estado
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
            [['created_at', 'duracao', 'descricao', 'estado'], 'required'],
            [['created_at'], 'safe'],
            [['duracao'], 'integer'],
            [['descricao', 'estado'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'duracao' => 'Duracao',
            'descricao' => 'Descricao',
            'estado' => 'Estado',
        ];
    }
}

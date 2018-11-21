<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vacina".
 *
 * @property int $id
 * @property int $id_tratamento
 * @property string $vacina
 * @property string $data
 *
 * @property Tratamento $tratamento
 */
class Vacina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacina';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tratamento', 'vacina', 'data'], 'required'],
            [['id_tratamento'], 'integer'],
            [['data'], 'safe'],
            [['vacina'], 'string', 'max' => 255],
            [['id_tratamento'], 'exist', 'skipOnError' => true, 'targetClass' => Tratamento::className(), 'targetAttribute' => ['id_tratamento' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tratamento' => 'Id Tratamento',
            'vacina' => 'Vacina',
            'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamento()
    {
        return $this->hasOne(Tratamento::className(), ['id' => 'id_tratamento']);
    }
}

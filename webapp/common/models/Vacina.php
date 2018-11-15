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
            [['vacina', 'data'], 'string', 'max' => 255],
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
}

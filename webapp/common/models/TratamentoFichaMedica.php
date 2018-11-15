<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tratamento_ficha_medica".
 *
 * @property int $id_tratamento
 * @property int $id_ficha_medica
 */
class TratamentoFichaMedica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tratamento_ficha_medica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tratamento', 'id_ficha_medica'], 'required'],
            [['id_tratamento', 'id_ficha_medica'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tratamento' => 'Id Tratamento',
            'id_ficha_medica' => 'Id Ficha Medica',
        ];
    }
}

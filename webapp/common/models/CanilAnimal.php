<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "canil_animal".
 *
 * @property int $id
 * @property string $discricao
 * @property string $data_entrada
 * @property int $id_Animal
 * @property int $id_Canil
 */
class CanilAnimal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'canil_animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discricao', 'data_entrada', 'id_Animal', 'id_Canil'], 'required'],
            [['data_entrada'], 'safe'],
            [['id_Animal', 'id_Canil'], 'integer'],
            [['discricao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'discricao' => 'Discricao',
            'data_entrada' => 'Data Entrada',
            'id_Animal' => 'Id  Animal',
            'id_Canil' => 'Id  Canil',
        ];
    }
}

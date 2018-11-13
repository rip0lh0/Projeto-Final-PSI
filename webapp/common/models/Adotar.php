<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adotar".
 *
 * @property int $id
 * @property int $id_Adotante
 * @property int $id_canil_animal
 * @property string $data_adocao
 * @property string $descricao
 * @property int $state
 */
class Adotar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adotar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Adotante', 'id_canil_animal', 'data_adocao', 'descricao', 'state'], 'required'],
            [['id_Adotante', 'id_canil_animal', 'state'], 'integer'],
            [['data_adocao'], 'safe'],
            [['descricao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_Adotante' => 'Id  Adotante',
            'id_canil_animal' => 'Id Canil Animal',
            'data_adocao' => 'Data Adocao',
            'descricao' => 'Descricao',
            'state' => 'State',
        ];
    }
}

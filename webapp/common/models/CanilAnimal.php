<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "canil_animal".
 *
 * @property int $id
 * @property int $id_Animal
 * @property int $id_Canil
 * @property string $discricao
 * @property string $created_at
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
            [['id_Animal', 'id_Canil', 'discricao', 'created_at'], 'required'],
            [['id_Animal', 'id_Canil'], 'integer'],
            [['created_at'], 'safe'],
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
            'id_Animal' => 'Id  Animal',
            'id_Canil' => 'Id  Canil',
            'discricao' => 'Discricao',
            'created_at' => 'Created At',
        ];
    }
    /**
     *    Devolve Todos os ID's Dos Animais Pertencentes Ao Canil
     */
    public static function getCanilAnimals($canilID)
    {
        return static::find()
            ->where(['id_Canil' => $canilID])
            ->all();
    }

}

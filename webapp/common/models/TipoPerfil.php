<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_perfil".
 *
 * @property int $id
 * @property string $descricao
 */
class TipoPerfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_perfil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
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
            'descricao' => 'Descricao',
        ];
    }

    /*
     Find By Descrição
     */
    public function findByDescricao($descricao)
    {
        return static::findOne(['descricao' => $descricao]);
    }

}

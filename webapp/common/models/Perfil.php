<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_tipo
 * @property double $nif
 * @property string $nome
 * @property string $morada
 * @property string $localidade
 * @property string $nacionalidade
 * @property double $contacto
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_tipo', 'nif', 'nome', 'contacto'], 'required'],
            [['id_user', 'id_tipo'], 'integer'],
            [['nif', 'contacto'], 'number'],
            [['nome', 'morada', 'localidade', 'nacionalidade'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_tipo' => 'Id Tipo',
            'nif' => 'Nif',
            'nome' => 'Nome',
            'morada' => 'Morada',
            'localidade' => 'Localidade',
            'nacionalidade' => 'Nacionalidade',
            'contacto' => 'Contacto',
        ];
    }
}

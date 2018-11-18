<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tratamento".
 *
 * @property int $id
 * @property int $id_ficha_medica
 * @property string $created_at
 * @property int $duracao
 * @property string $descricao
 * @property string $estado
 *
 * @property FichaMedica $fichaMedica
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
            [['id_ficha_medica', 'created_at', 'duracao'], 'required'],
            [['id_ficha_medica', 'duracao'], 'integer'],
            [['created_at'], 'safe'],
            [['descricao', 'estado'], 'string', 'max' => 255],
            [['id_ficha_medica'], 'exist', 'skipOnError' => true, 'targetClass' => FichaMedica::className(), 'targetAttribute' => ['id_ficha_medica' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ficha_medica' => 'Id Ficha Medica',
            'created_at' => 'Created At',
            'duracao' => 'Duracao',
            'descricao' => 'Descricao',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichaMedica()
    {
        return $this->hasOne(FichaMedica::className(), ['id' => 'id_ficha_medica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacinas()
    {
        return $this->hasMany(Vacina::className(), ['id_tratamento' => 'id']);
    }
}

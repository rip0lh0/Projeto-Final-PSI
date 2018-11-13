<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dados_veterinarios".
 *
 * @property int $id
 * @property string $vacinacao
 * @property string $doencas
 */
class DadosVeterinarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dados_veterinarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vacinacao', 'doencas'], 'required'],
            [['vacinacao', 'doencas'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vacinacao' => 'Vacinacao',
            'doencas' => 'Doencas',
        ];
    }
}

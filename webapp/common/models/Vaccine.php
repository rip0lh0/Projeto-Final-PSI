<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vaccine".
 *
 * @property int $id
 * @property int $id_treatment
 * @property string $vaccine
 * @property string $date
 *
 * @property Treatment $treatment
 */
class Vaccine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vaccine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_treatment', 'vaccine'], 'required'],
            [['id_treatment'], 'integer'],
            [['date'], 'safe'],
            [['vaccine'], 'string', 'max' => 255],
            [['id_treatment'], 'exist', 'skipOnError' => true, 'targetClass' => Treatment::className(), 'targetAttribute' => ['id_treatment' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_treatment' => 'Id Treatment',
            'vaccine' => 'Vaccine',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatment()
    {
        return $this->hasOne(Treatment::className(), ['id' => 'id_treatment']);
    }
}

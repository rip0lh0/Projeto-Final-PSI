<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vaccine".
 *
 * @property int $id
 * @property int $id_tretment
 * @property string $vaccine
 * @property string $date
 *
 * @property Treatment $tretment
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
            [['id_tretment', 'vaccine'], 'required'],
            [['id_tretment'], 'integer'],
            [['date'], 'safe'],
            [['vaccine'], 'string', 'max' => 255],
            [['id_tretment'], 'exist', 'skipOnError' => true, 'targetClass' => Treatment::className(), 'targetAttribute' => ['id_tretment' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tretment' => 'Id Tretment',
            'vaccine' => 'Vaccine',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTretment()
    {
        return $this->hasOne(Treatment::className(), ['id' => 'id_tretment']);
    }
}

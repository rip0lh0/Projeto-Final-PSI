<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "social".
 *
 * @property int $id
 * @property string $facebook
 * @property string $instagram
 * @property string $youtube
 *
 * @property Kennel[] $kennels
 */
class Social extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['facebook', 'instagram', 'youtube'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'youtube' => 'Youtube',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKennels()
    {
        return $this->hasMany(Kennel::className(), ['id_social' => 'id']);
    }
}

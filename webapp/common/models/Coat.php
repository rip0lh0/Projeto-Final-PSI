<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "coat".
 *
 * @property int $id
 * @property string $coat_size
 */
class Coat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coat_size'], 'required'],
            [['coat_size'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coat_size' => 'Coat Size',
        ];
    }
}

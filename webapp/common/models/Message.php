<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $id_parent
 * @property int $id_adoption
 * @property string $message
 * @property int $satus
 * @property int $created_at
 *
 * @property Adoption $adoption
 * @property Message $parent
 * @property Message[] $messages
 */
class Message extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parent', 'id_adoption', 'satus'], 'integer'],
            [['message', 'satus'], 'required'],
            [['message'], 'string', 'max' => 255],
            [['id_adoption'], 'exist', 'skipOnError' => true, 'targetClass' => Adoption::className(), 'targetAttribute' => ['id_adoption' => 'id']],
            [['id_parent'], 'exist', 'skipOnError' => true, 'targetClass' => Message::className(), 'targetAttribute' => ['id_parent' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at']
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parent' => 'Id Parent',
            'id_adoption' => 'Id Adoption',
            'message' => 'Message',
            'satus' => 'Satus',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdoption()
    {
        return $this->hasOne(Adoption::className(), ['id' => 'id_adoption']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Message::className(), ['id' => 'id_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['id_parent' => 'id']);
    }
}

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
 * @property int $status
 * @property int $created_at
 * @property int $id_user
 *
 * @property Adoption $adoption
 * @property Animal $parent
 * @property User $user
 */
class Message extends ActiveRecord
{
    public const STATUS_UNREAD = 10;
    public const STATUS_READ = 20;
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
            ['status', 'default', 'value' => self::STATUS_UNREAD],
            ['status', 'in', 'range' => [self::STATUS_UNREAD, self::STATUS_READ]],
            [['id_parent', 'id_adoption', 'id_user'], 'integer'],
            [['message', 'status', 'id_user'], 'required'],
            [['message'], 'string', 'max' => 255],
            [['id_adoption'], 'exist', 'skipOnError' => true, 'targetClass' => Adoption::className(), 'targetAttribute' => ['id_adoption' => 'id']],
            [['id_parent'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::className(), 'targetAttribute' => ['id_parent' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'id_user' => 'Id User',
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
        return $this->hasOne(Animal::className(), ['id' => 'id_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}

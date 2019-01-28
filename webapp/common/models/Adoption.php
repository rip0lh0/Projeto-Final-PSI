<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
// use yii\common\User;
use common\models\User;

/**
 * This is the model class for table "adoption".
 *
 * @property int $id
 * @property int $id_adopter
 * @property int $id_kennelAnimal
 * @property int $created_at
 * @property int $updated_at
 * @property string $description
 * @property int $status
 *
 * @property Adopter $adopter
 * @property KennelAnimal $kennelAnimal
 * @property Message[] $messages
 */

class Adoption extends ActiveRecord
{
    public const STATUS_REFUSED = 0;
    public const STATUS_PENDENT = 10;
    public const STATUS_ACCEPTED = 20;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adoption';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_PENDENT],
            ['status', 'in', 'range' => [self::STATUS_REFUSED, self::STATUS_PENDENT, self::STATUS_ACCEPTED]],
            [['id_adopter', 'id_kennelAnimal'], 'required'],
            [['id_adopter', 'id_kennelAnimal', 'status'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['id_adopter'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_adopter' => 'id']],
            [['id_kennelAnimal'], 'exist', 'skipOnError' => true, 'targetClass' => KennelAnimal::className(), 'targetAttribute' => ['id_kennelAnimal' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
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
            'id_adopter' => 'Id Adopter',
            'id_kennelAnimal' => 'Id Kennel Animal',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdopter()
    {
        return $this->hasOne(Adopter::className(), ['id' => 'id_adopter']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKennelAnimal()
    {
        return $this->hasOne(KennelAnimal::className(), ['id' => 'id_kennelAnimal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['id_adoption' => 'id'])->orderBy('created_at DESC');
    }


    public function getRecentMessage()
    {
        return $this->hasOne(Message::className(), ['id_adoption' => 'id'])->orderBy('created_at DESC');
    }
}

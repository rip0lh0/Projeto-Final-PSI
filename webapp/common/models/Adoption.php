<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "adoption".
 *
 * @property int $id
 * @property int $id_adopter
 * @property int $id_animal
 * @property string $created_at
 * @property string $updated_at
 * @property string $description
 * @property int $state
 *
 * @property Message[] $messages
 */
class Adoption extends \yii\db\ActiveRecord
{
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
            [['id_adopter', 'id_animal'], 'required'],
            [['id_adopter', 'id_animal', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
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
            'id_animal' => 'Id Animal',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'description' => 'Description',
            'state' => 'State',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['id_adoption' => 'id']);
    }
}

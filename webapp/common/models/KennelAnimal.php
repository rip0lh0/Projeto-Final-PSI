<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "kennel_animal".
 *
 * @property int $id
 * @property int $id_kennel
 * @property int $id_animal
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 *
 * @property Adoption[] $adoptions
 * @property Animal $animal
 * @property Kennel $kennel
 */
class KennelAnimal extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    //const STATUS_IN_KENNEL = 1;
    const STATUS_FOR_ADOPTION = 2;
    const STATUS_BAN = 3;
    const STATUS_ADOPTED = 4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kennel_animal';
    }

    public static function status($state)
    {
        switch ($state) {
            case self::STATUS_DELETED:
                return [
                    "options" => "danger",
                    "msg" => "Removido",
                ];
            // case self::STATUS_IN_KENNEL:
            //     return [
            //         "options" => "warning",
            //         "msg" => "No Canil",
            //     ];
            case self::STATUS_FOR_ADOPTION:
                return [
                    "options" => "warning",
                    "msg" => "Para Adoção",
                ];
            case self::STATUS_BAN:
                return [
                    "options" => "danger",
                    "msg" => "Banido",
                ];
            case self::STATUS_ADOPTED:
                return [
                    "options" => "success",
                    "msg" => "Adotado",
                ];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_FOR_ADOPTION],
            ['status', 'in', 'range' => [
                self::STATUS_DELETED,
                //self::STATUS_IN_KENNEL,
                self::STATUS_FOR_ADOPTION,
                self::STATUS_BAN,
                self::STATUS_ADOPTED
            ]],
            [['id_kennel', 'id_animal'], 'required'],
            [['id_kennel', 'id_animal'], 'integer'],
            [['id_animal'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::className(), 'targetAttribute' => ['id_animal' => 'id']],
            [['id_kennel'], 'exist', 'skipOnError' => true, 'targetClass' => Kennel::className(), 'targetAttribute' => ['id_kennel' => 'id']],
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
            'id_kennel' => 'Id Kennel',
            'id_animal' => 'Id Animal',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdoptions()
    {
        return $this->hasMany(Adoption::className(), ['id_animal' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animal::className(), ['id' => 'id_animal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKennel()
    {
        return $this->hasOne(Kennel::className(), ['id' => 'id_kennel']);
    }
}

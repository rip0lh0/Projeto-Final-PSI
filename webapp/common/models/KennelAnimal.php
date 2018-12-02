<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kennel_animal".
 *
 * @property int $id
 * @property int $id_kennel
 * @property int $id_animal
 * @property string $created_at
 * @property string $updated_at
 * @property int $state
 *
 * @property Adoption[] $adoptions
 * @property Animal $animal
 * @property Kennel $kennel
 */
class KennelAnimal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kennel_animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kennel', 'id_animal', 'created_at', 'updated_at'], 'required'],
            [['id_kennel', 'id_animal', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['id_animal'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::className(), 'targetAttribute' => ['id_animal' => 'id']],
            [['id_kennel'], 'exist', 'skipOnError' => true, 'targetClass' => Kennel::className(), 'targetAttribute' => ['id_kennel' => 'id']],
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
            'state' => 'State',
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

<?php

namespace common\models;

use Yii;

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
 * @property Adopter $adopter
 * @property KennelAnimal $animal
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
            [['id_adopter', 'id_animal', 'created_at', 'updated_at'], 'required'],
            [['id_adopter', 'id_animal', 'state'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['id_adopter'], 'exist', 'skipOnError' => true, 'targetClass' => Adopter::className(), 'targetAttribute' => ['id_adopter' => 'id']],
            [['id_animal'], 'exist', 'skipOnError' => true, 'targetClass' => KennelAnimal::className(), 'targetAttribute' => ['id_animal' => 'id']],
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
    public function getAdopter()
    {
        return $this->hasOne(Adopter::className(), ['id' => 'id_adopter']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(KennelAnimal::className(), ['id' => 'id_animal']);
    }
}

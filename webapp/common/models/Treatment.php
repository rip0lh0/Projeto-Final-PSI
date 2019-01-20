<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "treatment".
 *
 * @property int $id
 * @property string $description
 * @property int $id_animal
 * @property string $name
 *
 * @property Animal $animal
 * @property Vaccine[] $vaccines
 */
class Treatment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'treatment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_animal'], 'required'],
            [['id_animal'], 'integer'],
            [['description', 'name'], 'string', 'max' => 255],
            [['id_animal'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::className(), 'targetAttribute' => ['id_animal' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'id_animal' => 'Id Animal',
            'name' => 'Name',
        ];
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
    public function getVaccines()
    {
        return $this->hasMany(Vaccine::className(), ['id_tretment' => 'id']);
    }
}

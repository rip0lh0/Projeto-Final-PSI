<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * This is the model class for table "animal".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property AnimalFile[] $animalFiles
 * @property KennelAnimal[] $kennelAnimals
 */
class Animal extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalFile()
    {
        return $this->hasOne(AnimalFile::className(), ['id_animal' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKennelAnimals()
    {
        return $this->hasMany(KennelAnimal::className(), ['id_animal' => 'id']);
    }

    public function getCurrKennel()
    {
        return $this->hasMany(KennelAnimal::className(), ['id_animal' => 'id'])->orderBy('created_at DESC')->one();
    }


    public function getImage($imageName)
    {
        $kennel = $this->currKennel->kennel->user->email;
        $kennel = substr($kennel, 0, strpos($kennel, "@"));

        $imagePath = Yii::getAlias('@uploads') . '/animals/' . $kennel . '/' . $this->name . '/' . $imageName . '.png';
        // echo Html::img($imagePath);

        $fp = fopen($imagePath, 'r');
        $data = fread($fp, filesize($imagePath));

        echo '<img src="data:image/jpeg;base64,' . base64_encode($data) . '" style="width: 100%; object-fit: cover; height: 300px"/>';
        fclose($fp);
    }

}

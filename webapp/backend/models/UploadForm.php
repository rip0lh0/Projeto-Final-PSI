<?php 

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use common\models\User;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 8],
        ];
    }

    public function upload()
    {
        if (!User::isKennel()) return false;

        $UserName = Yii::$app->user->identity->username;

        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $path = 'uploads/' . $UserName;
                FileHelper::createDirectory($path);
                $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}
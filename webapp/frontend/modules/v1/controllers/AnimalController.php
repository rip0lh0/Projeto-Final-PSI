<?php
namespace frontend\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;

/* @Mosquitto */
use frontend\modules\v1\mosquitto\phpMQTT;
use frontend\modules\v1\mosquitto\config\ServerProperties;

/* @Models */
use common\models\Animal;
use common\models\AnimalFile;

class AnimalController extends ActiveController
{
    public $modelClass = 'common\models\Animal';

    // public function checkAccess($action, $model = null, $params = [])
    // {
    //     if ($action === 'create-animal') {
    //         if (Yii::$app->user->isGuest && Yii::$app->user->checkAccess('kennel')) {
    //             throw new ForbiddenHttpException('Kennels can performe ' . $action);
    //         }
    //     }
    // }

    /* GET Animal, AnimalFile */
    public function actionProfile($id)
    {
        $animal = Animal::find()->where(['id' => $id])->one();

        if (empty($animal)) return ['Error' => 'Animal Not Found'];

        $animalFile = AnimalFile::find()->where(['id_animal' => $animal['id']])->one();

        //unset($animalFile['id_animal']);

        $profile = [];
        $profile['animal'] = $animal;
        $profile['animal_file'] = $animalFile;

        return $profile;
    }


    public function PublishToChannel($channelName, $jsonData)
    {
        $publisherID = "phpMQTT-Yii2_PUB";

        $mqtt = new phpMQTT(ServerProperties::_SERVER, ServerProperties::_PORT, $publisherID);

        if (!$mqtt->connect(true, null, "yii2_pub", null)) return "Output Time out";

        /* Set Retain to True */
        $mqtt->publish($channelName, $jsonData, 0, true);

        $mqtt->close();
        return ['Success' => 'Data has been Publish to (' . $channelName . ')', 'Data' => Json::decode($jsonData)];
    }
}
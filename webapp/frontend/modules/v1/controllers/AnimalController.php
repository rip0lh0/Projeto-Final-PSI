<?php
namespace frontend\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\db\Command;

/* @Mosquitto */
use frontend\modules\v1\mosquitto\phpMQTT;
use frontend\modules\v1\mosquitto\config\ServerProperties;

/* @Models */
use common\models\Animal;
use common\models\AnimalFile;
use common\models\KennelAnimal;
use common\models\Kennel;
use common\models\User;
use common\models\Coat;
use common\models\Energy;
use common\models\Size;
use backend\models\ImageHandler;

class AnimalController extends ActiveController
{
    public $modelClass = 'common\models\Animal';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);

        return $actions;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
            ],
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        $table_animal = Animal::tableName();
        $table_kennelAnimal = KennelAnimal::tableName();
        $table_coat = Coat::tableName();
        $table_energy = Energy::tableName();
        $table_size = Size::tableName();
        $table_kennel = Kennel::tableName();


        $animals = Yii::$app->db->createCommand('
                SELECT a.id, a.name, a.description, c.coat_size, e.energy, s.size, a.chip, a.age, a.gender, a.weight, a.neutered, ka.id_kennel, ka.created_at
                FROM animal a
                INNER JOIN kennel_animal ka ON ka.id_animal = a.id
                INNER JOIN coat c ON c.id = a.id_coat
                INNER JOIN size s ON s.id = a.id_size
                INNER JOIN energy e ON e.id = a.id_energy
                WHERE KA.status = ' . KennelAnimal::STATUS_FOR_ADOPTION . '
                ORDER BY KA.created_at DESC
            ')
            ->queryAll();

        foreach ($animals as $key => $value) {
            $value['images'] = ImageHandler::load_from_final($value['id_kennel'] . '/' . $value['created_at']);
            $animals[$key] = $value;
        }

        return ["success" => $animals];
    }

    public function actionDownloadImage($source_path)
    {
        $full_path = Yii::getAlias('@common') . '/uploads/animals/' . $source_path;
        if (file_exists($full_path)) {
            return Yii::$app->response->sendFile($full_path);
        } else {
            return ["error" => "Faild to load image"];
        }
    }
    // public function checkAccess($action, $model = null, $params = [])
    // {
    //     if ($action === 'create-animal') {
    //         if (Yii::$app->user->isGuest && Yii::$app->user->checkAccess('kennel')) {
    //             throw new ForbiddenHttpException('Kennels can performe ' . $action);
    //         }
    //     }
    // }

    /* GET Animal, AnimalFile */
    // public function actionProfile($id)
    // {
    //     $animal = Animal::find()->where(['id' => $id])->one();

    //     if (empty($animal)) return ['Error' => 'Animal Not Found'];

    //     $animalFile = AnimalFile::find()->where(['id_animal' => $animal['id']])->one();

    //     //unset($animalFile['id_animal']);

    //     $profile = [];
    //     $profile['animal'] = $animal;
    //     $profile['animal_file'] = $animalFile;

    //     return $profile;
    // }


    // public function PublishToChannel($channelName, $jsonData)
    // {
    //     $publisherID = "phpMQTT-Yii2_PUB";

    //     $mqtt = new phpMQTT(ServerProperties::_SERVER, ServerProperties::_PORT, $publisherID);

    //     if (!$mqtt->connect(true, null, "yii2_pub", null)) return "Output Time out";

    //     /* Set Retain to True */
    //     $mqtt->publish($channelName, $jsonData, 0, true);

    //     $mqtt->close();
    //     return ['Success' => 'Data has been Publish to (' . $channelName . ')', 'Data' => Json::decode($jsonData)];
    // }
}
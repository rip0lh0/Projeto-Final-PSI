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

    // public function behaviors()
    // {
    //     $behaviors = parent::behaviors();
    //     $behaviors['access'] = [
    //         'class' => AccessControl::className(),
    //         'only' => ['CreateAnimal'],
    //         'rules' => [
    //             [
    //                 'allow' => true,
    //                 'roles' => ['Kennel'],
    //             ],
    //         ],
    //     ];
    //     return $behaviors;
    // }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'post' || $action === 'delete' || $action === 'create-animal') if (Yii::$app->user->isGuest) throw new \yii\web\ForbiddenHttpException('Apenas Utilizadores registados podem executar' . $action);
    }


    /**
     * Inserts A New Animal And His Medical File
     *
     * @return mixed
     */
    public function actionCreateAnimal()
    {
        $request = Yii::$app->request;
        if (!$request->isPost) return ["Error" => 'Please check your request method.'];

        $postData = $request->post();

        $animalData = new Animal();
        $fileData = new AnimalFile();

        /* Post Data To Animal */
        $animalData->name = $postData["name"];
        $animalData->description = $postData["description"];

        /* Post Data To Animal File */
        $fileData->chip = $postData["chip"];
        $fileData->neutered = $postData["neutered"];
        $fileData->gender = $postData["gender"];
        $fileData->weight = $postData["weight"];
        $fileData->age = $postData["age"];

        /* Validate And Save  */
        if ($animalData->validate() && $animalData->save()) {
            $fileData->id_animal = $animalData->id;
            $fileData->created_at = date('Y-m-d H:i:s');
            $fileData->updated_at = date('Y-m-d H:i:s');

            if ($fileData->validate() && $fileData->save()) {

                $msgJson = Yii::$app->request->post();
                return $this->PublishToChannel("New Animal", Json::encode($msgJson));
            } else
                $animalData->delete();
        }

        return ["Error" => 'Animal already exists'];
    }
    
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
        //$username = Yii::$app->user->identity->username;
        // $publisherID = "phpMQTT-" . $username;
        $publisherID = "phpMQTT-Yii2_PUB";

        $mqtt = new phpMQTT(ServerProperties::_SERVER, ServerProperties::_PORT, $publisherID);

        if (!$mqtt->connect(true, null, "yii2_pub", null)) return "Output Time out";

        /* Set Retain to True */
        $mqtt->publish($channelName, $jsonData, 0, true);

        $mqtt->close();
        return ['Success' => 'Data has been Publish to (' . $channelName . ')', 'Data' => Json::decode($jsonData)];
    }
}
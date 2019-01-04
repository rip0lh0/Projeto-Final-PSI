<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/* @Mosquitto */
use api\mosquitto\phpMQTT;
use api\models\ServerProperties;
/* @Models */
use common\models\Animal;
use common\models\AnimalFile;

class AnimalController extends ActiveController
{
    public $modelClass = 'common\models\Animal';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['filter-by-animal-age', 'new-animal'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['kennel']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['new-animal'],
                        'roles' => ['?']
                    ]
                ],
            ],
        ];
    }

    /**
     * Selects All the Animals with a certain age
     *
     * @return mixed
     */
    public function actionFilterByAnimalAge($min_age)
    {
        $filteredAnimals = AnimalFile::find()
            ->where(['>=', 'age', $min_age])
            ->andWhere(['not', ['age' => null]])
            ->all();

        return $filteredAnimals;
    }


    /**
     * Inserts A New Animal And His Medical File
     *
     * @return mixed
     */
    public function actionNewAnimal()
    {
        $postData = Yii::$app->request->post();

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


                $msgJson = json_encode(Yii::$app->request->post());
                $this->PublishToChannel("New Animal", $msgJson);

                return $msgJson;

            } else
                $animalData->delete();
        }

        return "Error Saving Data (Some field is wrong or animal already exists)";
    }

    private function PublishToChannel($channelName, $jsonData)
    {
        $username = Yii::$app->user->identity->username;
        $publisherID = "phpMQTT-" . $username;

        $mqtt = new phpMQTT(ServerProperties::_SERVER, ServerProperties::_PORT, $publisherID);

        if (!$mqtt->connect(true, null, $username, null)) return "Output Time out";

        /* Set Retain to True */
        $mqtt->publish($channelName, $jsonData, 0, true);

        echo "Animal has been Publish";
        $mqtt->close();
    }
}
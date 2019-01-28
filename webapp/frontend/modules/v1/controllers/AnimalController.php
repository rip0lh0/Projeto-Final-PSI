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
use common\models\Adoption;
use common\models\Message;
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


    public function actionPublishMessage()
    {
        $username = Yii::$app->request->post("username");
        $message_text = Yii::$app->request->post("message");

        $user = User::findByUsername($username);
        $user_role = Yii::$app->authManager->getRolesByUser($user->id);

        if (key_exists("kennel", $user_role)) return ["error" => "Faild To Save Message"];

        $kennelAnimal = KennelAnimal::find()->where(["created_at" => Yii::$app->request->post("created_at")])->one();

        if ($kennelAnimal == null) return ["error" => "Faild To Save Message"];

        $adoption = new Adoption();
        $message = new Message();

        $adoption->id_adopter = $user->id;
        $adoption->id_kennelAnimal = $kennelAnimal->id;

        if (!$adoption->save()) return ["error" => "Faild To Save Adoption"];

        $message->id_user = $user->id;
        $message->id_adoption = $adoption->id;
        $message->message = $message_text;

        if (!$message->save()) {
            $adoption->delete();
            return ["error" => "Faild To Save Adoption"];
        }

        return ["success" => $message];
    }

}
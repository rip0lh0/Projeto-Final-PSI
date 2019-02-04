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
                'index' => ['get']
            ],
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        $kennelAnimals = KennelAnimal::find()->where(['status' => KennelAnimal::STATUS_FOR_ADOPTION])->all();

        $data_animals = [];

        foreach ($kennelAnimals as $key => $value) {
            $data_animals[$key] = $value->attributes;
            $data_animals[$key]["animal"] = $value->animal->attributes;
            $data_animals[$key]["animal"]["energy"] = $value->animal->energy->energy;
            $data_animals[$key]["animal"]["coat"] = $value->animal->coat->coat_size;
            $data_animals[$key]["animal"]["size"] = $value->animal->size->size;

            $data_animals[$key]["kennel"] = $value->kennel->attributes;

            $local = $value->kennel->local;
            $local_name = ($local != null && $local->parent != null) ? $local->parent->name . ', ' . $local->name : $local->name;
            $data_animals[$key]["kennel"]["local"] = $local_name;

            unset($data_animals[$key]["kennel"]["id_local"]);
            unset($data_animals[$key]["animal"]["id_energy"]);
            unset($data_animals[$key]["animal"]["id_coat"]);
            unset($data_animals[$key]["animal"]["id_size"]);

            $data_animals[$key]['images'] = ImageHandler::load_from_final($value->id_kennel . '/' . $value->created_at);
        }

        return ["success" => $data_animals];
    }

    public function actionProfile($id)
    {
        $kennelAnimal = KennelAnimal::find()->where(['id' => $id, 'status' => KennelAnimal::STATUS_FOR_ADOPTION])->one();

        if ($kennelAnimal == null) return ["error" => "Faild to load Animal"];

        $data_animals = $kennelAnimal->attributes;
        $data_animals = $kennelAnimal->attributes;
        $data_animals["animal"] = $kennelAnimal->animal->attributes;
        $data_animals["animal"]["energy"] = $kennelAnimal->animal->energy->energy;
        $data_animals["animal"]["coat"] = $kennelAnimal->animal->coat->coat_size;
        $data_animals["animal"]["size"] = $kennelAnimal->animal->size->size;
        $data_animals["kennel"] = $kennelAnimal->kennel->attributes;

        $local = $kennelAnimal->animal->kennelAnimal->kennel->local;
        $local_name = ($local != null && $local->parent != null) ? $local->parent->name . ', ' . $local->name : $local->name;
        $data_animals["kennel"]["local"] = $local_name;

        unset($data_animals["kennel"]["id_local"]);
        unset($data_animals["animal"]["id_energy"]);
        unset($data_animals["animal"]["id_coat"]);
        unset($data_animals["animal"]["id_size"]);

        $data_animals['images'] = ImageHandler::load_from_final($kennelAnimal->animal->kennelAnimal->id_kennel . '/' . $kennelAnimal->animal->kennelAnimal->created_at);


        return ["success" => $data_animals];
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


    public function actionPublishMessage($id_kennelAnimal)
    {
        $username = Yii::$app->request->post("username");
        $message_text = Yii::$app->request->post("message");

        if (!$username || !$message_text) return ["error" => "Faild To Save Message"];

        $user = User::findByUsername($username);
        $user_role = Yii::$app->authManager->getRolesByUser($user->id);
        if (key_exists("kennel", $user_role)) return ["error" => "Faild To Save Message"];

        $kennelAnimal = KennelAnimal::find()->where(["id" => $id_kennelAnimal])->one();
        if ($kennelAnimal == null) return ["error" => "Faild To Save Message"];

        $adoption = Adoption::find()->where(["id_adopter" => $user->id, "id_kennelAnimal" => $kennelAnimal->id])->one();

        if (!$adoption) {
            $adoption = new Adoption();

            $adoption->id_adopter = $user->id;
            $adoption->id_kennelAnimal = $kennelAnimal->id;

            if (!$adoption->save()) return ["error" => "Faild To Save Adoption"];
        }

        $message = new Message();

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
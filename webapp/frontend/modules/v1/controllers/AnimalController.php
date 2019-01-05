<?php
namespace frontend\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/* @Mosquitto */
use api\mosquitto\phpMQTT;
use api\mosquitto\ServerProperties;
/* @Models */
use common\models\Animal;
use common\models\AnimalFile;

class AnimalController extends ActiveController
{
    public $modelClass = 'common\models\Animal';


}
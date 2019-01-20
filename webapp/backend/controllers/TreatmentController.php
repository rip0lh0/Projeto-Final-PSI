<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use common\models\User;
use common\models\Animal;
use common\models\KennelAnimal;
use common\models\Treatment;
use backend\models\TreatmentForm;

class TreatmentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['kennel']
                    ],
                ],
            ],
        ];
    }


    public function actionIndex($id_animal)
    {
        $this->validateUser($id_animal);
        $animal = Animal::find()->where(['id' => $id_animal])->one();

        /* Animal Treatments */
        $treatments = $animal->getTreatments();

        $dataProvider = new ActiveDataProvider([
            'query' => $treatments,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'animal' => $animal
        ]);
    }

    public function actionView($id_treatment)
    {

    }

    public function actionCreate($id_animal)
    {
        $model = new TreatmentForm();
        $model->id_animal = $id_animal;

        $result = [];

        if ($model->load(Yii::$app->request->post())) {
            $model->vaccine_name = Yii::$app->request->post('TreatmentForm')['vaccine_name'];
            $model->vaccine_date = Yii::$app->request->post('TreatmentForm')['vaccine_date'];
            $result = $model->saveTreatment();
            if (array_key_exists('success', $result)) {
                return $this->redirect(['treatment/index', 'id_animal' => $id_animal]);
            }
        }

        //var_dump(Yii::$app->request->post('TreatmentForm')['vaccine']);
        return $this->render('create', [
            'model' => $model,
            'result' => $result
        ]);
    }

    public function actionUpdate($id_treatment)
    {

    }

    public function actionDelete($id_treatment)
    {
        $treatment = Treatment::find()->where(['id' => $id_treatment])->one();
        if (!$treatment) throw new NotFoundHttpException();
        $this->validateUser($treatment->animal->id);

        $treatment->delete();

        return $this->redirect(['treatment/index', 'id_animal' => $treatment->animal->id]);
    }


    protected function validateUser($id_animal)
    {
        /* Validations */
        $kennel = User::findIdentity(Yii::$app->user->id)->kennel;
        $animal = Animal::find()->where(['id' => $id_animal])->one();
        if (!KennelAnimal::find()->where(['id_animal' => $animal->id, 'id_kennel' => $kennel->id])->one()) throw new NotFoundHttpException();

    }
}
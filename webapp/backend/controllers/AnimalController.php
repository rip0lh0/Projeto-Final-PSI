<?php

namespace backend\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/* Backend Models */
use backend\models\UploadForm;
use backend\models\AnimalForm;
use backend\models\AnimalSearch;
/* Common Models */
use common\models\Animal;
use common\models\User;
use common\models\Breed;
use common\models\KennelAnimal;
use yii\helpers\Json;
use common\models\Coat;
use common\models\Energy;
use common\models\Size;
/**
 * AnimalController implements the CRUD actions for Animal model.
 */
class AnimalController extends Controller
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
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'create' => ['POST'],
            //     ],
            // ],
        ];
    }

    /**
     * Lists all Animal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $kennel = User::findIdentity(Yii::$app->user->id)->kennel;

        $kennelAnimals = $kennel->kennelAnimals;

        $searchModel = new AnimalSearch();
        $searchModel->id_kennel = $kennel->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $kennel);

        return $this->render('index', [
            'kennelAnimals' => $kennelAnimals,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Displays a single Animal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $animalKennel = $this->findAnimalInKennel($id);

        if (!$animalKennel) throw new NotFoundHttpException();

        return $this->render('view', [
            'animal' => $animalKennel->animal,
        ]);
    }

    /**
     * Creates a new Animal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnimalForm();
        $coat = Coat::find()->asArray()->all();
        $energy = Energy::find()->asArray()->all();
        $size = Size::find()->asArray()->all();
        //$breed = Breed::find()->where(['id_parent' => null])->asArray()->all();
        $error = '';

        if ($model->load(Yii::$app->request->post())) {
            $model->photos = UploadedFile::getInstances($model, 'photos');

            if ($model->saveAnimal()) return $this->redirect(['animal/index']);
            else $error = 'Erro ao salvar os Dados';
        }

        return $this->render('create', [
            //'breed' => $breed,
            'coat' => $coat,
            'energy' => $energy,
            'size' => $size,
            'model' => $model,
            'error' => $error
        ]);
    }

    // Create Functions That Loads Selected Data (ID)
    // public function actionSubbreed($id)
    // {
    //     $dataReceived = Breed::find()->where(['id_parent' => $id])->asArray()->all();

    //     if (!empty($dataReceived)) {
    //         foreach ($dataReceived as $data) {
    //             echo "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
    //         }
    //     } else {
    //         echo "<option value=''>-</option>";
    //     }
    // }

    /**
     * Updates an existing Animal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Animal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $kennelAnimal = $this->findAnimalInKennel($id);

        if ($kennelAnimal->status == KennelAnimal::STATUS_DELETED)
            $kennelAnimal->status = KennelAnimal::STATUS_FOR_ADOPTION;
        else
            $kennelAnimal->status = KennelAnimal::STATUS_DELETED;

        $kennelAnimal->save();

        return $this->redirect(['animal/index']);
    }

    /**
     * Finds the Animal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer  $id
     * @return Animal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Animal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function findAnimalInKennel($id)
    {
        $kennel_id = User::findIdentity(Yii::$app->user->id)->kennel->id;
        $animal = KennelAnimal::find()->where(['id' => $id, 'id_kennel' => $kennel_id])->one();

        return $animal;
    }
}

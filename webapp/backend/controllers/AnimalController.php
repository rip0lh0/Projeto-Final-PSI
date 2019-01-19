<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
/* Backend Models */
use backend\models\UploadForm;
use backend\models\AnimalForm;
use backend\models\AnimalSearch;
use backend\models\ImageHandler;
/* Common Models */
use common\models\Animal;
use common\models\User;
use common\models\Breed;
use common\models\KennelAnimal;
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
    public function actionView($id_animal)
    {
        $animalKennel = $this->findAnimalInKennel($id_animal);

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

        // Set Kennel ID
        $model->id_Kennel = User::findIdentity(Yii::$app->user->id)->kennel->id;

        // Get Pre Define Values
        $coat = Coat::find()->asArray()->all();
        $energy = Energy::find()->asArray()->all();
        $size = Size::find()->asArray()->all();

        // UI Messages
        $result = [];

        // Validate Data
        if ($model->load(Yii::$app->request->post())) {
            $result = $model->createAnimal();
            if (array_key_exists('Success', $result)) {
                return $this->redirect(['animal/index']);
            }
        }

        if (!Yii::$app->request->post()) {
            //var_dump(Yii::$app->request->post());
            ImageHandler::delete_directory($model->id_Kennel);
        }

        return $this->render('create', [
            // Pre Define Values
            'coat' => $coat,
            'energy' => $energy,
            'size' => $size,
            // Model
            'model' => $model,
            // UI Messages
            'result' => $result
        ]);
    }

    /**
     * Updates an existing Animal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_animal)
    {
        $model = $this->findModel($id_animal);

        $coat = Coat::find()->asArray()->all();
        $energy = Energy::find()->asArray()->all();
        $size = Size::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->updateAnimal()) return $this->redirect(['animal/index']);
            else $error = 'Erro ao salvar os Dados';
        } 
        
        //ImageHandler::delete_directory($model->id_Kennel);


        return $this->render('update', [
            'coat' => $coat,
            'energy' => $energy,
            'size' => $size,
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
    public function actionDelete($id_animal)
    {
        $kennel_animal = $this->findAnimalInKennel($id_animal);

        if ($kennel_animal->status == KennelAnimal::STATUS_DELETED) {
            $kennel_animal->status = KennelAnimal::STATUS_FOR_ADOPTION;
        } else {
            $kennel_animal->status = KennelAnimal::STATUS_DELETED;
        }

        $kennel_animal->save();

        return $this->redirect(['animal/index']);
    }

    /**
     * Finds the Animal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer  $id
     * @return Animal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_animal)
    {
        $kennel_animal = $this->findAnimalInKennel($id_animal);
        if (!$kennel_animal) throw new NotFoundHttpException();

        $animal = $kennel_animal->animal;
        if ($animal == null) throw new NotFoundHttpException();

        $model = new AnimalForm();
        $model->id_Kennel = $kennel_animal->id_kennel;
        $model->attributes = $animal->attributes;
        $model->id = $animal->id;

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findAnimalInKennel($id_animal)
    {
        $id_kennel = User::findIdentity(Yii::$app->user->id)->kennel->id;
        $kennel_animal = KennelAnimal::find()->where(['id' => $id_animal, 'id_kennel' => $id_kennel])->one();

        return $kennel_animal;
    }

    public function actionUploadTempFile()
    {
        $id_Kennel = User::findIdentity(Yii::$app->user->id)->kennel->id;
        $file_data_name = 'uploaded_file';

        if (isset($_FILES[$file_data_name])) {

            return Json::encode(ImageHandler::temp_upload($file_data_name, $_FILES[$file_data_name]['name'], $id_Kennel));
        }

        return false;
    }

    public function actionRemoveTempFile()
    {
        $id_Kennel = User::findIdentity(Yii::$app->user->id)->kennel->id;

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $file_name = $data['name'];

            echo Json::encode(ImageHandler::delete_image($file_name, $id_Kennel));
        }
    }
}

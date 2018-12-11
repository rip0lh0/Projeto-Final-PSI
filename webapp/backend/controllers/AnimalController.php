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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
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

        return $this->render('index', ['kennelAnimals' => $kennelAnimals, 'dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    /**
     * Displays a single Animal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = KennelAnimal::find()->where(['id' => $id])->one();

        return $this->render('view', [
            'model' => $model,
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
        $breed = Breed::find()->where(['id_parent' => null])->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->saveData()) {
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'breed' => $breed,
            'model' => $model,
        ]);
    }

    // Create Functions That Loads Selected Data (ID)
    public function actionSubbreed()
    {
        $out = [];

        if (Yii::$app->request->post('depdrop_parents')) {
            $parents = Yii::$app->request->post('depdrop_parents');
            if ($parents != null) {
                $id_breed = $parents[0];
                $out = Breed::find()->where(['id_parent' => $id_breed])->all();

                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
}

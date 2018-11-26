<?php

namespace backend\controllers;

use Yii;
use common\models\Animal;
use common\models\User;
use common\models\Perfil;
use common\models\CanilAnimal;
use common\models\Ficha;
use common\models\Raca;
use common\models\TypeAnimal;
use backend\models\UploadForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

use phpDocumentor\Reflection\Types\Integer;
use backend\models\CanilAnimalSearch;


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
        $perfil = User::findIdentity(Yii::$app->user->id)->profile;

        $canilAnimals = $perfil->canilAnimals;

        $searchModel = new CanilAnimalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $perfil);

        return $this->render('index', ['canilAnimals' => $canilAnimals, 'dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    /**
     * Displays a single Animal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = CanilAnimal::find()->where(['id' => $id])->one();

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
        $animalModel = new Animal();
        $fichaModel = new Ficha();
        $racaModel = new Raca();
        $uploadModel = new UploadForm();
        $canilAnimal = new CanilAnimal();

        $tiposAnimaisRaw = TypeAnimal::find()->asArray()->all();

        foreach ($tiposAnimaisRaw as $value) {
            $tiposAnimais[$value['id']] = $value['tipo'];
        }

        // Breed
        if ($racaModel->load(Yii::$app->request->post())) {;
            // Animal File
            if ($fichaModel->load(Yii::$app->request->post()) && $racaModel->save()) {
                $fichaModel->id_raca = $racaModel->id; // Get Id From Saved Breed
                $fichaModel->created_at = date('Y-m-d H:i:s');
                $fichaModel->updated_at = date('Y-m-d H:i:s');
                // Animal Info
                if ($animalModel->load(Yii::$app->request->post()) && $fichaModel->save()) {
                    $animalModel->id_ficha = $fichaModel->id; // Get Id From Saved Animal File

                    if ($animalModel->save()) {
                        // Add Animal To Kennel
                        $canilAnimal->load(Yii::$app->request->post());
                        $canilAnimal->id_Animal = $animalModel->id; // Get Id From Saved Animal
                        $canilAnimal->id_Canil = Yii::$app->user->id;
                        $canilAnimal->created_at = date('Y-m-d H:i:s');
                        $canilAnimal->updated_at = date('Y-m-d H:i:s');

                        if ($canilAnimal->validate() && $canilAnimal->save()) {
                            $uploadModel->imageFiles = UploadedFile::getInstances($uploadModel, 'imageFiles');
                            if ($uploadModel->upload()) {
                            // file is uploaded successfully
                                return $this->redirect(['view', 'id' => $animalModel->id]);
                            }
                        }
                    }
                }
            }
        }

        return $this->render('create', [
            'tiposAnimais' => $tiposAnimais,
            'animalModel' => $animalModel,
            'fichaModel' => $fichaModel,
            'racaModel' => $racaModel,
            'uploadModel' => $uploadModel,
            'canilAnimalModel' => $canilAnimal
        ]);
    }

    /**
     * Updates an existing Animal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * @param integer $id
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
     * @param integer $id
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

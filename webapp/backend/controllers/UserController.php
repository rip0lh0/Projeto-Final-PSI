<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;

use backend\models\ScheduleForm;
use backend\models\ProfileForm;

use common\models\user;
use common\models\Local;


/**
 * UserController implements the CRUD actions for user model.
 */
class UserController extends Controller
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
            //         'delete' => ['POST'],
            //     ],
            // ],
        ];
    }

    /**
     * Lists all user models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => user::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single user model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new user model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new user();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing user model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActivate($id)
    {
        $user = $this->findModel($id);

        if (Yii::$app->user->identity->username == $user->username) throw new ErrorException("Erro: Nao e possivel remover esse utilizador");

        $user->status = User::STATUS_ACTIVE;

        $user->update();

        return $this->redirect('index');
    }

    /**
     * Deletes an existing user model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = $this->findModel($id);

        if (Yii::$app->user->identity->username == $user->username) throw new ErrorException("Erro: Nao e possivel remover esse utilizador");


        $user->status = User::STATUS_DELETED;

        $user->update();

        return $this->redirect(['index']);
    }


    public function actionProfile()
    {
        /* Variables */
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        $profile = $user->kennel;
        $schedules = $profile->schedules;
        $model_schedule = new ScheduleForm();
        $model_profile = new ProfileForm();
        $result = [];
        $locals = ArrayHelper::map(Local::find()->asArray()->where(['id_parent' => null])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');
        $sub_locals = ArrayHelper::map(Local::find()->asArray()->where(['id_parent' => ((!empty($model->local)) ? $model->local : key($locals))])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');

        /* Profile Form */
        $model_profile->id_user = $user->id;
        $model_profile->username = $user->username;
        $model_profile->email = $user->email;

        $model_profile->id_kennel = $profile->id;
        $model_profile->name = $profile->name;
        $model_profile->id_local = $profile->id_local;
        $model_profile->address = $profile->address;
        $model_profile->facebook = $profile->facebook;
        $model_profile->instagram = $profile->instagram;
        $model_profile->youtube = $profile->youtube;
        $model_profile->phone = $profile->phone;
        $model_profile->cell_phone = $profile->cell_phone;


        if ($model_profile->load(Yii::$app->request->post())) {
            $result = $model_profile->update();
            if (array_key_exists("success", $result)) {
                return $this->redirect(['user/profile']);
            }
        }

        /* Schedule Form */
        foreach ($schedules as $value) {
            $model_schedule->days_week[] = '' . $value->day;
            $model_schedule->hours['open'] = $value->open_time;
            $model_schedule->hours['close'] = $value->close_time;
            $model_schedule->hours_lunch['open'] = $value->lunch_open;
            $model_schedule->hours_lunch['close'] = $value->lunch_close;
            if ($model_schedule->hours_lunch['open']) $model_schedule->has_lunch = 1;
        }
        if ($model_schedule->load(Yii::$app->request->post())) {
            $model_schedule->id_kennel = $profile->id;
            $result = $model_schedule->saveSchedule();
            if (array_key_exists("success", $result)) {
                return $this->redirect(['user/profile']);
            }
        }

        $nAnimais = count($profile->kennelAnimals);
        $nAdocoes = 0;

        return $this->render('profile', [
            'profile' => $profile,
            'nAnimais' => $nAnimais,
            'nAdocoes' => $nAdocoes,
            'schedules' => $schedules,
            'model_schedule' => $model_schedule,
            'model_profile' => $model_profile,
            'locals' => $locals,
            'sub_locals' => $sub_locals,
            'result' => $result
        ]);
    }

    public function actionSubLocals($id_parent)
    {
        $sublocals[] = ArrayHelper::map(Local::find()->asArray()->where(['id_parent' => $id_parent])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');
        if (!empty($sublocals)) {
            foreach ($sublocals[0] as $key => $sublocal) {
                echo "<option value='" . $key . "'>" . $sublocal . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }

    /**
     * Finds the user model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return user the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = user::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

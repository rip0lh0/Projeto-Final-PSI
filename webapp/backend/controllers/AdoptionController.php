<?php

namespace backend\controllers;

use yii;
use yii\web\Controller;
use yii\base\DynamicModel;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

use common\models\Message;
use common\models\Adoption;

class AdoptionController extends Controller
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



    public function actionIndex()
    {
        $kennel = Yii::$app->user->identity->kennel;
        if ($kennel == null) throw new NotFoundHttpException;

        $adoptions = $kennel->getAdoptions();

        $dataProvider = new ActiveDataProvider([
            'query' => $adoptions,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAnswer($id_adoption)
    {
        $adoption = Adoption::find()->where(["id" => $id_adoption])->one();

        $msg = $adoption->messages;
        foreach ($msg as $key => $value) {
            $value->status = Message::STATUS_READ;

            $value->update();
        }

        $model = new DynamicModel(['KOMENTAR']);
        $model->addRule(['KOMENTAR'], 'string', ['max' => 254]);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $msg_answer = new Message();

            $msg_answer->id_adoption = $adoption->id;
            $msg_answer->message = $model->KOMENTAR;
            $msg_answer->id_user = Yii::$app->user->identity->id;

            if ($msg_answer->save()) return $this->redirect(['adoption/answer', 'id_adoption' => $adoption->id]);

            var_dump($msg_answer);
        }


        return $this->render('answer', [
            'model' => $model,
            'msg' => $msg
        ]);
    }

    public function actionRefuse()
    {

    }
}

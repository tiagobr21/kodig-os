<?php

namespace app\controllers;

use Yii;
use app\models\Os;
use app\models\OsChecklist;
use app\models\OsPhotos;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

class OsController extends Controller
{
  
    public function actionIndex()
    {
        $os = Os::find()->all();
        return $this->render('index', compact('os'));
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
            'checklist' => $model->checklist,
            'photos' => $model->photos,
        ]);
    }

    public function actionCreate()
    {
        $model = new Os();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_at = time();
            $model->updated_at = time();
            if ($model->save()) return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = time();
            if ($model->save()) return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model'));
    }

    public function actionDelete($id)
    {
        $model = Os::findOne($id);

        if ($model) {
            OsChecklist::deleteAll(['os_id' => $id]);
            OsPhotos::deleteAll(['os_id' => $id]);
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    private function findModel($id)
    {
        $model = Os::findOne($id);
        if (!$model) throw new NotFoundHttpException("OS not found");
        return $model;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['index','view','create','update','delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], 
                    ]
                ]
            ]
        ];
    }

}

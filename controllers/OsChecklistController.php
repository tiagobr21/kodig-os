<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use app\models\OsChecklist;
use app\models\Os;

class OsChecklistController extends Controller
{   
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OsChecklist::find()->with('os'),
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new OsChecklist();

        $osRows = Os::find()->select(['id', 'description'])->asArray()->all();

        $osList = [];
        foreach ($osRows as $r) {
            $osList[$r['id']] = $r['description'] ?? ('OS #' . $r['id']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->os) {
                $model->os->updateStatusFromChecklist();
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'osList' => $osList,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $osRows = Os::find()->select(['id','description'])->asArray()->all();

        $osList = [];
        foreach ($osRows as $r) {
            $osList[$r['id']] = $r['description'] ?? ('OS #' . $r['id']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->os) {
                $model->os->updateStatusFromChecklist();
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'osList' => $osList,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = OsChecklist::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Item não encontrado.');
    }

    public function actionDelete($id)
{
    $model = $this->findModel($id);

    $os = $model->os;

    $model->delete();

    if ($os) {
        $os->updateStatusFromChecklist();
    }

    return $this->redirect(['index']);
}

}

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

        // pega lista de OS como array
        $osRows = Os::find()->select(['id', 'description'])->asArray()->all();

        // detecta automaticamente qual coluna de label existe
        $labelField = null;
        if (!empty($osRows)) {
            $first = $osRows[0];
            foreach (['description'] as $candidate) {
                if (array_key_exists($candidate, $first) && !empty($first[$candidate])) {
                    $labelField = $candidate;
                    break;
                }
            }
            // se nenhuma tiver valor, pega a primeira coluna de texto disponível
            if ($labelField === null) {
                foreach ($first as $k => $v) {
                    if ($k !== 'id') { $labelField = $k; break; }
                }
            }
        }

        // monta o osList para a view (id => label)
        $osList = [];
        foreach ($osRows as $r) {
            $label = $labelField !== null && isset($r[$labelField]) ? $r[$labelField] : ('OS #' . $r['id']);
            $osList[$r['id']] = $label;
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
            // pick best label
            $label =  $r['description'] ?? ('OS #' . $r['id']);
            $osList[$r['id']] = $label;
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

    protected function findModel($id)
    {
        if (($model = OsChecklist::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Item não encontrado.');
    }
}

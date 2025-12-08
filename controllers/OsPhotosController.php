<?php

namespace app\controllers;

use Yii;
use app\models\OsPhotos;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

class OsPhotosController extends Controller
{
    public function actionUpload($os_id)
    {
        $model = new OsPhotos();
        $model->os_id = $os_id;

        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstanceByName('photo');

            if ($file) {
                $filename = 'os_' . $os_id . '_' . time() . '.' . $file->extension;
                $path = 'uploads/os/' . $filename;

                if ($file->saveAs($path)) {
                    $model->path = $path;
                    $model->created_at = time();
                    $model->save();
                }

                return $this->redirect(['/os/view', 'id' => $os_id]);
            }
        }

        return $this->render('upload', compact('model'));
    }

    public function actionDelete($id)
    {
        $model = OsPhotos::findOne($id);

        if ($model) {
            if (file_exists($model->path)) unlink($model->path);

            $os_id = $model->os_id;
            $model->delete();

            return $this->redirect(['/os/view', 'id' => $os_id]);
        }

        throw new NotFoundHttpException("Photo not found");
    }
}

<?php

namespace app\controllers;

use Yii;
use app\models\Media;
use yii\web\UploadedFile;
use app\services\DebugService;

class MediaController extends \yii\web\Controller {

    public function behaviors() {
        $this->layout = "@app/views/layouts/admin/main";
        return [];
    }

    public function actionIndex() {
        $data = Media::find()->all();
        //DebugService::dumpdie($data);
        return $this->render('index', ['medias' => $data]);
    }
    
    public function actionDownload($id) {
        $data = Media::findOne($id);
        header('Content-Type'.pathinfo($data->filepath, PATHINFO_EXTENSION));
        header('Content-Disposition: attachment; filename='.$data->filename);
        return readfile($data->filepath); 
    }
    
    public function actionDelete($id) {
        $data = Media::findOne($id);
        unlink($data->filepath);
        $data->delete();
        return $this->redirect('index');
    }

    public function actionUpload() {
        $model = new Media();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $names = UploadedFile::getInstances($model, 'filename');
                
                foreach ($names as $name) {
                    $path = 'uploads/' . md5($name->baseName) . '.' . $name->extension;
                    if ($name->saveAs($path)) {
                        $filename = $name->baseName . '.' . $name->extension;
                        $filepath = $path;
                        $extension = $name->extension;
                        Yii::$app->db->createCommand()->insert('media', ['filename' => $filename, 'filepath' => $filepath, 'extension' => $extension])->execute();
                    }
                }
                return $this->redirect('index');
            }
        }

        return $this->render('upload', [
                    'model' => $model,
        ]);
    }

}

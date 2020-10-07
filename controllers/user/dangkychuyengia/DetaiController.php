<?php

namespace app\controllers\user\dangkychuyengia;

use app\controllers\base\AbstractUserController;
use app\models\chuyengia\Chuyengia;
use app\models\chuyengia\ChuyengiaDetai;
use app\services\UtilityService;
use Yii;

class DetaiController extends AbstractUserController
{

    public function actionCreate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['detai'] = new ChuyengiaDetai();
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 2])->one();
        if ($model['detai']->load($request->post())) {
            $model['detai']->chuyengia_id = $model['chuyengia']->id_chuyengia;
            $model['detai']->save();
            return $this->redirect(['user/chuyengia/detai', 'id' => $model['chuyengia']->id_chuyengia]);
        } else {
            return $this->renderPartial('create', [
                'model' => $model,
            ]);
        }

    }

    public function actionUpdate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['detai'] = ChuyengiaDetai::find()->with('chuyengia')->where(['id_chuyengiadetai' => $id])->one();
        if ($model['detai']->load($request->post())) {
            $model['detai']->save();
            return $this->redirect(['user/chuyengia/detai', 'id' => $model['detai']->chuyengia->id_chuyengia]);
        } else {
            return $this->renderPartial('update', [
                'model' => $model,
            ]);
        }

    }

    public function actionDelete($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['detai'] = ChuyengiaDetai::find()->with('chuyengia')->where(['id_chuyengiadetai' => $id])->one();
        if ($model['detai'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }

        if($request->isPost){
            $model['detai']->delete();
            return $this->redirect(['user/chuyengia/detai', 'id' => $model['detai']->chuyengia->id_chuyengia]);
        }
        return $this->renderPartial('delete',[
            'model' => $model,
        ]);
    }
}

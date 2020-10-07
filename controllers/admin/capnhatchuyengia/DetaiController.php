<?php

namespace app\controllers\admin\capnhatchuyengia;

use app\controllers\base\AbstractAdminController;
use app\models\chuyengia\Chuyengia;
use app\models\chuyengia\ChuyengiaDetai;
use app\models\chuyengia\SearchChuyengiaDetai;
use app\services\UtilityService;
use Yii;

class DetaiController extends AbstractAdminController
{

    public function actionDetai($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['search'] = new SearchChuyengiaDetai();
        $model['detai'] = $model['search']->search(Yii::$app->request->queryParams, $id);

        return $this->render('detai', [
            'model' => $model,
        ]);
    }

    public function actionCreate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['detai'] = new ChuyengiaDetai();
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['detai']->load($request->post())) {
            $model['detai']->chuyengia_id = $model['chuyengia']->id_chuyengia;
            $model['detai']->save();
            return $this->redirect(['detai', 'id' => $model['chuyengia']->id_chuyengia]);
        } else {
            return $this->renderPartial('create', [
                'model' => $model,
            ]);
        }

    }

    public function actionUpdate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['detai'] = ChuyengiaDetai::find()->with('chuyengia')->where(['id_chuyengiadetai' => $id])->one();
        if ($model['detai']->load($request->post())) {
            $model['detai']->save();
            return $this->redirect(['detai', 'id' => $model['detai']->chuyengia->id_chuyengia]);
        } else {
            return $this->renderPartial('update', [
                'model' => $model,
            ]);
        }

    }

    public function actionDelete($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['detai'] = ChuyengiaDetai::find()->with('chuyengia')->where(['id_chuyengiadetai' => $id])->one();
        if ($model['detai'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }

        if($request->isPost){
            $model['detai']->delete();
            return $this->redirect(['detai', 'id' => $model['detai']->chuyengia->id_chuyengia]);
        }
        return $this->renderPartial('delete',[
            'model' => $model,
        ]);
    }
}

<?php

namespace app\controllers\admin\capnhatchuyengia;

use app\controllers\base\AbstractAdminController;
use app\models\chuyengia\Chuyengia;
use app\models\chuyengia\ChuyengiaCongtac;
use app\models\chuyengia\SearchChuyengiaCongtac;
use app\services\UtilityService;
use Yii;

class CongtacController extends AbstractAdminController
{

    public function actionCongtac($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['search'] = new SearchChuyengiaCongtac();
        $model['congtac'] = $model['search']->search(Yii::$app->request->queryParams, $id);

        return $this->render('congtac', [
            'model' => $model,
        ]);
    }

    public function actionCreate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['congtac'] = new ChuyengiaCongtac();
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['congtac']->load($request->post())) {
            $model['congtac']->chuyengia_id = $model['chuyengia']->id_chuyengia;
            $model['congtac']->save();
            return $this->redirect(['user/chuyengia/congtac', 'id' => $model['chuyengia']->id_chuyengia]);
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
        $model['congtac'] = ChuyengiaCongtac::find()->with('chuyengia')->where(['id_chuyengiacongtac' => $id])->one();
        if ($model['congtac']->load($request->post())) {
            $model['congtac']->save();
            return $this->redirect(['user/chuyengia/congtac', 'id' => $model['congtac']->chuyengia->id_chuyengia]);
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
        $model['congtac'] = ChuyengiaCongtac::find()->with('chuyengia')->where(['id_chuyengiacongtac' => $id])->one();
        if ($model['congtac'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }

        if($request->isPost){
            $model['congtac']->delete();
            return $this->redirect(['user/chuyengia/congtac', 'id' => $model['congtac']->chuyengia->id_chuyengia]);
        }
        return $this->renderPartial('delete',[
            'model' => $model,
        ]);
    }
}

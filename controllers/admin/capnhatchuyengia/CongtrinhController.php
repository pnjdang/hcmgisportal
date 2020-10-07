<?php

namespace app\controllers\admin\capnhatchuyengia;

use app\controllers\base\AbstractAdminController;
use app\models\chuyengia\Chuyengia;
use app\models\chuyengia\ChuyengiaCongtrinh;
use app\models\chuyengia\SearchChuyengiaCongtrinh;
use app\models\danhmuc\chuyengia\loaicongtrinhnghiencuu\LoaiCongtrinhnghiencuu;
use app\services\UtilityService;
use Yii;

class CongtrinhController extends AbstractAdminController
{

    public function actionCongtrinh($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['loaicongtrinh'] = LoaiCongtrinhnghiencuu::find()->where(['status' => 1])->orderBy('ten_loaicongtrinh')->all();
        $model['search'] = new SearchChuyengiaCongtrinh();
        $model['congtrinh'] = $model['search']->search(Yii::$app->request->queryParams, $id);

        return $this->render('congtrinh', [
            'model' => $model,
        ]);
    }

    public function actionCreate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['congtrinh'] = new ChuyengiaCongtrinh();
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        $model['loaicongtrinh'] = LoaiCongtrinhnghiencuu::find()->orderBy('id_loaicongtrinh')->all();
        if ($model['congtrinh']->load($request->post())) {
            $model['congtrinh']->chuyengia_id = $model['chuyengia']->id_chuyengia;
            $model['congtrinh']->save();
            return $this->redirect(['congtrinh', 'id' => $model['chuyengia']->id_chuyengia]);
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
        $model['congtrinh'] = ChuyengiaCongtrinh::find()->with('loaicongtrinh','chuyengia')->where(['id_chuyengiacongtrinh' => $id])->one();
        $model['loaicongtrinh'] = LoaiCongtrinhnghiencuu::find()->orderBy('id_loaicongtrinh')->all();
        if ($model['congtrinh']->load($request->post())) {
            $model['congtrinh']->save();
            return $this->redirect(['congtrinh', 'id' => $model['congtrinh']->chuyengia->id_chuyengia]);
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
        $model['congtrinh'] = ChuyengiaCongtrinh::find()->with('loaicongtrinh','chuyengia')->where(['id_chuyengiacongtrinh' => $id])->one();
        if ($model['congtrinh'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }

        if($request->isPost){
            $model['congtrinh']->delete();
            return $this->redirect(['congtrinh', 'id' => $model['congtrinh']->chuyengia->id_chuyengia]);
        }
        return $this->renderPartial('delete',[
            'model' => $model,
        ]);
    }
}

<?php

namespace app\controllers\admin\capnhatphongthinghiem;

use app\controllers\base\AbstractAdminController;
use app\models\danhmuc\phongthinghiem\sohuutritue\KetquaShtt;
use app\models\phongthinghiem\PhongThiNghiem;
use app\models\phongthinghiem\PhongthinghiemSohuutritue;
use app\models\phongthinghiem\SearchPhongthinghiemSohuutritue;
use app\services\UtilityService;
use Yii;

class SohuutritueController extends AbstractAdminController
{

    public function actionSohuutritue($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $id, 'phong_thi_nghiem.status' => 1])->one();
        if ($model['phongthinghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['ketquashtt'] = KetquaShtt::find()->orderBy('ten_ketquashtt')->all();
        $model['search'] = new SearchPhongthinghiemSohuutritue();
        $model['sohuutritue'] = $model['search']->search(Yii::$app->request->queryParams, $id);
        return $this->render('sohuutritue',[
            'model' => $model,
        ]);
    }

    public function actionCreate($id = null)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $id, 'status' => 1])->one();
        if ($model['phongthinghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['sohuutritue'] = new PhongthinghiemSohuutritue();
        $model['ketquashtt'] = KetquaShtt::find()->orderBy('ten_ketquashtt')->all();

        if ($model['sohuutritue']->load($request->post())) {
            $model['sohuutritue']->ptn_id = $model['phongthinghiem']->id_ptn;
            $model['sohuutritue']->save();
            return $this->redirect(['sohuutritue', 'id' => $model['phongthinghiem']->id_ptn]);
        } else {
            return $this->renderPartial('create', [
                'model' => $model,
            ]);
        }

    }

    public function actionUpdate($id = null)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['sohuutritue'] = PhongthinghiemSohuutritue::find()->where(['id_phongthinghiemsohuutritue' => $id])->one();
        if ($model['sohuutritue'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $model['sohuutritue']->ptn_id, 'status' => 1])->one();
        $model['ketquashtt'] = KetquaShtt::find()->orderBy('ten_ketquashtt')->all();

        if ($model['sohuutritue']->load($request->post())) {
            $model['sohuutritue']->save();
            return $this->redirect(['sohuutritue', 'id' => $model['phongthinghiem']->id_ptn]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

    }

    public function actionDelete($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $request = Yii::$app->request;
        $model['sohuutritue'] = PhongthinghiemSohuutritue::find()->where(['id_phongthinghiemsohuutritue' => $id])->one();
        if ($model['sohuutritue'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $model['sohuutritue']->ptn_id, 'status' => 1])->one();

        if($request->isPost){
            $model['sohuutritue']->delete();
            return $this->redirect(['sohuutritue', 'id' => $model['phongthinghiem']->id_ptn]);
        }
        return $this->renderPartial('delete',[
            'model' => $model,
        ]);
    }
}

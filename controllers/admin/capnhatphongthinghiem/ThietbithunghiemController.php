<?php

namespace app\controllers\admin\capnhatphongthinghiem;

use app\controllers\base\AbstractAdminController;
use app\models\phongthinghiem\PhongThiNghiem;
use app\models\phongthinghiem\PhongthinghiemThietbi;
use app\models\phongthinghiem\SearchPhongthinghiemThietbi;
use app\models\danhmuc\phongthinghiem\thietbi\ThietBi;
use app\services\UtilityService;
use Yii;

class ThietbithunghiemController extends AbstractAdminController
{

    public function actionThietbithunghiem($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $id, 'phong_thi_nghiem.status' => 1])->one();
        if ($model['phongthinghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['thietbi'] = ThietBi::find()->orderBy('ten_tb')->all();
        $model['search'] = new SearchPhongthinghiemThietbi();
        $model['thietbithunghiem'] = $model['search']->search(Yii::$app->request->queryParams, $id);
        return $this->render('thietbithunghiem',[
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
        $model['thietbithunghiem'] = new PhongthinghiemThietbi();

        if ($model['thietbithunghiem']->load($request->post())) {
            $model['thietbithunghiem']->ptn_id = $model['phongthinghiem']->id_ptn;
            $model['thietbithunghiem']->save();
            return $this->redirect(['thietbithunghiem', 'id' => $model['phongthinghiem']->id_ptn]);
        } else {
            return $this->renderAjax('create', [
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
        $model['thietbithunghiem'] = PhongthinghiemThietbi::find()->where(['id_phongthinghiemthietbi' => $id])->one();
        if ($model['thietbithunghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $model['thietbithunghiem']->ptn_id, 'status' => 1])->one();

        if ($model['thietbithunghiem']->load($request->post())) {
            $model['thietbithunghiem']->save();
            return $this->redirect(['thietbithunghiem', 'id' => $model['phongthinghiem']->id_ptn]);
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
        $model['thietbithunghiem'] = PhongthinghiemThietbi::find()->where(['id_phongthinghiemthietbi' => $id])->one();
        if ($model['thietbithunghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $model['thietbithunghiem']->ptn_id, 'status' => 1])->one();

        if($request->isPost){
            $model['thietbithunghiem']->delete();
            return $this->redirect(['thietbithunghiem', 'id' => $model['phongthinghiem']->id_ptn]);
        }
        return $this->renderPartial('delete',[
            'model' => $model,
        ]);
    }
}

<?php

namespace app\controllers;

use app\controllers\base\AbstractTlkhcnController;
use app\models\Chucvu;
use app\models\Chuyengia;
use app\models\ChuyengiaChuyennganh;
use app\models\ChuyengiaCongtac;
use app\models\ChuyengiaCongtrinh;
use app\models\ChuyengiaLinhvuc;
use app\models\DonviCongtac;
use app\models\FileUpload;
use app\models\HocHam;
use app\models\HocVi;
use app\models\KetquaShtt;
use app\models\LinhvucnghiencuuCap1;
use app\models\LinhvucnghiencuuCap3;
use app\models\LinhvucQuanly;
use app\models\LoaiCongtrinhnghiencuu;
use app\models\PhongThiNghiem;
use app\models\PhongthinghiemSohuutritue;
use app\models\PhongthinghiemThietbi;
use app\models\SearchChuyengia;
use app\models\SearchChuyengiaCongtac;
use app\models\SearchChuyengiaCongtrinh;
use app\models\SearchPhongthinghiemSohuutritue;
use app\models\SearchPhongthinghiemThietbi;
use app\models\ThietBi;
use app\models\VChuyengia;
use app\services\DebugService;
use app\services\UtilityService;
use Box\Spout\Common\Type;
use Box\Spout\Reader\ReaderFactory;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * DschuyengiaController implements the CRUD actions for VChuyengia model.
 */
class SohuutritueController extends AbstractTlkhcnController
{

    /**
     * Lists all VChuyengia models.
     * @return mixed
     */
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

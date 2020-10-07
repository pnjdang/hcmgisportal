<?php

namespace app\controllers\admin;

use app\controllers\base\AbstractTlkhcnController;
use app\models\chuyengia\Chuyengia;
use app\models\danhmuc\chuyengia\donvi\Donvi;
use app\models\danhmuc\chuyengia\hocham\HocHam;
use app\models\danhmuc\chuyengia\hocvi\HocVi;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap1\LinhvucnghiencuuCap1;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap2\LinhvucnghiencuuCap2;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap3\LinhvucnghiencuuCap3;
use app\models\chuyengia\SearchChuyengia;
use app\models\chuyengia\SearchChuyengiaChuyennganh;
use app\models\chuyengia\SearchChuyengiaLinhvuc;
use app\services\UtilityService;
use Yii;

class DanhsachchuyengiaController extends AbstractTlkhcnController
{

    public function actionIndex()
    {
        $searchModel = new SearchChuyengia();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model['hocham'] = HocHam::find()->where(['status' => 1])->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->where(['status' => 1])->orderBy('ten_hv')->all();
        $model['donvi'] = Donvi::find()->where(['status' => 1])->orderBy('ten_donvi')->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionLinhvuc()
    {
//        $dataProvider = new ActiveDataProvider([
//            'query' => LinhvucnghiencuuCap1::find()->with('chuyengiaLinhvucs', 'chuyengiaLinhvucs.chuyengia'),
//        ]);
        $model['soluong'] = null;
        $model['cap1'] = LinhvucnghiencuuCap1::find()->where(['status' => 1])->orderBy('id_cap1')->all();
        foreach($model['cap1'] as $i => $cap1){
            $model['soluong'][$i]['ten_cap1'] = $cap1->ten_cap1;
            $model['soluong'][$i]['id_cap1'] = $cap1->id_cap1;
            $model['soluong'][$i]['so_luong'] = Chuyengia::find()->leftJoin('chuyengia_linhvuc','chuyengia.id_chuyengia = chuyengia_linhvuc.chuyengia_id')->where('chuyengia.status = 1 and chuyengia_linhvuc.cap1_id = ' . $cap1->id_cap1)->count();
        }
//        DebugService::dumpdie($model['soluong']);

        return $this->render('linhvuc', [
            'model' => $model,
        ]);
    }

    public function actionLinhvucchitiet($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/linhvuc'));
        }
        $model['linhvuccap1'] = LinhvucnghiencuuCap1::findOne($id);
        $searchModel = new SearchChuyengiaLinhvuc();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);


        return $this->render('linhvucchitiet', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model
        ]);
    }

    public function actionChuyennganh()
    {
        $thongke = null;
        $chuyengia = ChuyenGia::find()->where(['status' => 1])->count();
        $pdk = ChuyenGia::find()->where(['status' => 2])->count();
//        DebugService::dumpdie($tkcghv);
        $hocvi = HocVi::find()->where(['status' => 1])->orderBy('id_hv')->all();
        foreach ($hocvi as $i => $hv) {
            $thongke['hocvi'][$i]['ten_hv'] = $hv->ten_hv;
            $thongke['hocvi'][$i]['so_luong'] = Chuyengia::find()->where(['status' => 1, 'hocvi_id' => $hv->id_hv])->count();
        }
        $hocham = HocHam::find()->where(['status' => 1])->orderBy('id_hh')->all();
        foreach ($hocham as $i => $hh) {
            $thongke['hocham'][$i]['ten_hh'] = $hh->ten_hh;
            $thongke['hocham'][$i]['so_luong'] = Chuyengia::find()->where(['status' => 1, 'hocham_id' => $hh->id_hh])->count();
        }
        $linhvuc_c1 = LinhvucnghiencuuCap1::find()->where(['status' => 1])->orderBy('id_cap1')->all();
        foreach ($linhvuc_c1 as $i => $cap1) {
            $sl_cap1 = 0;
            $sl_cap3 = 0;

            $linhvuc_c2 = LinhvucnghiencuuCap2::find()->where(['status' => 1, 'id_cap1' => $cap1->id_cap1])->orderBy('id_cap2')->all();
            foreach ($linhvuc_c2 as $k => $cap2) {
                $sl_cap2 = 0;

                $linhvuc_c3 = LinhvucnghiencuuCap3::find()->where(['status' => 1, 'id_cap2' => $cap2->id_cap2])->orderBy('id_cap3')->all();
                foreach ($linhvuc_c3 as $l => $cap3) {
                    $soluong = Chuyengia::find()->joinWith('chuyengiaChuyennganhs')->where(['status' => 1, 'chuyengia_chuyennganh.cap3_id' => $cap3->id_cap3])->count();
                    if ($soluong != 0) {
                        $thongke['linhvuc'][$cap1->id_cap1]['cap2s'][$cap2->id_cap2]['cap3s'][$cap3->id_cap3]['so_luong'] = $soluong;
                        $sl_cap2 += $soluong;
                        $thongke['linhvuc'][$cap1->id_cap1]['cap2s'][$cap2->id_cap2]['cap3s'][$cap3->id_cap3]['ten_cap3'] = $cap3->ten_cap3;
                        $thongke['linhvuc'][$cap1->id_cap1]['cap2s'][$cap2->id_cap2]['cap3s'][$cap3->id_cap3]['id_cap3'] = $cap3->id_cap3;
                        $thongke['linhvuc'][$cap1->id_cap1]['cap2s'][$cap2->id_cap2]['ten_cap2'] = $cap2->ten_cap2;
                        $thongke['linhvuc'][$cap1->id_cap1]['cap2s'][$cap2->id_cap2]['id_cap2'] = $cap2->id_cap2;
                        $thongke['linhvuc'][$cap1->id_cap1]['cap2s'][$cap2->id_cap2]['so_luong'] = $sl_cap2;


                    }
                }

                $sl_cap1 += $sl_cap2;
                if(isset($thongke['linhvuc'][$cap1->id_cap1]['cap2s'][$cap2->id_cap2])){
                    $sl_cap3 += sizeof($thongke['linhvuc'][$cap1->id_cap1]['cap2s'][$cap2->id_cap2]['cap3s']);
                }

            }
            if(isset($thongke['linhvuc'][$cap1->id_cap1])){
                $thongke['linhvuc'][$cap1->id_cap1]['sl_cap3'] = $sl_cap3;
            }
            $thongke['linhvuc'][$cap1->id_cap1]['ten_cap1'] = $cap1->ten_cap1;
            $thongke['linhvuc'][$cap1->id_cap1]['id_cap1'] = $cap1->id_cap1;
            $thongke['linhvuc'][$cap1->id_cap1]['so_luong'] = $sl_cap1;

        }
//        DebugService::dumpdie($thongke['hocvi']);

        return $this->render('chuyennganh', [
            'chuyengia' => $chuyengia,
            'thongke' => $thongke,
            'pdk' => $pdk,
        ]);

//        return $this->render('chuyennganh', [
//            'dataProvider' => $dataProvider,
//            'searchModel' => $searchModel,
//
//        ]);
    }

    public function actionChuyennganhchitiet($id)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/chuyennganh'));
        }
        $model['linhvuccap3'] = LinhvucnghiencuuCap3::findOne($id);
        $searchModel = new SearchChuyengiaChuyennganh();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);


        return $this->render('chuyennganhchitiet', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model
        ]);
    }
}

<?php

namespace app\controllers;

use app\models\ChuyenGia;
use app\models\HocHam;
use app\models\HocVi;
use app\models\LinhvucnghiencuuCap1;
use app\models\LinhvucnghiencuuCap2;
use app\models\LinhvucnghiencuuCap3;
use app\models\PhongThiNghiem;
use app\models\TkCgHocham;
use app\models\TkCgHocvi;
use app\models\TkPtnLinhvuc;
use app\models\TkPtnQuanhuyen;
use app\services\DebugService;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * HochamController implements the CRUD actions for HocHam model.
 */
class ThongkeController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionTkchuyengia()
    {
        $this->layout = "@app/views/layouts/main_chart";
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

        return $this->render('tkchuyengia', [
            'chuyengia' => $chuyengia,
            'thongke' => $thongke,
            'pdk' => $pdk,
        ]);
    }

    public function actionTkphongthinghiem()
    {
        $this->layout = "@app/views/layouts/main_chart";
        $chuyengia = ChuyenGia::find()->count();
        $ptn = PhongThiNghiem::find()->where(['status' => 1])->count();
        $pdk = PhongThiNghiem::find()->where(['status' => 2])->count();
        $tkptnqh = TkPtnQuanhuyen::find()->select('quan_huyen, sl_ptn')->asArray()->orderBy('quan_huyen')->all();
        $tkptnlv = TkPtnLinhvuc::find()->select('ten_lv, sl_ptn')->asArray()->orderBy('ten_lv')->all();


        return $this->render('tkphongthinghiem', [
            'chuyengia' => $chuyengia,
            'ptn' => $ptn,
            'pdk' => $pdk,
            'tkptnqh' => $tkptnqh,
            'tkptnlv' => $tkptnlv,
        ]);
    }


}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use app\controllers\base\AbstractTlkhcnController;
use app\models\ChungLoai;
use app\models\ChuyenGia;
use app\models\CongnhanChatluong;
use app\models\DoituongPhucvu;
use app\models\DonVi;
use app\models\DonviCongtac;
use app\models\HocHam;
use app\models\HocVi;
use app\models\KetquaShtt;
use app\models\LinhvucQuanly;
use app\models\LinhvucThunghiem;
use app\models\PdkChuyengia;
use app\models\PdkPhongthinghiem;
use app\models\PhanLoai;
use app\models\PhongThiNghiem;
use app\models\SohuuTritue;
use app\models\ThietBi;
use app\models\Thietbithunghiem;
use app\models\TieuChuan;
use app\models\TochucHoptac;
use app\services\DebugService;
use app\services\UtilityService;
use Yii;
use yii\base\Controller;
use yii\data\Pagination;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * Description of DangkyController
 *
 * @author User
 */
class DangkyController extends AbstractTlkhcnController
{

    public function actionChuyengia($id)
    {
        UtilityService::paramValidate($id);
        $t_pdkcg = PdkChuyengia::tableName();
        $t_lvql = LinhvucQuanly::tableName();
        $t_hh = HocHam::tableName();
        $t_hv = HocVi::tableName();
        $model['phieudangky'] = (new Query())
            ->select(
                $t_pdkcg . '.id_pdkcg,' .
                $t_pdkcg . '.ho_ten,' .
                $t_pdkcg . '.nam_sinh,' .
                $t_pdkcg . '.gioi_tinh,' .
                $t_pdkcg . '.dia_chi,' .
                $t_pdkcg . '.email,' .
                $t_pdkcg . '.dien_thoai,' .
                $t_pdkcg . '.chuyen_mon,' .
                $t_pdkcg . '.chuc_vu,' .
                $t_pdkcg . '.dinh_huong,' .
                $t_pdkcg . '.congtrinh_nghiencuu,' .
                $t_pdkcg . '.donvi_congtac,' .
                $t_pdkcg . '.status,' .
                $t_pdkcg . '.created_at,' .
                $t_pdkcg . '.created_by,' .
                $t_pdkcg . '.updated_at,' .
                $t_pdkcg . '.updated_by,' .
                $t_pdkcg . '.ket_qua,' .
                $t_pdkcg . '.ghi_chu,' .
                $t_pdkcg . '.hh_id,' .
                $t_pdkcg . '.hv_id,' .
                $t_lvql . '.ten_lvql,' .
                $t_hh . '.ten_hh,' .
                $t_hv . '.ten_hv'
            )->from($t_pdkcg)
            ->leftJoin($t_lvql, $t_lvql . '.id_lvql = ' . $t_pdkcg . '.lvql_id')
            ->leftJoin($t_hh, $t_hh . '.id_hh = ' . $t_pdkcg . '.hh_id')
            ->leftJoin($t_hv, $t_hv . '.id_hv = ' . $t_pdkcg . '.hv_id')
            ->where(['id_pdkcg' => $id])
            ->one();
        return $this->renderPartial('chuyengia', [
            'model' => $model
        ]);
    }

    public function actionPhongthinghiem($id)
    {
        $model['pdk'] = PdkPhongthinghiem::find()->where(['id_pdkptn' => $id])->asArray()->one();
        if ($model['pdk'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
        $model['linhvucthunghiem'] = LinhvucThunghiem::find()
            ->select('ten_lv')
            ->leftJoin('phongthinghiem_linhvuc', 'phongthinghiem_linhvuc.lv_id = linhvuc_thunghiem.id_lv')
            ->where('phongthinghiem_linhvuc.pdkptn_id = ' . $model['pdk']['id_pdkptn'])
            ->asArray()->all();
        $model['chungloai'] = ChungLoai::find()
            ->select('ten_cl,chung_loai.id_cl')
            ->leftJoin('phongthinghiem_chungloai', 'phongthinghiem_chungloai.cl_id = chung_loai.id_cl')
            ->where('phongthinghiem_chungloai.pdkptn_id = ' . $model['pdk']['id_pdkptn'])
            ->groupBy('chung_loai.id_cl')
            ->asArray()
            ->all();
        foreach ($model['chungloai'] as $i => $cl) {
            $model['chungloai'][$i]['phanloai'] = PhanLoai::find()
                ->select('ten_pl')
                ->leftJoin('phongthinghiem_chungloai', 'phongthinghiem_chungloai.pl_id = phan_loai.id_pl')
                ->where('phongthinghiem_chungloai.cl_id = ' . $cl['id_cl'] . ' and phongthinghiem_chungloai.pdkptn_id = ' . $model['pdk']['id_pdkptn'])
                ->asArray()
                ->all();
        }
        $model['phuongphapthuchuyeu'] = TieuChuan::find()
            ->select('ten_tc')
            ->leftJoin('phongthinghiem_tieuchuan', 'phongthinghiem_tieuchuan.tc_id = tieu_chuan.id_tc')
            ->where('phongthinghiem_tieuchuan.pdkptn_id = ' . $model['pdk']['id_pdkptn'])
            ->asArray()
            ->all();
        $model['congnhanchatluong'] = CongnhanChatluong::find()
            ->select('tieu_chuan')
            ->leftJoin('phongthinghiem_chatluong', 'phongthinghiem_chatluong.cncl_id = congnhan_chatluong.id_cncl')
            ->where('phongthinghiem_chatluong.pdkptn_id = .' . $model['pdk']['id_pdkptn'])
            ->asArray()
            ->all();
        $model['hoivien'] = TochucHoptac::find()
            ->select('ten_tc')
            ->leftJoin('phongthinghiem_hoptac', 'phongthinghiem_hoptac.tcht_id = tochuc_hoptac.id_tcht')
            ->where('phongthinghiem_hoptac.pdkptn_id = .' . $model['pdk']['id_pdkptn'])
            ->asArray()
            ->all();
        $model['doituongphucvu'] = DoituongPhucvu::find()->select('ten_dtpv')->where(['id_dtpv' => $model['pdk']['dtpv_id']])->asArray()->one();
//            DebugService::dumpdie($model);
        $model['danhsachthietbi'] = (new Query())->select('
        thietbithunghiem.so_hieu,
        thietbithunghiem.nam_sx,
        thietbithunghiem.hang_sx,
        thietbithunghiem.nuoc_sx,
        thietbithunghiem.dactinh_kythuat,
        thietbithunghiem.so_luong,
        thietbithunghiem.tinh_trang,
        thietbithunghiem.id_thietbithunghiem,
        thietbithunghiem.ghi_chu,
        thiet_bi.ten_tb')
            ->from(Thietbithunghiem::tableName())
            ->leftJoin(ThietBi::tableName(), 'thiet_bi.id_tb = thietbithunghiem.thietbi_id')
            ->where(['id_pdk' => $id])
            ->orderBy('id_thietbithunghiem desc')->all();
        $sohuutritue = SohuuTritue::find()->where(['id_pdk' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
        $model['sohuutritue'] = ArrayHelper::index($sohuutritue, 'id_ketquashtt', 'nam');
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();

        return $this->render('phongthinghiem', [
            'model' => $model
        ]);
    }

    public function actionDanhsachchuyengia()
    {
        $query = PdkChuyengia::find()->where(['status' => 0]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 30]);
        $model['pdk'] = $query->offset($pages->offset)
            ->orderBy('created_at desc')
            ->limit($pages->limit)
            ->all();
        return $this->render('danhsachchuyengia', [
            'model' => $model,
            'pages' => $pages,
            'count' => $count,
        ]);
    }

    public function actionDanhsachphongthinghiem()
    {
        $query = PdkPhongthinghiem::find()->where(['status' => 1]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 30]);
        $model['pdk'] = $query->offset($pages->offset)
            ->orderBy('created_at desc')
            ->limit($pages->limit)
            ->all();
        return $this->render('danhsachphongthinghiem', [
            'model' => $model,
            'pages' => $pages,
            'count' => $count,
        ]);
    }

    public function actionKiemduyetchuyengia()
    {
        $request = Yii::$app->request;

        $model['chuyengia'] = new ChuyenGia();
        $model['phieudangky'] = PdkChuyengia::findOne(['id_pdkcg' => $request->get()['id']]);
        $model['hocham'] = HocHam::find()->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->orderBy('ten_hv')->all();
        $model['linhvucquanly'] = LinhvucQuanly::find()->orderBy('id_lvql')->all();
        $model['donvicongtac'] = DonviCongtac::find()->orderBy('id_dvct')->all();
        $model['donvi'] = DonVi::find()->all();

        if ($request->isPost) {
            $model['chuyengia']->load($request->post());
            $model['chuyengia']->save();
            $model['phieudangky']->load($request->post());
            $model['phieudangky']->save();
            return $this->redirect(Yii::$app->urlManager->createUrl('dangky/danhsachchuyengia'));
        }
        return $this->render('kiemduyetchuyengia', [
            'model' => $model,
        ]);
    }

    public function actionKiemduyetphongthinghiem(){
        $request = Yii::$app->request;

        $model['phieudangky'] = PdkPhongthinghiem::findOne(['id_pdkptn' => $request->get()['id']]);
        $model['phongthinghiem'] = new PhongThiNghiem();
        $model['phongthinghiem']->linhvucChecked = ArrayHelper::getColumn($model['phieudangky']->getPhongthinghiemLinhvucs()->asArray()->all(), 'lv_id');
        $model['phongthinghiem']->chatluongChecked = ArrayHelper::getColumn($model['phieudangky']->getPhongthinghiemChatluongs()->asArray()->all(), 'cncl_id');
        $model['phongthinghiem']->hoivienChecked = ArrayHelper::getColumn($model['phieudangky']->getPhongthinghiemHoptacs()->asArray()->all(), 'tcht_id');
        $model['phongthinghiem']->tieuchuanChecked = ArrayHelper::getColumn($model['phieudangky']->getPhongthinghiemTieuchuans()->asArray()->all(), 'tc_id');
        $model['phongthinghiem']->phanloaiChecked = ArrayHelper::map($model['phieudangky']->getPhongthinghiemChungloais()->asArray()->all(), 'id_ptn_cl', 'pl_id', 'cl_id');
        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->all();
        $model['linhvucthunghiem'] = LinhvucThunghiem::find()
            ->select('ten_lv')
            ->leftJoin('phongthinghiem_linhvuc', 'phongthinghiem_linhvuc.lv_id = linhvuc_thunghiem.id_lv')
            ->where('phongthinghiem_linhvuc.pdkptn_id = ' . $model['phieudangky']->id_pdkptn)
            ->asArray()->all();
        $model['chungloai'] = ChungLoai::find()
            ->select('ten_cl,chung_loai.id_cl')
            ->leftJoin('phongthinghiem_chungloai', 'phongthinghiem_chungloai.cl_id = chung_loai.id_cl')
            ->where('phongthinghiem_chungloai.pdkptn_id = ' . $model['phieudangky']->id_pdkptn)
            ->groupBy('chung_loai.id_cl')
            ->asArray()
            ->all();
        foreach ($model['chungloai'] as $i => $cl) {
            $model['chungloai'][$i]['phanloai'] = PhanLoai::find()
                ->select('ten_pl')
                ->leftJoin('phongthinghiem_chungloai', 'phongthinghiem_chungloai.pl_id = phan_loai.id_pl')
                ->where('phongthinghiem_chungloai.cl_id = ' . $cl['id_cl'] . ' and phongthinghiem_chungloai.pdkptn_id = ' . $model['phieudangky']->id_pdkptn)
                ->asArray()
                ->all();
        }
        $model['phuongphapthuchuyeu'] = TieuChuan::find()
            ->select('ten_tc')
            ->leftJoin('phongthinghiem_tieuchuan', 'phongthinghiem_tieuchuan.tc_id = tieu_chuan.id_tc')
            ->where('phongthinghiem_tieuchuan.pdkptn_id = ' . $model['phieudangky']->id_pdkptn)
            ->asArray()
            ->all();
        $model['congnhanchatluong'] = CongnhanChatluong::find()
            ->select('tieu_chuan')
            ->leftJoin('phongthinghiem_chatluong', 'phongthinghiem_chatluong.cncl_id = congnhan_chatluong.id_cncl')
            ->where('phongthinghiem_chatluong.pdkptn_id = .' . $model['phieudangky']->id_pdkptn)
            ->asArray()
            ->all();
        $model['hoivien'] = TochucHoptac::find()
            ->select('ten_tc')
            ->leftJoin('phongthinghiem_hoptac', 'phongthinghiem_hoptac.tcht_id = tochuc_hoptac.id_tcht')
            ->where('phongthinghiem_hoptac.pdkptn_id = .' . $model['phieudangky']->id_pdkptn)
            ->asArray()
            ->all();
        $model['doituongphucvu'] = DoituongPhucvu::find()->select('ten_dtpv')->where(['id_dtpv' => $model['phieudangky']->dtpv_id])->asArray()->one();
//            DebugService::dumpdie($model);
        $model['danhsachthietbi'] = (new Query())->select('
        thietbithunghiem.so_hieu,
        thietbithunghiem.nam_sx,
        thietbithunghiem.hang_sx,
        thietbithunghiem.nuoc_sx,
        thietbithunghiem.dactinh_kythuat,
        thietbithunghiem.so_luong,
        thietbithunghiem.tinh_trang,
        thietbithunghiem.id_thietbithunghiem,
        thietbithunghiem.ghi_chu,
        thiet_bi.ten_tb')
            ->from(Thietbithunghiem::tableName())
            ->leftJoin(ThietBi::tableName(), 'thiet_bi.id_tb = thietbithunghiem.thietbi_id')
            ->where(['id_pdk' => $model['phieudangky']->id_pdkptn])
            ->orderBy('id_thietbithunghiem desc')->all();
        $sohuutritue = SohuuTritue::find()->where(['id_pdk' => $model['phieudangky']->id_pdkptn])->orderBy('nam,id_ketquashtt')->asArray()->all();
        $model['sohuutritue'] = ArrayHelper::index($sohuutritue, 'id_ketquashtt', 'nam');
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();

        if($request->isPost){
            $post = $request->post();
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['phongthinghiem']->load($post);
            $model['phongthinghiem']->status = 1;
            $model['phongthinghiem']->created_by = Yii::$app->user->id;
            $model['phongthinghiem']->created_at = date('Y-m-d H:i:s');
            $model['phongthinghiem']->save();
            $model['phieudangky']->load($post);
            $model['phieudangky']->save();
            $sohuutritue = SohuuTritue::find()->where(['id_pdk' => $model['phieudangky']->id_pdkptn])->all();
            foreach($sohuutritue as $i => $shtt){
                $shtt->id_ptn = $model['phongthinghiem']->id_ptn;
                $shtt->save();
            }
            $thietbithunghiem= Thietbithunghiem::find()->where(['id_pdk' => $model['phieudangky']->id_pdkptn])->all();
            foreach($thietbithunghiem as $i => $tbtn){
                $tbtn->ptn_id = $model['phongthinghiem']->id_ptn;
                $tbtn->save();
            }
            return $this->redirect(Yii::$app->urlManager->createUrl('dangky/danhsachphongthinghiem'));

        }
        return $this->render('kiemduyetphongthinghiem', [
            'model' => $model,
        ]);
    }

}

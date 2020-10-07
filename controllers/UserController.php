<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use app\controllers\base\AbstractTlkhcnController;
use app\models\ChungLoai;
use app\models\ChuyengiaSearch;
use app\models\DoiMatKhau;
use app\models\FileThietbi;
use app\models\KetquaShtt;
use app\models\PdkChuyengia;
use app\models\PdkPhongthinghiem;
use app\models\PhanLoai;
use app\models\ReportThongtin;
use app\models\Search;
use app\models\SohuuTritue;
use app\models\TaiKhoan;
use app\models\Thietbithunghiem;
use app\models\VChuyengia;
use app\models\ChuyenGia;
use app\models\DschuyengiaSearch;
use app\models\CongnhanChatluong;
use app\models\DoituongPhucvu;
use app\models\DonviCongtac;
use app\models\HocHam;
use app\models\HocVi;
use app\models\LinhvucQuanly;
use app\models\LinhvucThunghiem;
use app\models\PhongThiNghiem;
use app\models\PhongthinghiemSearch;
use app\models\Thietbi;
use app\models\TieuChuan;
use app\models\LienHe;
use app\models\TochucHoptac;
use app\services\DebugService;
use app\services\UtilityService;
use Yii;
use yii\base\Controller;
use yii\base\Model;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Description of DangkyController
 *
 * @author User
 */
class UserController extends AbstractTlkhcnController {

    //ChuyenGia
    /*
     * index chuyen gia
     * */
    public function actionUserchuyengiaindex() {
        $request = Yii::$app->request;
        $this->layout = "@app/views/layouts/user/main_user";
        $model['search'] = new ChuyengiaSearch();
        if ($request->isGet) {
            $params['ChuyengiaSearch'] = $request->queryParams;
            $dataProvider = $model['search']->search($params);
            return $this->render('chuyengia/index', [
                        'model' => $model,
                        'dataProvider' => $dataProvider,
            ]);
        }
        if ($request->isPost) {
            $model['search']->load($request->post());
            return $this->redirect(Yii::$app->urlManager->createUrl('user/userchuyengiaindex') .
                            '?ho_ten=' . $model['search']->ho_ten .
                            '&chuyen_mon=' . $model['search']->chuyen_mon .
                            '&donvi_congtac=' . $model['search']->donvi_congtac
            );
        }
    }

    /*
     * xem chi tiet chuyen gia
     * */

    public function actionUserviewchuyengia($id) {
        $request = Yii::$app->request;
        $model = (new Query())
                        ->select(
                                'chuyen_gia.id_cg,' .
                                'chuyen_gia.ho_ten,' .
                                'chuyen_gia.donvi_congtac,' .
                                'chuyen_gia.nam_sinh,' .
                                'chuyen_gia.ngay_sinh,' .
                                'chuyen_gia.dia_chi,' .
                                'chuyen_gia.dien_thoai,' .
                                'chuyen_gia.email,' .
                                'chuyen_gia.chuyen_mon,' .
                                'chuyen_gia.gioi_tinh,' .
                                'chuyen_gia.chuc_vu,' .
                                'chuyen_gia.dinh_huong,' .
                                'chuyen_gia.congtrinh_nghiencuu,' .
                                'hoc_ham.ten_hh,' .
                                'hoc_vi.ten_hv'
                        )->from('chuyen_gia')
                        ->leftJoin('hoc_ham', 'hoc_ham.id_hh = chuyen_gia.id_hh')
                        ->leftJoin('hoc_vi', 'hoc_vi.id_hv = chuyen_gia.id_hv')
                        ->where('id_cg = ' . $id)->one();
        return $this->renderPartial('chuyengia/view', [
                    'model' => $model,
                        ]
        );
    }

    /*
     * phan hoi thong tin chuyen gia chua chinh xac
     * */

    public function actionUserreportchuyengia($id) {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia'));
        }
        $request = Yii::$app->request;
        $model['report'] = new ReportThongtin();
        $model['id_cg'] = $id;
        $model['chuyengia'] = ChuyenGia::findOne($id);
        if ($request->isAjax) {
            return $this->renderPartial('chuyengia/report', [
                        'model' => $model,
            ]);
        } elseif ($model['report']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['report']->created_at = date('Y-m-d H:i:s');
            $model['report']->created_by = Yii::$app->user->id;
            $model['report']->chuyengia_id = $id;
            $model['report']->save();
            return $this->redirect(Yii::$app->urlManager->createUrl('user/userchuyengiaindex'));
        } else {
            return $this->render('reportchuyengia', [
                        'model' => $model['report'],
            ]);
        }
    }

    /*
     * tao moi phieu dang ky thong tin chuyen gia
     * */

    public function actionCreatepdkchuyengia() {
        $request = Yii::$app->request;
        $model = new PdkChuyengia();
        $hocham = HocHam::find()->orderBy('ten_hh')->all();
        $hocvi = HocVi::find()->orderBy('ten_hv')->all();
        $linhvucquanly = LinhvucQuanly::find()->orderBy('id_lvql')->all();
        $donvicongtac = DonviCongtac::find()->orderBy('id_dvct')->all();
        $code = 1;
        if ($model->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->id;
            $model->save();
            return $this->redirect(Yii::$app->urlManager->createUrl('danh-sach-dang-ky'));
        }
        return $this->renderPartial('chuyengia/create', [
                    'model' => $model,
                    'hocham' => $hocham,
                    'hocvi' => $hocvi,
                    'linhvucquanly' => $linhvucquanly,
                    'donvicongtac' => $donvicongtac,
                    'code' => $code
        ]);
    }

    /*
     * cap nhat phieu dang ky thong tin chuyen gia
     * */

    public function actionUpdatepdkchuyengia($id) {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/danhsachdangky'));
        }
        $request = Yii::$app->request;
        $model['pdk'] = PdkChuyengia::findOne($id);
        $model['hocham'] = HocHam::find()->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->orderBy('ten_hv')->all();
        $model['linhvucquanly'] = LinhvucQuanly::find()->orderBy('id_lvql')->all();
        $model['donvicongtac'] = DonviCongtac::find()->orderBy('id_dvct')->all();
        if ($request->isAjax) {
            return $this->renderPartial('chuyengia/update', [
                        'model' => $model,
                            ]
            );
        } elseif ($model['pdk']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['pdk']->updated_at = date('Y-m-d H:i:s');
            $model['pdk']->updated_by = Yii::$app->user->id;
            $model['pdk']->save();
            UtilityService::alert('capnhatchuyengia');
            return $this->redirect(Yii::$app->urlManager->createUrl('danh-sach-dang-ky'));
        } else {
            return $this->render('updatechuyengia', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUserviewpdkchuyengia($id) {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/danhsachdangky'));
        }
        $request = Yii::$app->request;

        $model = (new Query())->select(
                        'pdk_chuyengia.id_pdkcg,' .
                        'pdk_chuyengia.ho_ten,' .
                        'pdk_chuyengia.chuyen_mon,' .
                        'pdk_chuyengia.nam_sinh,' .
                        'pdk_chuyengia.ngay_sinh,' .
                        'pdk_chuyengia.gioi_tinh,' .
                        'pdk_chuyengia.dia_chi,' .
                        'pdk_chuyengia.dien_thoai,' .
                        'pdk_chuyengia.email,' .
                        'pdk_chuyengia.donvi_congtac,' .
                        'pdk_chuyengia.dinh_huong,' .
                        'pdk_chuyengia.congtrinh_nghiencuu,' .
                        'pdk_chuyengia.chuc_vu,' .
                        'pdk_chuyengia.hh_id,' .
                        'pdk_chuyengia.hv_id,' .
                        'hoc_ham.ten_hh,' .
                        'hoc_vi.ten_hv'
                )->from('pdk_chuyengia')
                ->leftJoin('hoc_ham', 'hoc_ham.id_hh = pdk_chuyengia.hh_id')
                ->leftJoin('hoc_vi', 'hoc_vi.id_hv = pdk_chuyengia.hv_id')
                ->where('id_pdkcg = ' . $id)
                ->one();

        return $this->renderPartial('chuyengia/viewpdk', [
                    'model' => $model,
                        ]
        );
    }

// so huu tri tue - phieu dang ky

    public function actionUsersohuutritue($id) {
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        if (PdkPhongthinghiem::findOne($id) == null || PdkPhongthinghiem::findOne($id)->status == -1) {
            return $this->redirect(Yii::$app->urlManager->createUrl('danh-sach-dang-ky'));
        }

        $model['id_pdk'] = $id;
        return $this->render('phongthinghiem/sohuutritue', [
                    'model' => $model,
        ]);
    }

    public function actionUserlistsohuutritue($id) {
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['id_pdk'] = $id;
        $sohuutritue = SohuuTritue::find()->where(['id_pdk' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();
        $model['sohuutritue'] = ArrayHelper::index($sohuutritue, 'id_ketquashtt', 'nam');
        return $this->renderPartial('phongthinghiem/inc_sohuutritue', [
                    'model' => $model,
        ]);
    }

    public function actionUsercreatesohuutritue($id) {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();
        foreach ($model['ketquashtt'] as $i => $ketquashtt) {
            $model['sohuutritue'][$ketquashtt->id_ketquashtt] = new SohuuTritue();
        }
        if ($request->isPost) {
            $post = $request->post();
            Model::loadMultiple($model['sohuutritue'], $post);
            foreach ($model['sohuutritue'] as $i => $shtt) {
                $shtt->nam = $post['nam'];
                $shtt->id_pdk = $id;
                $shtt->id_ketquashtt = $i;
                $shtt->save();
            }
            return true;
        }
        $model['id_pdk'] = $id;
        return $this->renderAjax('phongthinghiem/inc_createsohuutritue', [
                    'model' => $model,
        ]);
    }

    public function actionUserupdatesohuutritue($id, $nam) {
        $request = Yii::$app->request;

        if (!UtilityService::paramValidate($nam) || !UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
        $model['id_pdk'] = $id;
        $model['nam'] = $nam;
        $model['sohuutritue'] = SohuuTritue::find()->where(['nam' => $nam])->andWhere(['id_pdk' => $id])->orderBy('id_ketquashtt')->indexBy('id_ketquashtt')->all();
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->indexBy('id_ketquashtt')->all();

        if ($request->isPost) {
            $post = $request->post();
            Model::loadMultiple($model['sohuutritue'], $post);
            foreach ($model['sohuutritue'] as $i => $shtt) {
                $shtt->save();
            }
            return true;
        }

        return $this->renderAjax('phongthinghiem/inc_updatesohuutritue', [
                    'model' => $model,
        ]);
    }

    public function actionUserdeletesohuutritue($id, $nam) {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($nam) || !UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
        $model['id_pdk'] = $id;
        $model['nam'] = $nam;
        if ($request->isPost) {
            SohuuTritue::deleteAll(['nam' => $nam, 'id_pdk' => $id]);
            UtilityService::alert('thietbi_delete_success');
            return true;
        }

        return $this->renderAjax('phongthinghiem/inc_deletesohuutritue', [
                    'model' => $model,
        ]);
    }

// thiet bi - phieu dang ky
    public function actionUserthietbi($id) {
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['id_pdk'] = $id;
        return $this->render('phongthinghiem/thietbi', [
                    'model' => $model,
        ]);
    }

    public function actionUserlistthietbi($id) {
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['id_pdk'] = $id;
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
                        ->orderBy('created_at')->all();
        return $this->renderPartial('phongthinghiem/inc_thietbi', [
                    'model' => $model,
        ]);
    }

    public function actionUsercreatethietbi($id) {

        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['thietbi'] = new Thietbithunghiem();
        if ($model['thietbi']->load(Yii::$app->request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['thietbi']->id_pdk = $id;
            $model['thietbi']->dactinh_kythuat = nl2br($model['thietbi']->dactinh_kythuat);
            $model['thietbi']->created_by = Yii::$app->user->id;
            $model['thietbi']->created_at = date('Y-m-d H:i:s');
            $model['thietbi']->save();
            UtilityService::alert('thietbi_create_success');
            return true;
        }
        if (!$request->isAjax && $request->isGet) {
            return $this->render('phongthinghiem/inc_createthietbi', [
                        'model' => $model,
            ]);
        }
        $model['id_pdk'] = $id;

        return $this->renderAjax('phongthinghiem/inc_createthietbi', [
                    'model' => $model,
        ]);
    }

    public function actionUserupdatethietbi($id) {

        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['thietbi'] = Thietbithunghiem::findOne($id);
        if ($model['thietbi']->load(Yii::$app->request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['thietbi']->dactinh_kythuat = nl2br($model['thietbi']->dactinh_kythuat);
            $model['thietbi']->updated_by = Yii::$app->user->id;
            $model['thietbi']->updated_at = date('Y-m-d H:i:s');
            $model['thietbi']->save();
            UtilityService::alert('thietbi_update_success');
            return true;
        }
        $model['thietbi']->dactinh_kythuat = strip_tags($model['thietbi']->dactinh_kythuat);
        if (!$request->isAjax && $request->isGet) {
            return $this->render('phongthinghiem/inc_updatethietbi', [
                        'model' => $model,
            ]);
        }
        $model['id_pdk'] = $id;

        return $this->renderAjax('phongthinghiem/inc_updatethietbi', [
                    'model' => $model,
        ]);
    }

    public function actionUserdeletethietbi($id) {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['thietbi'] = Thietbithunghiem::findOne($id);
        $model['id_pdk'] = $model['thietbi']->id_pdk;
        if ($request->isPost && $model['thietbi']->delete()) {
            UtilityService::alert('thietbi_delete_success');
            return true;
        }
        return $this->renderAjax('phongthinghiem/inc_deletethietbi', [
                    'model' => $model,
        ]);
    }

// preview phieu dang ky

    public function actionPreviewphongthinghiem($id) {
        $this->layout = "@app/views/layouts/user/main_user";

        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['pdk'] = PdkPhongthinghiem::find()->where(['id_pdkptn' => $id])->asArray()->one();
        if ($model['pdk'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
        $model['linhvucthunghiem'] = LinhvucThunghiem::find()
                        ->select('ten_lv')
                        ->leftJoin('phongthinghiem_linhvuc', 'phongthinghiem_linhvuc.id_lv = linhvuc_thunghiem.id_lv')
                        ->where('phongthinghiem_linhvuc.id_pdkptn = ' . $model['pdk']['id_pdkptn'])
                        ->asArray()->all();
        $model['chungloai'] = ChungLoai::find()
                ->select('ten_cl,chung_loai.id_cl')
                ->leftJoin('phongthinghiem_chungloai', 'phongthinghiem_chungloai.id_cl = chung_loai.id_cl')
                ->where('phongthinghiem_chungloai.id_pdkptn = ' . $model['pdk']['id_pdkptn'])
                ->groupBy('chung_loai.id_cl')
                ->asArray()
                ->all();
        foreach ($model['chungloai'] as $i => $cl) {
            $model['chungloai'][$i]['phanloai'] = PhanLoai::find()
                    ->select('ten_pl')
                    ->leftJoin('phongthinghiem_chungloai', 'phongthinghiem_chungloai.id_pl = phan_loai.id_pl')
                    ->where('phongthinghiem_chungloai.id_cl = ' . $cl['id_cl'] . ' and phongthinghiem_chungloai.id_pdkptn = ' . $model['pdk']['id_pdkptn'])
                    ->asArray()
                    ->all();
        }
        $model['phuongphapthuchuyeu'] = TieuChuan::find()
                ->select('ten_tc')
                ->leftJoin('phongthinghiem_tieuchuan', 'phongthinghiem_tieuchuan.id_tc = tieu_chuan.id_tc')
                ->where('phongthinghiem_tieuchuan.id_pdkptn = ' . $model['pdk']['id_pdkptn'])
                ->asArray()
                ->all();
        $model['congnhanchatluong'] = CongnhanChatluong::find()
                ->select('tieu_chuan')
                ->leftJoin('phongthinghiem_chatluong', 'phongthinghiem_chatluong.id_cncl = congnhan_chatluong.id_cncl')
                ->where('phongthinghiem_chatluong.id_pdkptn = .' . $model['pdk']['id_pdkptn'])
                ->asArray()
                ->all();
        $model['hoivien'] = TochucHoptac::find()
                ->select('ten_tc')
                ->leftJoin('phongthinghiem_hoptac', 'phongthinghiem_hoptac.id_tcht = tochuc_hoptac.id_tcht')
                ->where('phongthinghiem_hoptac.id_pdkptn = .' . $model['pdk']['id_pdkptn'])
                ->asArray()
                ->all();
        $model['doituongphucvu'] = DoituongPhucvu::find()->select('ten_dtpv')->where(['id_dtpv' => $model['pdk']['id_dtpv']])->asArray()->one();
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

        $model['status'] = $model['pdk']['status'];
        return $this->render('phongthinghiem/previewphongthinghiem', [
                    'model' => $model,
        ]);
    }

    public function actionUserviewpdkphongthinghiem($id) {
        $this->layout = "@app/views/layouts/user/main_user";

        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['pdk'] = PdkPhongthinghiem::find()->where(['id_pdkptn' => $id])->asArray()->one();
        if ($model['pdk'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
        $model['linhvucthunghiem'] = LinhvucThunghiem::find()
                        ->select('ten_lv')
                        ->leftJoin('phongthinghiem_linhvuc', 'phongthinghiem_linhvuc.id_lv = linhvuc_thunghiem.id_lv')
                        ->where('phongthinghiem_linhvuc.id_pdkptn = ' . $model['pdk']['id_pdkptn'])
                        ->asArray()->all();
        $model['chungloai'] = ChungLoai::find()
                ->select('ten_cl,chung_loai.id_cl')
                ->leftJoin('phongthinghiem_chungloai', 'phongthinghiem_chungloai.id_cl = chung_loai.id_cl')
                ->where('phongthinghiem_chungloai.id_pdkptn = ' . $model['pdk']['id_pdkptn'])
                ->groupBy('chung_loai.id_cl')
                ->asArray()
                ->all();
        foreach ($model['chungloai'] as $i => $cl) {
            $model['chungloai'][$i]['phanloai'] = PhanLoai::find()
                    ->select('ten_pl')
                    ->leftJoin('phongthinghiem_chungloai', 'phongthinghiem_chungloai.id_pl = phan_loai.id_pl')
                    ->where('phongthinghiem_chungloai.id_cl = ' . $cl['id_cl'] . ' and phongthinghiem_chungloai.id_pdkptn = ' . $model['pdk']['id_pdkptn'])
                    ->asArray()
                    ->all();
        }
        $model['phuongphapthuchuyeu'] = TieuChuan::find()
                ->select('ten_tc')
                ->leftJoin('phongthinghiem_tieuchuan', 'phongthinghiem_tieuchuan.id_tc = tieu_chuan.id_tc')
                ->where('phongthinghiem_tieuchuan.id_pdkptn = ' . $model['pdk']['id_pdkptn'])
                ->asArray()
                ->all();
        $model['congnhanchatluong'] = CongnhanChatluong::find()
                ->select('tieu_chuan')
                ->leftJoin('phongthinghiem_chatluong', 'phongthinghiem_chatluong.id_cncl = congnhan_chatluong.id_cncl')
                ->where('phongthinghiem_chatluong.id_pdkptn = .' . $model['pdk']['id_pdkptn'])
                ->asArray()
                ->all();
        $model['hoivien'] = TochucHoptac::find()
                ->select('ten_tc')
                ->leftJoin('phongthinghiem_hoptac', 'phongthinghiem_hoptac.id_tcht = tochuc_hoptac.id_tcht')
                ->where('phongthinghiem_hoptac.id_pdkptn = .' . $model['pdk']['id_pdkptn'])
                ->asArray()
                ->all();
        $model['doituongphucvu'] = DoituongPhucvu::find()->select('ten_dtpv')->where(['id_dtpv' => $model['pdk']['id_dtpv']])->asArray()->one();
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


        return $this->render('phongthinghiem/viewpdkphongthinghiem', [
                    'model' => $model,
        ]);
    }

    public function actionUserupdatepdkphongthinghiem($id) {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
        $this->layout = "@app/views/layouts/user/main_user";
        $request = Yii::$app->request;
        $model['pdk'] = PdkPhongthinghiem::findOne($id);
        $model['pdk']->linhvucChecked = ArrayHelper::getColumn($model['pdk']->getPhongthinghiemLinhvucs()->asArray()->all(), 'id_lv');
        $model['pdk']->chatluongChecked = ArrayHelper::getColumn($model['pdk']->getPhongthinghiemChatluongs()->asArray()->all(), 'id_cncl');
        $model['pdk']->hoivienChecked = ArrayHelper::getColumn($model['pdk']->getPhongthinghiemHoptacs()->asArray()->all(), 'id_tcht');
        $model['pdk']->tieuchuanChecked = ArrayHelper::getColumn($model['pdk']->getPhongthinghiemTieuchuans()->asArray()->all(), 'id_tc');
        $model['pdk']->phanloaiChecked = ArrayHelper::map($model['pdk']->getPhongthinghiemChungloais()->asArray()->all(), 'id_ptn_cl', 'id_pl', 'id_cl');
        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();

        if ($model['pdk']->load($request->post())) {
            $model['pdk']->save();
            $this->redirect(Yii::$app->urlManager->createUrl('user/userthietbi') . '?id=' . $model['pdk']->id_pdkptn);
        }
        return $this->render('phongthinghiem/update', [
                    'model' => $model,
        ]);
    }

    // nop phieu dang ky

    public function actionNopphieudangkyptn() {
        $post = Yii::$app->request->post();
        if (!isset($post['id_pdk'])) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
        date_default_timezone_set('Asia/Ho_chi_minh');
        $phieudangky = PdkPhongthinghiem::findOne($post['id_pdk']);
        $phieudangky->status = 1;
        $phieudangky->created_by = Yii::$app->user->id;
        $phieudangky->created_at = date('Y-m-d H:i:s');
        $phieudangky->save();
        return $this->redirect(Yii::$app->urlManager->createUrl('danh-sach-dang-ky'));
    }

    // danh sach phieu dang ky

    public function actionDanhsachdangky() {
        $this->layout = "@app/views/layouts/user/main_user";
        $query_chuyengia = PdkChuyengia::find()->where(['created_by' => Yii::$app->user->id])->orderBy('created_at');
        $model['dataProvider']['chuyengia'] = new ActiveDataProvider([
            'query' => $query_chuyengia,
        ]);

        $query_phongthinghiem = PdkPhongthinghiem::find()->where(['created_by' => Yii::$app->user->id])->andWhere(['status' => 1])->orderBy('created_at');
        $model['dataProvider']['phongthinghiem'] = new ActiveDataProvider([
            'query' => $query_phongthinghiem,
        ]);
        return $this->render('danhsachdangky', [
                    'model' => $model,
        ]);
    }

    // tai khoan ca nhan

    public function actionTaikhoan() {
        $request = Yii::$app->request;
        $this->layout = "@app/views/layouts/user/main_user";

        $model['taikhoan'] = TaiKhoan::findOne(Yii::$app->user->id);
        $model['doimatkhau'] = new DoiMatKhau();

        if ($request->isPost) {
            $model['taikhoan']->load($request->post());
            $model['taikhoan']->save();
            UtilityService::alert('capnhatthongtin');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('taikhoan', [
                    'model' => $model,
        ]);
    }

    // doi mat khau

    public function actionDoimatkhau() {
        $model['doimatkhau'] = new DoiMatKhau();
        $model->load(Yii::$app->request->post());
        $model->change();
        UtilityService::alert('doimatkhau');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionInbox() {
        $this->layout = "@app/views/layouts/user/main_user";

        $model['lienhe'] = LienHe::find()->where(['created_by' => Yii::$app->user->id])->orderBy('replied_at,created_at')->all();
        return $this->render('inbox', [
                    'model' => $model,
        ]);
    }

    public function actionSearchthietbi() {

        $request = Yii::$app->request;
        $this->layout = "@app/views/layouts/user/main_user";

        $model['search'] = new Search();
        if ($request->isGet && $request->get() != null && isset($request->get()['id']) && $request->get()['id'] != null) {
            $query = PhongThiNghiem::find()->leftJoin('thietbithunghiem', 'thietbithunghiem.ptn_id = phong_thi_nghiem.id_ptn')
                    ->where('thietbithunghiem.id_thietbithunghiem = ' . $request->get()['id']);
        }
        if ($request->isPost) {
            $post = $request->post();
            $model['search']->load($post);
            return $this->redirect(Yii::$app->urlManager->createUrl('user/searchthietbi') . "?id=" . $model['search']->id_thietbithunghiem);
        }

        return $this->render('searchthietbi', [
                    'model' => $model,
        ]);
    }

    public function actionMap() {
        $this->layout = "@app/views/layouts/user/user_map";
        return $this->render('map');
    }

    public function actionSearch() {
        // DebugService::dumpdie(Yii::$app->request->post());
        $post = Yii::$app->request->post();
        // $chuyengia = " ho_ten like '%" . mb_strtoupper($post['ho_ten']) . "%'";
        if ($post['chon_lop'] == 1) {
            if ($post['ho_ten'] != NULL) {
                return $this->redirect(Yii::$app->homeUrl . 'user/map?key=1=1%20and%20ho_ten%20like%20%27%25' . mb_strtoupper($post['ho_ten']) . '%25%27');
            } else {
                return $this->redirect(Yii::$app->homeUrl . 'user/map');
            }
        }
        if ($post['chon_lop'] == 0) {
            if ($post['ho_ten'] != NULL) {
                return $this->redirect(Yii::$app->homeUrl . 'user/map?key=1=1%20and%20ten_tv%20like%20%27%25' . mb_strtoupper($post['ho_ten']) . '%25%27or%20ten_ta%20like%20%27%25' . mb_strtoupper($post['ho_ten']) . '%25%27');
            }
            else {
                return $this->redirect(Yii::$app->homeUrl . 'user/map');
            }
        }
    }

}

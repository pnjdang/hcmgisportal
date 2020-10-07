<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\user;

use app\controllers\base\AbstractUserController;
use app\models\danhmuc\phongthinghiem\chungloai\ChungLoai;
use app\models\danhmuc\phongthinghiem\congnhanchatluong\CongnhanChatluong;
use app\models\danhmuc\phongthinghiem\doituongphucvu\DoituongPhucvu;
use app\models\danhmuc\phongthinghiem\thietbi\Thietbi;
use app\models\danhmuc\phongthinghiem\sohuutritue\KetquaShtt;
use app\models\danhmuc\phongthinghiem\linhvucthunghiem\LinhvucThunghiem;
use app\models\PdkPhongthinghiem;
use app\models\phongthinghiem\PhongThiNghiem;
use app\models\phongthinghiem\PhongthinghiemSohuutritue;
use app\models\phongthinghiem\PhongthinghiemThietbi;
use app\models\phongthinghiem\SearchPhongthinghiem;
use app\models\ReportThongtin;
use app\models\danhmuc\phongthinghiem\tieuchuan\TieuChuan;
use app\models\danhmuc\phongthinghiem\tochuchoptac\TochucHoptac;
use app\services\DebugService;
use app\services\UtilityService;
use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * Description of DangkyController
 *
 * @author User
 */
class PhongthinghiemController extends AbstractUserController
{

    public function actionIndex()
    {
        $request = Yii::$app->request;
        $this->layout = "@app/views/layouts/user/main_user";
        $model['search'] = new SearchPhongthinghiem();
        $model['linhvucthunghiem'] = LinhvucThunghiem::find()->orderBy('ten_lv')->all();
        $model['chungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        foreach ($model['chungloai'] as $i => $chungloai) {
            foreach ($chungloai->phanLoais as $k => $phanloai) {
                $model['vatlieuthunghiem'][$chungloai->ten_cl][$phanloai->id_pl] = $phanloai->ten_pl;
            }
        }
        if ($request->isGet) {
            $params['SearchPhongthinghiem'] = $request->queryParams;

            if (isset($params['SearchPhongthinghiem']['thietbi_id']) && $params['SearchPhongthinghiem']['thietbi_id'] != null) {
                $model['thietbi'] = ThietBi::find()->where(['id_tb' => $params['SearchPhongthinghiem']['thietbi_id']])->all();
            }

            $model['search']->load($params);
            $dataProvider = $model['search']->search($params);
            return $this->render('index', [
                'model' => $model,
                'dataProvider' => $dataProvider,
            ]);
        }
        if ($request->isPost) {
            $model['search']->load($request->post());
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index') .
                '?ten_tv=' . $model['search']->ten_tv .
                '&ten_ta=' . $model['search']->ten_ta .
                '&coquan_chuquan=' . $model['search']->coquan_chuquan .
                '&dai_dien=' . $model['search']->dai_dien .
                '&pl_id=' . $model['search']->pl_id .
                '&lvtn_id=' . $model['search']->lvtn_id .
                '&thietbi_id=' . $model['search']->thietbi_id
            );
        }
    }

    public function actionView($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }

        $model['phongthinghiem'] = PhongThiNghiem::find()
            ->joinWith('dtpv')
            ->joinWith('phongthinghiemLinhvucs')
            ->joinWith('phongthinghiemTieuchuans')
            ->joinWith('phongthinghiemHoptacs')
            ->joinWith('phongthinghiemChatluongs')
            ->joinWith('phongthinghiemChungloais')
            ->joinWith('phongthinghiemThietbis')
            ->joinWith('phongthinghiemThietbis')
            ->where(['id_ptn' => $id, 'phong_thi_nghiem.status' => 1])->one();
        if ($model['phongthinghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }
//        DebugService::dumpdie($model['phongthinghiem']->phongthinghiemThietbis);
        $sohuutritue = PhongthinghiemSohuutritue::find()->where(['ptn_id' => $id])->orderBy('nam,ketquashtt_id')->asArray()->all();
        $model['sohuutritue'] = ArrayHelper::index($sohuutritue, 'id_ketquashtt', 'nam');
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();
        return $this->renderPartial('view', [
            'model' => $model,
        ]);
    }

    public function actionPreview($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }

        $model['phongthinghiem'] = PhongThiNghiem::find()
            ->joinWith('dtpv')
            ->joinWith('phongthinghiemLinhvucs')
            ->joinWith('phongthinghiemTieuchuans')
            ->joinWith('phongthinghiemHoptacs')
            ->joinWith('phongthinghiemChatluongs')
            ->joinWith('phongthinghiemChungloais')
            ->where(['id_ptn' => $id, 'phong_thi_nghiem.status' => 2])->one();
        if ($model['phongthinghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }

        return $this->render('preview', [
            'model' => $model,
        ]);
    }

    public function actionViewptn($id)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($request->get()['id'])) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }

        $model['phongthinghiem'] = PhongThiNghiem::find()
            ->joinWith('dtpv')
            ->joinWith('phongthinghiemLinhvucs')
            ->joinWith('phongthinghiemTieuchuans')
            ->joinWith('phongthinghiemHoptacs')
            ->joinWith('phongthinghiemChatluongs')
            ->joinWith('phongthinghiemChungloais')
            ->where(['id_ptn' => $id, 'phong_thi_nghiem.status' => 1])->one();
        if ($model['phongthinghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }
        $model['danhsachthietbi'] = null;
//        thietbithunghiem.so_hieu,
//        thietbithunghiem.nam_sx,
//        thietbithunghiem.hang_sx,
//        thietbithunghiem.nuoc_sx,
//        thietbithunghiem.dactinh_kythuat,
//        thietbithunghiem.so_luong,
//        thietbithunghiem.tinh_trang,
//        thietbithunghiem.id_thietbithunghiem,
//        thietbithunghiem.ghi_chu,
//        thiet_bi.ten_tb')
//            ->from(PhongthinghiemThietbi::tableName())
//            ->leftJoin(ThietBi::tableName(), 'thiet_bi.id_tb = thietbithunghiem.thietbi_id')
//            ->where(['ptn_id' => $id])
//            ->orderBy('id_thietbithunghiem desc')->all();
//        $sohuutritue = PhongthinghiemSohuutritue::find()->where(['id_ptn' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
//        $model['sohuutritue'] = ArrayHelper::index($sohuutritue, 'id_ketquashtt', 'nam');
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();
        return $this->renderAjax('viewptn', [
            'model' => $model,
        ]);
    }

    public function actionReport($id)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }
        $request = Yii::$app->request;
        $model['report'] = new ReportThongtin();
        if ($model['report']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['report']->created_at = date('Y-m-d H:i:s');
            $model['report']->created_by = Yii::$app->user->id;
            $model['report']->phongthinghiem_id = $id;
            $model['report']->save();
            $this->redirect(Yii::$app->urlManager->createUrl('phong-thi-nghiem'));
        }
        return $this->renderPartial('report', [
            'model' => $model['report'],
        ]);
    }

    public function actionCreate()
    {
        $this->layout = "@app/views/layouts/user/main_user";
        $request = Yii::$app->request;
        $model['ptn'] = new PhongThiNghiem();

        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();
        if ($model['ptn']->load($request->post())) {
            $model['ptn']->status = 2;//trang thai dang ky
            $model['ptn']->created_at = date('Y-m-d H:i:s');
            $model['ptn']->created_by = Yii::$app->user->id;
            $model['ptn']->save();
            UtilityService::alert('success');
            $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/preview?id=' . $model['ptn']->id_ptn));
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /*
     * cap nhat phieu dang ky thong tin phong thi nghiem
     * */

// so huu tri tue - phieu dang ky

    public function actionUsersohuutritue($id)
    {
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

    public function actionUserlistsohuutritue($id)
    {
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['id_pdk'] = $id;
        $sohuutritue = PhongthinghiemSohuutritue::find()->where(['id_pdk' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();
        $model['sohuutritue'] = ArrayHelper::index($sohuutritue, 'id_ketquashtt', 'nam');
        return $this->renderPartial('phongthinghiem/inc_sohuutritue', [
            'model' => $model,
        ]);
    }

    public function actionUsercreatesohuutritue($id)
    {
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

    public function actionUserupdatesohuutritue($id, $nam)
    {
        $request = Yii::$app->request;

        if (!UtilityService::paramValidate($nam) || !UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
        $model['id_pdk'] = $id;
        $model['nam'] = $nam;
        $model['sohuutritue'] = PhongthinghiemSohuutritue::find()->where(['nam' => $nam])->andWhere(['id_pdk' => $id])->orderBy('id_ketquashtt')->indexBy('id_ketquashtt')->all();
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

    public function actionUserdeletesohuutritue($id, $nam)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($nam) || !UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
        $model['id_pdk'] = $id;
        $model['nam'] = $nam;
        if ($request->isPost) {
            PhongthinghiemSohuutritue::deleteAll(['nam' => $nam, 'id_pdk' => $id]);
            UtilityService::alert('thietbi_delete_success');
            return true;
        }

        return $this->renderAjax('phongthinghiem/inc_deletesohuutritue', [
            'model' => $model,
        ]);
    }

// thiet bi - phieu dang ky
    public function actionUserthietbi($id)
    {
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['id_pdk'] = $id;
        return $this->render('thietbi', [
            'model' => $model,
        ]);
    }

    public function actionUserlistthietbi($id)
    {
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
            ->from(PhongthinghiemThietbi::tableName())
            ->leftJoin(ThietBi::tableName(), 'thiet_bi.id_tb = thietbithunghiem.thietbi_id')
            ->where(['id_pdk' => $id])
            ->orderBy('created_at')->all();
        return $this->renderPartial('phongthinghiem/inc_thietbi', [
            'model' => $model,
        ]);
    }

    public function actionUsercreatethietbi($id)
    {

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

    public function actionUserupdatethietbi($id)
    {

        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['thietbi'] = PhongthinghiemThietbi::findOne($id);
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

    public function actionUserdeletethietbi($id)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['thietbi'] = PhongthinghiemThietbi::findOne($id);
        $model['id_pdk'] = $model['thietbi']->id_pdk;
        if ($request->isPost && $model['thietbi']->delete()) {
            UtilityService::alert('thietbi_delete_success');
            return true;
        }
        return $this->renderAjax('phongthinghiem/inc_deletethietbi', [
            'model' => $model,
        ]);
    }

    public function actionReview($id)
    {
        $this->layout = "@app/views/layouts/user/main_user";

        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['pdk'] = PdkPhongthinghiem::find()
            ->joinWith('dtpv')
            ->joinWith('phongthinghiemLinhvucs')
            ->joinWith('phongthinghiemTieuchuans')
            ->joinWith('phongthinghiemHoptacs')
            ->joinWith('phongthinghiemChatluongs')
            ->joinWith('phongthinghiemChungloais')
            ->where(['id_pdkptn' => $id, 'pdk_phongthinghiem.status' => 0])->one();
        if ($model['pdk'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
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
            ->from(PhongthinghiemThietbi::tableName())
            ->leftJoin(ThietBi::tableName(), 'thiet_bi.id_tb = thietbithunghiem.thietbi_id')
            ->where(['id_pdk' => $id])
            ->orderBy('id_thietbithunghiem desc')->all();
        $sohuutritue = PhongthinghiemSohuutritue::find()->where(['id_pdk' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
        $model['sohuutritue'] = ArrayHelper::index($sohuutritue, 'id_ketquashtt', 'nam');
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();

        $model['status'] = $model['pdk']['status'];
        return $this->render('preview', [
            'model' => $model,
        ]);
    }

    public function actionViewpdk($id)
    {
        $this->layout = "@app/views/layouts/user/main_user";

        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

        $model['pdk'] = PdkPhongthinghiem::find()
            ->joinWith('dtpv')
            ->joinWith('phongthinghiemLinhvucs')
            ->joinWith('phongthinghiemTieuchuans')
            ->joinWith('phongthinghiemHoptacs')
            ->joinWith('phongthinghiemChatluongs')
            ->joinWith('phongthinghiemChungloais')
            ->where(['id_pdkptn' => $id, 'pdk_phongthinghiem.status' => 1])->one();
        if ($model['pdk'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }

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
            ->from(PhongthinghiemThietbi::tableName())
            ->leftJoin(ThietBi::tableName(), 'thiet_bi.id_tb = thietbithunghiem.thietbi_id')
            ->where(['id_pdk' => $id])
            ->orderBy('id_thietbithunghiem desc')->all();
        $sohuutritue = PhongthinghiemSohuutritue::find()->where(['id_pdk' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
        $model['sohuutritue'] = ArrayHelper::index($sohuutritue, 'id_ketquashtt', 'nam');
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();


        return $this->renderPartial('viewpdk', [
            'model' => $model,
        ]);
    }

    public function actionUpdatepdk($id)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('dang-ky-phong-thi-nghiem'));
        }
        $this->layout = "@app/views/layouts/user/main_user";
        $request = Yii::$app->request;
        $model['pdk'] = PdkPhongthinghiem::findOne($id);
        $model['pdk']->linhvucChecked = ArrayHelper::getColumn($model['pdk']->getPhongthinghiemLinhvucs()->asArray()->all(), 'lv_id');
        $model['pdk']->chatluongChecked = ArrayHelper::getColumn($model['pdk']->getPhongthinghiemChatluongs()->asArray()->all(), 'cncl_id');
        $model['pdk']->hoivienChecked = ArrayHelper::getColumn($model['pdk']->getPhongthinghiemHoptacs()->asArray()->all(), 'tcht_id');
        $model['pdk']->tieuchuanChecked = ArrayHelper::getColumn($model['pdk']->getPhongthinghiemTieuchuans()->asArray()->all(), 'tc_id');
        $model['pdk']->phanloaiChecked = ArrayHelper::map($model['pdk']->getPhongthinghiemChungloais()->asArray()->all(), 'id_ptn_cl', 'pl_id', 'cl_id');
        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();

        if ($model['pdk']->load($request->post())) {
            $model['pdk']->save();
            UtilityService::alert('capnhatphongthinghiem');
            $this->redirect(Yii::$app->urlManager->createUrl('user/danhsachdangky'));
        }
        return $this->render('updatepdk', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id = null)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }

        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $id, 'phong_thi_nghiem.status' => 1])->one();
        if (($model['phongthinghiem'] == null) || ($model['phongthinghiem']->taikhoan_id != Yii::$app->user->id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }
//        $model['temp'] = new TempPhongthinghiem();
        $model['phongthinghiem']->linhvucChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemLinhvucs()->asArray()->all(), 'lv_id');
        $model['phongthinghiem']->chatluongChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemChatluongs()->asArray()->all(), 'cncl_id');
        $model['phongthinghiem']->hoivienChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemHoptacs()->asArray()->all(), 'tcht_id');
        $model['phongthinghiem']->tieuchuanChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemTieuchuans()->asArray()->all(), 'tc_id');
        $model['phongthinghiem']->phanloaiChecked = ArrayHelper::map($model['phongthinghiem']->getPhongthinghiemChungloais()->asArray()->all(), 'id_ptn_cl', 'pl_id', 'cl_id');


//        $sohuutritue = PhongthinghiemSohuutritue::find()->where(['id_ptn' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
//        $model['sohuutritue'] = ArrayHelper::index($sohuutritue, 'id_ketquashtt', 'nam');
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();
        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();

        if ($request->isPost && $model['phongthinghiem']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['phongthinghiem']->updated_at = date('Y-m-d H:i:s');
            $model['phongthinghiem']->created_by = Yii::$app->user->id;
            $model['phongthinghiem']->save();
            UtilityService::alert('send_success');
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    // nop phieu dang ky

    public function actionNopphieudangkyptn()
    {
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

    public function actionTest(){
        for($i = 1; $i <= 207; $i++){
            $n = new PhongthinghiemThietbi();
            $n->save();
        }
    }
}

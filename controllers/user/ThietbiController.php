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
use app\models\KetquaShtt;
use app\models\LinhvucThunghiem;
use app\models\PdkPhongthinghiem;
use app\models\phongthinghiem\PhongThiNghiem;
use app\models\phongthinghiem\PhongthinghiemSearch;
use app\models\phongthinghiem\PhongthinghiemThietbi;
use app\models\ReportThongtin;
use app\models\SohuuTritue;
use app\models\TempPhongthinghiem;
use app\models\danhmuc\phongthinghiem\thietbi\ThietBi;
use app\models\Thietbithunghiem;
use app\models\TieuChuan;
use app\models\TochucHoptac;
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
class ThietbiController extends AbstractUserController
{

    public function actionDanhsach($id = null)
    {
        $this->layout = "@app/views/layouts/user/main_user";
        if(!UtilityService::paramValidate($id)){
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }
//        $model['ptn'] = PhongThiNghiem::find()->where(['id_ptn' => $id, 'created_by' => Yii::$app->user->id, 'status' => 2])->one();
//        if($model['ptn'] == null){
//            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
//        }
//        $model['thietbi'] = PhongthinghiemThietbi::find()->where(['ptn_id' => $id])->all();
        $model['id_ptn'] = $id;
        return $this->render('danhsach',[
            'model' => $model
        ]);
    }

    public function actionUserlistthietbi($id = null)
    {
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
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
        return $this->renderPartial('listthietbi', [
            'model' => $model,
        ]);
    }

    public function actionView($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }
    }

    public function actionCreate($id = null)
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
        $sohuutritue = SohuuTritue::find()->where(['id_pdk' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
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

    public function actionUserdeletesohuutritue($id, $nam)
    {
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





    public function actionUserupdatethietbi($id)
    {

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

    public function actionUserdeletethietbi($id)
    {
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

    public function actionPreview($id)
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
            ->from(Thietbithunghiem::tableName())
            ->leftJoin(ThietBi::tableName(), 'thiet_bi.id_tb = thietbithunghiem.thietbi_id')
            ->where(['id_pdk' => $id])
            ->orderBy('id_thietbithunghiem desc')->all();
        $sohuutritue = SohuuTritue::find()->where(['id_pdk' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
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
            ->from(Thietbithunghiem::tableName())
            ->leftJoin(ThietBi::tableName(), 'thiet_bi.id_tb = thietbithunghiem.thietbi_id')
            ->where(['id_pdk' => $id])
            ->orderBy('id_thietbithunghiem desc')->all();
        $sohuutritue = SohuuTritue::find()->where(['id_pdk' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
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

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }
        $this->layout = "@app/views/layouts/user/main_user";

        $model['phongthinghiem'] = PhongThiNghiem::find()
            ->joinWith('dtpv')
            ->joinWith('phongthinghiemLinhvucs')
            ->joinWith('phongthinghiemTieuchuans')
            ->joinWith('phongthinghiemHoptacs')
            ->joinWith('phongthinghiemChatluongs')
            ->joinWith('phongthinghiemChungloais')
            ->where(['id_ptn' => $id, 'phong_thi_nghiem.status' => 1])->one();
        if (($model['phongthinghiem'] == null) || ($model['phongthinghiem']->taikhoan_id != Yii::$app->user->id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }
        $model['temp'] = new TempPhongthinghiem();
        $model['temp']->linhvucChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemLinhvucs()->asArray()->all(), 'lv_id');
        $model['temp']->chatluongChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemChatluongs()->asArray()->all(), 'cncl_id');
        $model['temp']->hoivienChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemHoptacs()->asArray()->all(), 'tcht_id');
        $model['temp']->tieuchuanChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemTieuchuans()->asArray()->all(), 'tc_id');
        $model['temp']->phanloaiChecked = ArrayHelper::map($model['phongthinghiem']->getPhongthinghiemChungloais()->asArray()->all(), 'id_ptn_cl', 'pl_id', 'cl_id');

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
            ->where(['ptn_id' => $id])
            ->orderBy('id_thietbithunghiem desc')->all();
        $sohuutritue = SohuuTritue::find()->where(['id_ptn' => $id])->orderBy('nam,id_ketquashtt')->asArray()->all();
        $model['sohuutritue'] = ArrayHelper::index($sohuutritue, 'id_ketquashtt', 'nam');
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->orderBy('id_ketquashtt')->all();
        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();

        if ($request->isPost && $model['temp']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['temp']->taikhoan_id = Yii::$app->user->id;
            $model['temp']->status = 0;
            $model['temp']->created_at = date('Y-m-d H:i:s');
            $model['temp']->created_by = Yii::$app->user->id;
            $model['temp']->save();
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

}

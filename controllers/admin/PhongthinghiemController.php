<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 11/22/2017
 * Time: 4:33 PM
 */

namespace app\controllers\admin;

use app\controllers\base\AbstractTlkhcnController;
use app\models\danhmuc\phongthinghiem\chungloai\ChungLoai;
use app\models\danhmuc\phongthinghiem\congnhanchatluong\CongnhanChatluong;
use app\models\danhmuc\phongthinghiem\doituongphucvu\DoituongPhucvu;
use \app\models\danhmuc\phongthinghiem\sohuutritue\KetquaShtt;
use app\models\danhmuc\phongthinghiem\linhvucthunghiem\LinhvucThunghiem;
use app\models\phongthinghiem\PhongThiNghiem;
use app\models\phongthinghiem\SearchPhongthinghiemThietbi;
use app\models\danhmuc\phongthinghiem\thietbi\ThietBi;
use app\models\phongthinghiem\SearchPhongthinghiemSohuutritue;
use app\models\danhmuc\phongthinghiem\tieuchuan\TieuChuan;
use app\models\danhmuc\phongthinghiem\tochuchoptac\TochucHoptac;
use app\services\DebugService;
use app\services\UtilityService;
use yii\helpers\ArrayHelper;
use Yii;

class PhongthinghiemController extends AbstractTlkhcnController
{

    public function actionView($id = null)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($request->get()['id'])) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
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
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionViewptn($id = null)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($request->get()['id'])) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
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
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }

        return $this->renderPartial('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate(){
        $request = Yii::$app->request;
        $model['phongthinghiem'] = new PhongThiNghiem();
        $model['thietbi'] = new Thietbi();
        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();
        $model['ketquashtt'] = KetquaShtt::find()->where(['status' => 0])->all();

        if ($model['phongthinghiem']->load($request->post())) {
            $post = $request->post();
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['phongthinghiem']->created_by = Yii::$app->user->id;
            $model['phongthinghiem']->created_at = date('Y-m-d H:i:s');
            $model['phongthinghiem']->status = 1;
            $model['phongthinghiem']->save();

            UtilityService::alert('ptn_create_success');
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/phongthinghiem/view?id=') . $model['phongthinghiem']->id_ptn);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id = null){
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($request->get()['id'])) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $id, 'phong_thi_nghiem.status' => 1])->one();
        if ($model['phongthinghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $model['phongthinghiem']->linhvucChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemLinhvucs()->asArray()->all(), 'lv_id');
        $model['phongthinghiem']->chatluongChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemChatluongs()->asArray()->all(), 'cncl_id');
        $model['phongthinghiem']->hoivienChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemHoptacs()->asArray()->all(), 'tcht_id');
        $model['phongthinghiem']->tieuchuanChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemTieuchuans()->asArray()->all(), 'tc_id');
        $model['phongthinghiem']->phanloaiChecked = ArrayHelper::map($model['phongthinghiem']->getPhongthinghiemChungloais()->asArray()->all(), 'id_ptn_cl', 'pl_id', 'cl_id');
        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();

        if ($model['phongthinghiem']->load($request->post())) {
            $post = $request->post();
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['phongthinghiem']->updated_by = Yii::$app->user->id;
            $model['phongthinghiem']->updated_at = date('Y-m-d H:i:s');
            $model['phongthinghiem']->save();
            if (isset($post['thietbi']) && $post['thietbi'] != null) {
                foreach ($post['thietbi'] as $i => $thietbi) {
                    $thietbithunghiem = new Thietbithunghiem();
                    $thietbithunghiem->ten_thietbi = $thietbi['ten_thietbi'];
                    $thietbithunghiem->hang_sx = $thietbi['hang_sx'];
                    $thietbithunghiem->nam_sx = $thietbi['nam_sx'];
                    $thietbithunghiem->nuoc_sx = $thietbi['nuoc_sx'];
                    $thietbithunghiem->dactinh_kythuat = $thietbi['dactinh_kythuat'];
                    $thietbithunghiem->so_luong = $thietbi['so_luong'];
                    $thietbithunghiem->ptn_id = $model['phongthinghiem']->id_ptn;
                    $thietbithunghiem->save();
                }
            }
            UtilityService::alert('ptn_create_success');
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/phongthinghiem/view?id=') . $model['phongthinghiem']->id_ptn);
        }

        return $this->render('update',[
            'model' => $model,
        ]);

    }

    public function actionDelete($id = null){
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        $request = Yii::$app->request;
        $model['phongthinghiem'] = PhongThiNghiem::findOne($id);
        if ($model['phongthinghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }

        if ($request->isPost) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['phongthinghiem']->status = 0;
            $model['phongthinghiem']->updated_by = Yii::$app->user->id;
            $model['phongthinghiem']->updated_at = date('Y-m-d H:i:s');
            $model['phongthinghiem']->save();
            UtilityService::alert('deleted');
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index'));
        }
        return $this->renderPartial('delete',[
            'model' => $model
        ]);
    }

    public function actionThietbithunghiem($id = null){
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

    public function actionSohuutritue($id = null){
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

    public function actionTest(){
//        $phongthinghiem = PhongThiNghiem::find()->where(['status' => 1])->all();
//        foreach($phongthinghiem as $i => $ptn){
//            $ptn->ten_khongdau = UtilityService::utf8convert($ptn->ten_tv);
//            $ptn->save();
//        }
    }
}
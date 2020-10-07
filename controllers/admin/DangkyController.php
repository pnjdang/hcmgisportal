<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\admin;

use app\controllers\base\AbstractTlkhcnController;
use app\models\ChungLoai;
use app\models\chuyengia\ChuyenGia;
use app\models\CongnhanChatluong;
use app\models\DoituongPhucvu;
use app\models\danhmuc\chuyengia\donvi\DonVi;
use app\models\danhmuc\chuyengia\hocham\HocHam;
use app\models\danhmuc\chuyengia\hocvi\HocVi;
use app\models\KetquaShtt;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap1\LinhvucnghiencuuCap1;
use app\models\danhmuc\chuyengia\linhvucquanly\LinhvucQuanly;
use app\models\LinhvucThunghiem;
use app\models\PdkChuyengia;
use app\models\PdkPhongthinghiem;
use app\models\PhanLoai;
use app\models\phongthinghiem\PhongThiNghiem;
use app\models\chuyengia\SearchPdkChuyengia;
use app\models\phongthinghiem\SearchPdkPhongthinghiem;
use app\models\phongthinghiem\PhongthinghiemSohuutritue;
use app\models\danhmuc\phongthinghiem\thietbi\ThietBi;
use app\models\phongthinghiem\PhongthinghiemThietbi;
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

    public function actionChuyengia()
    {
        $searchModel = new SearchPdkChuyengia();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPhongthinghiem()
    {
        $searchModel = new SearchPdkPhongthinghiem();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('phongthinghiem', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdatechuyengia($id = null){
        if(!UtilityService::paramValidate($id)){
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/dangky/chuyengia'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 2])->one();
        if($model['chuyengia'] == null){
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/dangky/chuyengia'));
        }
        $model['chuyengia']->linhvucnghiencuu = ArrayHelper::getColumn($model['chuyengia']->chuyengiaLinhvucs, 'cap1_id');
        $model['chuyengia']->chuyennganh = ArrayHelper::map($model['chuyengia']->chuyengiaChuyennganhs, 'cap3_id', 'cap3.ma_ten_cap3');
        $model['hocham'] = HocHam::find()->where(['status' => 1])->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->where(['status' => 1])->orderBy('ten_hv')->all();
        $model['linhvucquanly'] = LinhvucQuanly::find()->orderBy('id_lvql')->all();
        $model['linhvucnghiencuu'] = LinhvucnghiencuuCap1::find()->where(['status' => 1])->orderBy('id_cap1')->all();
        if($model['chuyengia']->donvi != null){
            $model['donvi'] = [$model['chuyengia']->donvi->id_donvi => $model['chuyengia']->donvi->ten_donvi];
        } else {
            $model['donvi'] = null;

        }

        if($model['chuyengia']->load(Yii::$app->request->post())){
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['chuyengia']->updated_by = Yii::$app->user->id;
            $model['chuyengia']->updated_at = date('Y-m-d H:i:s');
            $model['chuyengia']->status = 1;
            $model['chuyengia']->save();
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/dangky/chuyengia'));
        }
        return $this->render('updatechuyengia',[
            'model' => $model,
        ]);
    }

    public function actionUpdatephongthinghiem($id = null){
        if(!UtilityService::paramValidate($id)){
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/dangky/phongthinghiem'));
        }
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $id, 'status' => 2])->one();
        if($model['phongthinghiem'] == null){
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/dangky/phongthinghiem'));
        }
        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();
        $model['phongthinghiem']->linhvucChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemLinhvucs()->asArray()->all(), 'lv_id');
        $model['phongthinghiem']->chatluongChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemChatluongs()->asArray()->all(), 'cncl_id');
        $model['phongthinghiem']->hoivienChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemHoptacs()->asArray()->all(), 'tcht_id');
        $model['phongthinghiem']->tieuchuanChecked = ArrayHelper::getColumn($model['phongthinghiem']->getPhongthinghiemTieuchuans()->asArray()->all(), 'tc_id');
        $model['phongthinghiem']->phanloaiChecked = ArrayHelper::map($model['phongthinghiem']->getPhongthinghiemChungloais()->asArray()->all(), 'id_ptn_cl', 'pl_id', 'cl_id');

        if($model['phongthinghiem']->load(Yii::$app->request->post())){
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['phongthinghiem']->updated_by = Yii::$app->user->id;
            $model['phongthinghiem']->updated_at = date('Y-m-d H:i:s');
            $model['phongthinghiem']->status = 1;
            $model['phongthinghiem']->save();
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/dangky/phongthinghiem'));
        }

        return $this->render('updatephongthinghiem',[
            'model' => $model
        ]);
    }

}

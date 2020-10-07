<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\user;

use app\controllers\base\AbstractUserController;
use app\models\chuyengia\ChuyenGia;
use app\models\chuyengia\ChuyengiaConfig;
use app\models\danhmuc\chuyengia\donvi\Donvi;
use app\models\danhmuc\chuyengia\hocham\HocHam;
use app\models\danhmuc\chuyengia\hocvi\HocVi;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap1\LinhvucnghiencuuCap1;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap3\LinhvucnghiencuuCap3;
use app\models\danhmuc\chuyengia\linhvucquanly\LinhvucQuanly;
use app\models\danhmuc\chuyengia\loaicongtrinhnghiencuu\LoaiCongtrinhnghiencuu;
use app\models\danhmuc\chuyengia\ngoaingu\Ngoaingu;
use app\models\export\chuyengia\VExportChuyengia;
use app\models\ReportThongtin;
use app\models\chuyengia\SearchChuyengia;
use app\models\chuyengia\SearchChuyengiaCongtac;
use app\models\chuyengia\SearchChuyengiaCongtrinh;
use app\models\chuyengia\SearchChuyengiaDaotao;
use app\models\chuyengia\SearchChuyengiaDetai;
use app\models\chuyengia\SearchChuyengiaNgoaingu;
use app\services\DebugService;
use app\services\UtilityService;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\WriterFactory;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Description of DangkyController
 *
 * @author User
 */
class ChuyengiaController extends AbstractUserController
{

    //ChuyenGia
    /*
     * index chuyen gia
     * */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $this->layout = "@app/views/layouts/user/main_user";
        $model['search'] = new SearchChuyengia();
        $model['hocham'] = HocHam::find()->where(['status' => 1])->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->where(['status' => 1])->orderBy('ten_hv')->all();
        $model['congtrinh'] = LoaiCongtrinhnghiencuu::find()->where(['status' => 1])->orderBy('ten_loaicongtrinh')->all();

        if ($request->isGet) {
            $params['SearchChuyengia'] = $request->queryParams;
//            DebugService::dumpdie($params['SearchChuyengia']);
            if(isset($params['SearchChuyengia']['linh_vuc']) && $params['SearchChuyengia']['linh_vuc'] != null){
                $model['cap1'] = ArrayHelper::map(LinhvucnghiencuuCap1::find()->where(['id_cap1' => $params['SearchChuyengia']['linh_vuc']])->all(),'id_cap1','ten_cap1');
            } else {
                $model['cap1'] = null;
            }
            if(isset($params['SearchChuyengia']['chuyen_nganh']) && $params['SearchChuyengia']['chuyen_nganh'] != null){
                $model['cap3'] = ArrayHelper::map(LinhvucnghiencuuCap3::find()->where(['id_cap3' => $params['SearchChuyengia']['chuyen_nganh']])->all(),'id_cap3','ma_ten_cap3');
            }else {
                $model['cap3'] = null;
            }
            if(isset($params['SearchChuyengia']['donvi_id']) && $params['SearchChuyengia']['donvi_id'] != null){
                $model['donvi'] = ArrayHelper::map(Donvi::find()->where(['id_donvi' => $params['SearchChuyengia']['donvi_id']])->all(),'id_donvi','ten_donvi');
            }else {
                $model['donvi'] = null;
            }
            $dataProvider = $model['search']->search($params);
//            DebugService::dumpdie($model);
            return $this->render('index', [
                'model' => $model,
                'dataProvider' => $dataProvider,
            ]);
        }
        if ($request->isPost) {
            $model['search']->load($request->post());
//            DebugService::dumpdie($model['search']);
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index') .
                '?ho_ten=' . $model['search']->ho_ten.
                '&linh_vuc=' . $model['search']->linh_vuc .
                '&chuyen_nganh=' . $model['search']->chuyen_nganh.
                '&hoc_ham=' . $model['search']->hoc_ham.
                '&hoc_vi=' . $model['search']->hoc_vi.
                '&loai_congtrinh=' . $model['search']->loai_congtrinh.
                '&ten_congtrinh=' . $model['search']->ten_congtrinh.
                '&donvi_id=' . $model['search']->donvi_id
            );
        }

    }

    /*
     * xem chi tiet chuyen gia
     * */
    public function actionView($id = null)
    {
        $this->layout = "@app/views/layouts/user/main_user";
        $model['chuyengia'] = Chuyengia::find()->with('donvi', 'hocham', 'hocvi', 'chuyengiaChuyennganhs', 'chuyengiaChuyennganhs.cap3', 'chuyengiaLinhvucs', 'chuyengiaLinhvucs.cap1')->where(['id_chuyengia' => $id,'chuyengia.status' => 1])->one();
        $model['config'] = ChuyengiaConfig::findOne(['chuyengia_id' => $id]);
        return $this->render('view', [
            'model' => $model,
        ]);

    }

    public function actionPreview($id = null)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }

        $model['chuyengia'] = Chuyengia::find()->with('donvi', 'hocham', 'hocvi', 'chuyengiaChuyennganhs', 'chuyengiaChuyennganhs.cap3', 'chuyengiaLinhvucs', 'chuyengiaLinhvucs.cap1')->where(['id_chuyengia' => $id,'chuyengia.status' => 2])->one();
        $model['config'] = ChuyengiaConfig::findOne(['chuyengia_id' => $id]);

        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }

        if($request->isPost && $model['config']->load($request->post()) && $model['config']->save()){
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/preview').'?id='.$model['chuyengia']->id_chuyengia);
        }
        return $this->render('preview', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id = null){
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->with('donvi')->where(['id_chuyengia' => $id])->andWhere('status = 1 or status = 2')->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['hocham'] = HocHam::find()->where(['status' => 1])->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->where(['status' => 1])->orderBy('ten_hv')->all();
        $model['linhvucnghiencuu'] = LinhvucnghiencuuCap1::find()->where(['status' => 1])->orderBy('id_cap1')->all();
        if($model['chuyengia']->donvi != null){
            $model['donvi'] = [$model['chuyengia']->donvi->id_donvi => $model['chuyengia']->donvi->ten_donvi];
        } else {
            $model['donvi'] = null;

        }
//        DebugService::dumpdie($model['chuyengia']);
        return $this->render('update',[
            'model' => $model
        ]);
    }

    public function actionCongtrinh($id = null)
    {
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id])->andWhere('status = 1 or status = 2')->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['loaicongtrinh'] = LoaiCongtrinhnghiencuu::find()->where(['status' => 1])->orderBy('ten_loaicongtrinh')->all();
        $model['search'] = new SearchChuyengiaCongtrinh();
        $model['congtrinh'] = $model['search']->search(Yii::$app->request->queryParams, $id);
        if($model['chuyengia']->status == 1){
            $model['controller'] = 'chuyengia';
        } else {
            $model['controller'] = 'pdkchuyengia';
        }
        return $this->render('congtrinh', [
            'model' => $model,
        ]);
    }

    public function actionNgoaingu($id = null){
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id])->andWhere('status = 1 or status = 2')->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['ngoaingu'] = Ngoaingu::find()->orderBy('ten_ngoaingu')->all();
        $model['search'] = new SearchChuyengiaNgoaingu();
        $model['trinhdongoaingu'] = $model['search']->search(Yii::$app->request->queryParams, $id);
        if($model['chuyengia']->status == 1){
            $model['controller'] = 'chuyengia';
        } else {
            $model['controller'] = 'pdkchuyengia';
        }
        return $this->render('trinhdongoaingu', [
            'model' => $model,
        ]);
    }

    public function actionCongtac($id = null){
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id])->andWhere('status = 1 or status = 2')->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['search'] = new SearchChuyengiaCongtac();
        $model['congtac'] = $model['search']->search(Yii::$app->request->queryParams, $id);
        if($model['chuyengia']->status == 1){
            $model['controller'] = 'chuyengia';
        } else {
            $model['controller'] = 'pdkchuyengia';
        }
        return $this->render('congtac', [
            'model' => $model,
        ]);
    }

    public function actionDaotao($id = null){
        $this->layout = "@app/views/layouts/user/main_user";
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id])->andWhere('status = 1 or status = 2')->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['search'] = new SearchChuyengiaDaotao();
        $model['daotao'] = $model['search']->search(Yii::$app->request->queryParams, $id);
        if($model['chuyengia']->status == 1){
            $model['controller'] = 'chuyengia';
        } else {
            $model['controller'] = 'pdkchuyengia';
        }
        return $this->render('daotao', [
            'model' => $model,
        ]);
    }

    public function actionDetai($id = null){
        $this->layout = "@app/views/layouts/user/main_user";

        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id])->andWhere('status = 1 or status = 2')->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $model['search'] = new SearchChuyengiaDetai();
        $model['detai'] = $model['search']->search(Yii::$app->request->queryParams, $id);
        if($model['chuyengia']->status == 1){
            $model['controller'] = 'chuyengia';
        } else {
            $model['controller'] = 'pdkchuyengia';
        }
        return $this->render('detai', [
            'model' => $model,
        ]);
    }
    /*
     * phan hoi thong tin chuyen gia chua chinh xac
     * */
    public function actionReport($id)
    {
        $this->layout = "@app/views/layouts/user/main_user";

        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia'));
        }
        $request = Yii::$app->request;
        $model['report'] = new ReportThongtin();
        $model['id_cg'] = $id;
        $model['chuyengia'] = ChuyenGia::findOne($id);
        if ($model['report']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['report']->created_at = date('Y-m-d H:i:s');
            $model['report']->created_by = Yii::$app->user->id;
            $model['report']->chuyengia_id = $id;
            $model['report']->save();
            return $this->redirect(Yii::$app->urlManager->createUrl('user/userchuyengiaindex'));
        }
        return $this->renderPartial('report', [
            'model' => $model,
        ]);

    }

    /*
     * tao moi phieu dang ky thong tin chuyen gia
     * */
    public function actionCreate()
    {
        $this->layout = "@app/views/layouts/user/main_user";
        $request = Yii::$app->request;
        $model['chuyengia'] = new Chuyengia();
        $model['hocham'] = HocHam::find()->where(['status' => 1])->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->where(['status' => 1])->orderBy('ten_hv')->all();
        $model['donvicongtac'] = Donvi::find()->orderBy('id_donvi')->all();
        $model['linhvucnghiencuu'] = LinhvucnghiencuuCap1::find()->where(['status' => 1])->orderBy('id_cap1')->all();
        if ($model['chuyengia']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['chuyengia']->created_by = Yii::$app->user->id;
            $model['chuyengia']->created_at = date('Y-m-d H:i:s');
            $model['chuyengia']->ho_ten = ucwords($model['chuyengia']->ho_ten);
            $model['chuyengia']->status = 2;
            $model['chuyengia']->save();

            $model['config'] = new ChuyengiaConfig();
            $model['config']->chuyengia_id = $model['chuyengia']->id_chuyengia;
            $model['config']->created_by = Yii::$app->user->id;
            $model['config']->created_at = date('Y-m-d H:i:s');
            $model['config']->status = 2;
            $model['config']->save();
            UtilityService::alert('create');
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/preview').'?id='.$model['chuyengia']->id_chuyengia);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionChuyengia(){
        $searchModel = new SearchChuyengia();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->user->id);
        $model['hocham'] = HocHam::find()->where(['status' => 1])->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->where(['status' => 1])->orderBy('ten_hv')->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionCongbo($id = null)
    {
        $request = Yii::$app->request;
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }

        $model['chuyengia'] = Chuyengia::find()->with('donvi', 'hocham', 'hocvi', 'chuyengiaChuyennganhs', 'chuyengiaChuyennganhs.cap3', 'chuyengiaLinhvucs', 'chuyengiaLinhvucs.cap1')->where(['id_chuyengia' => $id])->andWhere('status = 1 or status = 2')->one();
        $model['config'] = ChuyengiaConfig::findOne(['chuyengia_id' => $id]);

        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }

        if($request->isPost && $model['config']->load($request->post()) && $model['config']->save()){
            if($model['chuyengia']->status == 1){
                return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/view').'?id='.$model['chuyengia']->id_chuyengia);
            } else {
                return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/preview').'?id='.$model['chuyengia']->id_chuyengia);
            }
        }
        if($model['chuyengia']->status == 1){
            $model['controller'] = 'chuyengia';
        } else {
            $model['controller'] = 'pdkchuyengia';
        }
        return $this->render('congbo', [
            'model' => $model,
        ]);
    }

    public function actionExport($id) {
        $request = Yii::$app->request;
        $model = Chuyengia::find()->with('donvi', 'hocham', 'hocvi', 'chuyengiaChuyennganhs', 'chuyengiaChuyennganhs.cap3', 'chuyengiaLinhvucs', 'chuyengiaLinhvucs.cap1')->where(['id_chuyengia' => $id])->one();
        return $this->renderPartial('export', [
            'model' => $model,
        ]);
    }

    public function actionExportexcel() {
        $request = Yii::$app->request;
        $search = new SearchChuyengia();
        $search->load($request->post());
//        DebugService::dumpdie($search);
        date_default_timezone_set('Asia/Ho_chi_minh');
        $style_header = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(20)
            ->setFontColor(Color::BLACK)->setFontName('Times New Roman')
            ->build();
        $style = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(15)
            ->setFontColor(Color::BLACK)->setFontName('Times New Roman')
            ->build();
        date_default_timezone_set('Asia/Ho_chi_minh');
        $data = VExportChuyengia::find()->select("
            rownum,
            ho_ten,
            nam_sinh,
            gioi_tinh,
            ten_hh,
            nam_hocham,
            ten_hv,
            nam_hocvi,
            linhvuc,
            chuyennganh,
            congviec_hiennay,
            chucvu_hientai,
            diachi_nharieng,
            dien_thoai,
            email,
            ten_donvi

            ")
            ->where(($search->ho_ten == null) ? '1=1' : "upper(ho_ten) like '%".mb_strtoupper($search->ho_ten)."%'")
            ->orWhere(($search->ho_ten == null) ? '1=1' : "upper(ten_khongdau) like '%".mb_strtoupper($search->ho_ten)."%'")
//            ->andWhere(($search->so_nha == null) ? '1=1' : "so_nha like '%".$search->so_nha."%'")
//            ->andWhere(($search->nguoi_thue == null) ? '1=1' : "nguoi_thue like '%".mb_strtoupper($search->nguoi_thue)."%'")
//            ->andWhere(($search->ten_duong == null) ? '1=1' : "tenduong = ".$search->ten_duong)
//            ->andWhere(($search->ma_phuong == null) ? '1=1' : "ma_phuong like '".$search->ma_phuong."'")
//            ->andWhere(($search->thoi_han_thue == null) ? '1=1' : "thoi_han_thue = ".$search->thoi_han_thue)
            ->andWhere(($search->donvi_id == null) ? '1=1' : "donvi_id = ".$search->donvi_id)
            ->andWhere(($search->hocham_id == null) ? '1=1' : "hocham_id = ".$search->hocham_id)
            ->andWhere(($search->hocvi_id == null) ? '1=1' : "hocvi_id = ".$search->hocvi_id)
//            ->orderBy('stt, id_loainha asc, ten_duong, so_luu_kho,stt_can')
            ->asArray()
            ->all();
//DebugService::dumpdie($data);
        $writer = WriterFactory::create(Type::XLSX);
        $writer->openToBrowser('DanhSachChuyenGia_' . date('dmY_His') . '.xlsx');

        $writer->addRowWithStyle(["Danh sách chuyên gia " . date('dmY_His')], $style_header);
        $writer->addRow([]);
        $writer->addRowWithStyle(['STT', 'Họ tên', 'Năm sinh', 'Giới tính', 'Học hàm', 'Năm được phong', 'Học vị', 'Năm đạt được', 'Lĩnh vực', 'Chuyên ngành', 'Công việc hiện nay', 'Chức vụ hiện nay', 'Địa chỉ nhà riêng', 'Điện thoại', 'Email', 'Đơn vị'], $style);
        $writer->addRows($data);
        $writer->close();
    }
}

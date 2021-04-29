<?php

namespace app\modules\quanly\controllers;

use app\modules\danhmuc\models\loainha\Loainha;
use app\modules\danhmuc\models\phuong\Phuong;
use app\modules\quanly\models\can\SearchCanThanhly;
use app\models\TaiLieu;
use app\modules\quanly\base\AbstractController;
use app\modules\quanly\models\can\ThongTinCan;
use app\modules\quanly\models\can\SearchCan;
use app\modules\quanly\models\ho\ThongTinHo;
use app\models\VCan;
use app\modules\quanly\models\VDuong;
use app\services\DebugService;
use app\services\UtilityService;
use app\services\UtilService;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\WriterFactory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\Response;

class CanController extends AbstractController
{

    public $const;

    public function init()
    {
        $this->const = [
            'title' => 'Căn',
            'actions' => [
                'index' => [
                    'label' => 'Danh sách',
                    'url' => 'index',
                ],
                'create' => [
                    'label' => 'Thêm mới',
                    'url' => 'create',
                ],
                'update' => [
                    'label' => 'Cập nhật thông tin',
                    'url' => 'update',
                ],
                'view' => [
                    'label' => 'Thông tin chi tiết',
                    'url' => 'view',
                ],
                'statistic' => [
                    'label' => 'Thống kê',
                    'url' => 'statistic',
                ],
                'map' => [
                    'label' => 'Cập nhật vị trí',
                    'url' => 'map',
                ],
                'file' => [
                    'label' => 'Tài liệu',
                    'url' => 'file',
                ],
            ],
        ];
        parent::init();
    }

    public function actionIndex($sonha = null, $tenduong = null, $phuong = null, $loainha = null)
    {
        $request = Yii::$app->request;

        $model['search'] = new SearchCan();
        $queryParams['SearchCan']['so_nha'] = $sonha;
        $queryParams['SearchCan']['ten_duong'] = $tenduong;
        $queryParams['SearchCan']['ma_phuong'] = $phuong;
        $queryParams['SearchCan']['id_loainha'] = $loainha;

        $search = $model['search']->search($queryParams);

        $model['dataProvider'] = $search['dataProvider'];
        $model['total'] = $search['total'];
        $model['duong'] = VDuong::find()->all();
        $model['ranh_phuong'] = Phuong::find()->orderBy('stt')->all();
        $model['dm_loainha'] = Loainha::find()->all();

        if ($request->isPost) {
            $model['search']->load($request->post());
            $url = Yii::$app->urlManager->createUrl([
                'quan-ly/can/index',
                'sonha' => $model['search']->so_nha,
                'tenduong' => $model['search']->ten_duong,
                'phuong' => $model['search']->ma_phuong,
                'loainha' => $model['search']->id_loainha,
                ]);
            return $this->redirect($url);
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionView($id = null)
    {
        $this->layout = "@app/modules/quanly/views/layouts/main";

        if (!UtilService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        $model['can'] = ThongTinCan::find()->joinWith('phuong')->where(['thong_tin_can.id_can' => $id])->one();
        if ($model['can'] == null) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }

        $model['danhsachho'] = new ActiveDataProvider([
            'query' => ThongTinHo::find()->joinWith('thongtincan')->where(['thong_tin_ho.status' => 1,'thong_tin_ho.da_ban' => false, 'thong_tin_ho.id_can' => $id])
        ]);

        return $this->render('view', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionFile($id = null){
        $this->layout = "@app/modules/quanly/views/layouts/main";

        if (!UtilService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        $model['can'] = VCan::findOne($id);
        if ($model['can'] == null) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }

        $model['tailieu'] = new ActiveDataProvider([
            'query' => TaiLieu::find()->joinWith('ho')->joinWith('ho.hopdong')->where(['thong_tin_ho.status' => 1, 'thong_tin_ho.id_can' => $id]),
        ]);

        return $this->render('file', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionMap($id = null){
        $this->layout = "@app/modules/quanly/views/layouts/main";
        $request = Yii::$app->request;
        $model = (new Query())->select('st_x(geom) as geo_x, st_y(geom) as geo_y')
            ->from('thong_tin_can')
            ->where(['id_can' => $id])
            ->one();
        $model['fulldiachi'] = ThongTinCan::findOne($id)->fulldiachi;
        $model['id'] = $id;
        if($request->isPost){
            $post = $request->post();
            $query = "update thong_tin_can set geom = ST_GeomFromText('POINT(" . $post['geo_x'] . " " . $post['geo_y'] . ")') where id_can = " . $id;
            $connection = Yii::$app->getDb();
            $command = $connection->createCommand($query);
            $command->query();
            $connection->close();
            return $this->redirect(Yii::$app->urlManager->createUrl(['quan-ly/can/view','id' => $id]));
        }

        return $this->render('map',[
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model['can'] = new ThongTinCan();
        $model['ranh_phuong'] = Phuong::find()->orderBy('stt')->all();
        $model['dm_loainha'] = Loainha::find()->all();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Thêm mới Căn</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Thêm mới',['class'=>'btn btn-success pull-left','type'=>"submit"])

                ];
            }else if($model['can']->load($request->post()) && $model['can']->saveModel()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "<b>Thêm mới Căn</b>",
                    'content'=>'<span class="text-success">Thêm mới Căn nhà thành công</span>',
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::a('Tiếp tục thêm mới',['create'],['class'=>'btn btn-success pull-left','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "<b>Thêm mới Căn</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Thêm mới',['class'=>'btn btn-success pull-left','type'=>"submit"])

                ];
            }
        } else {
            if($model['can']->load($request->post()) && $model['can']->saveModel()){
                return $this->redirect(['view','id' => $model['can']->id_can]);
            }else{
                return $this->render('create',[
                    'model' => $model
                ]);
            }
        }
    }

    public function actionUpdate($id = null)
    {
        $request = Yii::$app->request;
        if (!UtilService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        $model['can'] = ThongTinCan::findOne($id);
        if ($model['can'] == null) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        $model['ranh_phuong'] = Phuong::find()->orderBy('stt')->all();
        $model['dm_loainha'] = Loainha::find()->all();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Cập nhật Căn</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Cập nhật',['class'=>'btn btn-warning pull-left','type'=>"submit"])

                ];
            }else if($model['can']->load($request->post()) && $model['can']->save()){
                date_default_timezone_set('Asia/Ho_chi_minh');
                $model['can']->updated_by = Yii::$app->user->id;
                $model['can']->updated_at = date('Y-m-d H:i:s');
                $model['can']->save();

                return [
                    'redirect'=>Yii::$app->urlManager->createUrl(['quan-ly/can/view','id' => $id]),
                    'title'=> "<b>Cập nhật Căn</b>",
                    'content'=>'<span class="text-success">Cập nhật căn nhà thành công</span>',
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"])
                ];
            }else{
                return [
                    'title'=> "<b>Cập nhật Căn</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Thêm mới',['class'=>'btn btn-warning pull-left','type'=>"submit"])

                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_capnha]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionDelete($id = null)
    {
        $request = Yii::$app->request;
        $model = ThongTinCan::findOne($id);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Xóa căn</b>",
                    'content'=>$this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Xóa',['class'=>'btn btn-danger pull-left','type'=>"submit"])

                ];
            }else if($model->deleteModel()){
                return [
                    'redirect'=>Yii::$app->urlManager->createUrl(['quan-ly/can/index']),
                    'title'=> "<b>Xóa Căn</b>",
                    'content'=>'<span class="text-success">Xóa căn nhà thành công</span>',
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"])
                ];
            }else{
                return [
                    'title'=> "<b>Xóa căn</b>",
                    'content'=>$this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Xóa',['class'=>'btn btn-danger pull-left','type'=>"submit"])

                ];
            }
        }
    }

    public function actionExport()
    {
        $request = Yii::$app->request;
        $queryParams = $request->queryParams;
        if(!isset($queryParams['sonha'])){$queryParams['sonha'] = null;}
        if(!isset($queryParams['phuong'])){$queryParams['phuong'] = null;}
        if(!isset($queryParams['tenduong'])){$queryParams['tenduong'] = null;}
        if(!isset($queryParams['loainha'])){$queryParams['loainha'] = null;}
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

        $thongtincan = ThongTinCan::find()->with('thongTinHos', 'thongTinHos.hopdong', 'phuong', 'loainha')->where(['thong_tin_can.status' => 1])
            ->andFilterWhere(['like', 'upper(so_nha)', mb_strtoupper($queryParams['sonha'])])
            ->andFilterWhere(['like', 'upper(ma_phuong)', mb_strtoupper($queryParams['phuong'])])
            ->andFilterWhere(['like', 'upper(tenduong)', mb_strtoupper($queryParams['tenduong'])])
            ->andFilterWhere(["id_loainha" => $queryParams['loainha']])
            ->orderBy('stt_phuong,id_loainha,stt_can')
            ->all();
        $data = [];
        $stt = 1;
        foreach ($thongtincan as $i => $can) {

            foreach ($can->thongTinHos as $k => $ho) {
//                if($stt == 472){
//                    DebugService::dumpdie($i+1);
//                    DebugService::dumpdie(array_search($i+1,$data));
//                }
                $data[$stt]['stt'] = $stt;
                $data[$stt]['stt_can'] = (in_array($i + 1, array_column($data, 'stt_can'))) ? '' : $i + 1;
                $data[$stt]['stt_ho'] = $stt;
                $data[$stt]['so_luu_kho'] = $ho->so_luu_kho;
                $data[$stt]['so_nha'] = $can->so_nha;
                $data[$stt]['ten_duong'] = $can->ten_duong;
                $data[$stt]['ten_phuong'] = $can->phuong->tenphuong;
                $data[$stt]['vi_tri'] = $ho->vi_tri;
                $data[$stt]['so_to_bd'] = $can->so_to_bd;
                $data[$stt]['so_thua'] = $can->so_thua;
                $data[$stt]['dien_tich_khuon_vien'] = $can->dien_tich_khuon_vien;
                $data[$stt]['dien_tich_su_dung'] = $ho->dien_tich_su_dung;
                $data[$stt]['nguoi_thue'] = ($ho->hopdong != null) ? $ho->hopdong->nguoi_thue : '';
                $data[$stt]['so_hop_dong'] = ($ho->hopdong != null) ? $ho->hopdong->so_hop_dong : '';
                $data[$stt]['thoi_han'] = ($ho->hopdong != null) ? $ho->hopdong->thoi_han_thue : '';
                $data[$stt]['ngay_het_han'] = ($ho->hopdong != null && $ho->hopdong->ngay_het_han != null) ? date('d-m-Y', strtotime($ho->hopdong->ngay_het_han)) : '';
                $data[$stt]['gia_thue'] = ($ho->hopdong != null) ? $ho->hopdong->gia_thue : '';
                $data[$stt]['gia_giam'] = ($ho->hopdong != null) ? $ho->hopdong->gia_giam : '';
                $data[$stt]['gia_phai_tra'] = ($ho->hopdong != null) ? $ho->hopdong->gia_phai_tra : '';
                $data[$stt]['ghi_chu'] = ($ho->hopdong != null) ? $ho->hopdong->ghi_chu : '';

                $stt++;
            }
        }
//        DebugService::dumpdie($data);
        $writerNha = WriterFactory::create(Type::XLSX);
        $writerNha->openToBrowser('DanhSachNhaDangQuanLy_' . date('dmY_His') . '.xlsx');
        $writerNha->addRowWithStyle(["Danh sách nhà " . date('dmY_His')], $style_header);
        $writerNha->addRow([]);
        $writerNha->addRowWithStyle(['STT', 'STT Căn', 'STT hộ', 'Số lưu kho', 'Số nhà', 'Tên đường', 'Tên phường', 'Vị trí', 'Số tờ bản đồ', 'Số thửa', 'Diện tích khuôn viên', 'Diện tích sử dụng', 'Người thuê', 'Số hợp đồng', 'Thời hạn thuê', 'Ngày hết hạn', 'Giá thuê', 'Giá giảm', 'Giá phải trả', 'Ghi chú'], $style);
        $writerNha->addRows($data);
        $writerNha->close();
    }

    public function actionTailieu($id)
    {
        if (!UtilService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        $model['can'] = VCan::findOne($id);
        if ($model['can'] == null) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }

        $model['tailieu'] = new ActiveDataProvider([
            'query' => TaiLieu::find()->joinWith('ho')->joinWith('ho.hopdong')->where(['thong_tin_ho.status' => 1, 'thong_tin_ho.id_can' => $id]),
        ]);
//        DebugService::dumpdie(TaiLieu::find()->joinWith('ho')->joinWith('ho.hopdong')->where(['thong_tin_ho.status' => 1, 'thong_tin_ho.id_can' => $id])->all());
        return $this->render('tailieu', [
            'model' => $model
        ]);
    }

    public function actionThanhly($id){
        $request = Yii::$app->request;

        $request = Yii::$app->request;
        if (!UtilService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        $model['can'] = ThongTinCan::findOne($id);
        if ($model['can'] == null) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        $model['ranh_phuong'] = Phuong::find()->orderBy('stt')->all();
        $model['dm_loainha'] = Loainha::find()->all();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Thanh lý căn</b>",
                    'content'=>$this->renderAjax('thanhly', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Thanh lý',['class'=>'btn btn-primary pull-left','type'=>"submit"])

                ];
            }else if($model['can']->load($request->post()) && $model['can']->save()){
                date_default_timezone_set('Asia/Ho_chi_minh');
                $model['can']->updated_by = Yii::$app->user->id;
                $model['can']->updated_at = date('Y-m-d H:i:s');
                $model['can']->save();

                return [
                    'redirect'=>Yii::$app->urlManager->createUrl(['quan-ly/can/view','id' => $id]),
                    'title'=> "<b>Cập nhật Căn</b>",
                    'content'=>'<span class="text-success">Cập nhật căn nhà thành công</span>',
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"])
                ];
            }else{
                return [
                    'title'=> "<b>Thanh lý căn</b>",
                    'content'=>$this->renderAjax('thanhly', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Thanh lý',['class'=>'btn btn-primary pull-left','type'=>"submit"])

                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_capnha]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

}

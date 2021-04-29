<?php

namespace app\modules\quanly\controllers;

use app\modules\quanly\base\Constants;
use app\modules\quanly\models\bangchiettinh\BangChietTinh;
use app\models\ConfigChothue;
use app\models\danhmuc\loainha\Loainha;
use app\models\danhmuc\miengiam\Miengiam;
use app\models\danhmuc\phuong\Phuong;
use app\models\danhmuc\quyetdinhtienthuenha\QuyetdinhTienthuenha;
use app\models\danhmuc\thoigianbotri\DmThoigianbotri;
use app\models\danhmuc\thoihan\Thoihan;
use app\models\GiaHan;
use app\modules\quanly\base\AbstractController;
use app\modules\quanly\models\hopdong\Hopdong;
use app\models\NguoiThue;
use app\models\RanhPhuong;
use app\modules\quanly\models\hopdong\SearchHopdong;
use app\modules\quanly\models\hopdong\SearchHopdongchuanhap;
use app\modules\quanly\models\hopdong\SearchHopdongconhan;
use app\modules\quanly\models\hopdong\SearchHopdonghethan;
use app\modules\quanly\models\hopdong\SearchHopdongkhongco;
use app\modules\quanly\models\hopdong\SearchHopdongsaphethan;
use app\modules\quanly\models\hopdong\SearchHopdongThanhly;
use app\modules\quanly\models\ho\ThongTinHo;
use app\modules\quanly\models\can\ThongTinCan;
use app\models\VCan;
use app\models\VDanhsachthuenha;
use app\modules\quanly\models\hopdong\VHopdongchuanhap;
use app\modules\quanly\models\hopdong\VHopdongconhan;
use app\modules\quanly\models\hopdong\VHopdongkhongco;
use app\modules\quanly\models\hopdong\VHopdongsaphethan;
use app\modules\quanly\models\VDuong;
use app\models\VHo;
use app\models\VHopdong;
use app\models\VHopdonghethan;
use app\services\DebugService;
use app\services\UtilityService;
use app\services\UtilService;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\WriterFactory;
use Yii;
use yii\helpers\Html;
use yii\web\Response;

class HopdongController extends AbstractController
{

    public $const;

    public function init()
    {
        $this->const = [
            'title' => 'Hợp đồng',
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

    public function actionIndex($sonha = null, $tenduong = null, $phuong = null, $loainha = null, $thoihanthue = null, $nguoithue = null, $sohopdong = null)
    {
        $request = Yii::$app->request;

        $model['search'] = new SearchHopdong();
        $queryParams['SearchHopdong']['so_nha'] = $sonha;
        $queryParams['SearchHopdong']['ten_duong'] = $tenduong;
        $queryParams['SearchHopdong']['ma_phuong'] = $phuong;
        $queryParams['SearchHopdong']['loainha'] = $loainha;
        $queryParams['SearchHopdong']['nguoi_thue'] = $nguoithue;
        $queryParams['SearchHopdong']['thoi_han_thue'] = $thoihanthue;
        $queryParams['SearchHopdong']['so_hop_dong'] = $sohopdong;

        $search = $model['search']->search($queryParams);

        $model['dataProvider'] = $search['dataProvider'];
        $model['total'] = $search['total'];
        $model['duong'] = VDuong::find()->all();
        $model['ranh_phuong'] = Phuong::find()->orderBy('stt')->all();
        $model['loainha'] = Loainha::find()->all();
        $model['thoihan'] = Thoihan::find()->where(['status' => 1])->orderBy('so_thang')->all();

        if ($request->isPost) {
            $model['search']->load($request->post());
            $url = Yii::$app->urlManager->createUrl([
                'quan-ly/hopdong/index',
                'sonha' => $model['search']->so_nha,
                'tenduong' => $model['search']->ten_duong,
                'phuong' => $model['search']->ma_phuong,
                'loainha' => $model['search']->loainha,
                'nguoithue' => $model['search']->nguoi_thue,
                'thoihanthue' => $model['search']->thoi_han_thue,
                'sohopdong' => $model['search']->so_hop_dong,
            ]);
            return $this->redirect($url);
        }
        return $this->render('index', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionConhan()
    {
        $request = Yii::$app->request;
        $model = $this->getHopDongTheoThoiHan(new SearchHopdongconhan(), $request->queryParams);

        if ($request->isPost) {
            $model['search']->load($request->post());
            return $this->redirect($this->getUrl('quan-ly/hopdong/conhan', $model['search']));
        }

        return $this->render('danhsach/conhan', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionSaphethan()
    {
        $request = Yii::$app->request;
        $model = $this->getHopDongTheoThoiHan(new SearchHopdongsaphethan(), $request->queryParams);

        if ($request->isPost) {
            $model['search']->load($request->post());
            return $this->redirect($this->getUrl('quan-ly/hopdong/saphethan', $model['search']));
        }

        return $this->render('danhsach/saphethan', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionHethan()
    {
        $request = Yii::$app->request;
        $model = $this->getHopDongTheoThoiHan(new SearchHopdonghethan(), $request->queryParams);

        if ($request->isPost) {
            $model['search']->load($request->post());
            return $this->redirect($this->getUrl('quan-ly/hopdong/hethan', $model['search']));
        }

        return $this->render('danhsach/hethan', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionChuanhap()
    {
        $request = Yii::$app->request;
        $model = $this->getHopDongTheoThoiHan(new SearchHopdongchuanhap(), $request->queryParams);

        if ($request->isPost) {
            $model['search']->load($request->post());
            return $this->redirect($this->getUrl('quan-ly/hopdong/chuanhap', $model['search']));
        }

        return $this->render('danhsach/chuanhap', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionKhongco()
    {
        $request = Yii::$app->request;
        $model = $this->getHopDongTheoThoiHan(new SearchHopdongkhongco(), $request->queryParams);

        if ($request->isPost) {
            $model['search']->load($request->post());
            return $this->redirect($this->getUrl('quan-ly/hopdong/khongco', $model['search']));
        }

        return $this->render('danhsach/khongco', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    private function getHopDongTheoThoiHan($searchModel, $queryParams)
    {
        $queryParams[$searchModel->searchModelName()]['so_nha'] = isset($queryParams['sonha']) ? $queryParams['sonha'] : null;
        $queryParams[$searchModel->searchModelName()]['ten_duong'] = isset($queryParams['tenduong']) ? $queryParams['tenduong'] : null;
        $queryParams[$searchModel->searchModelName()]['ma_phuong'] = isset($queryParams['phuong']) ? $queryParams['phuong'] : null;
        $queryParams[$searchModel->searchModelName()]['id_loainha'] = isset($queryParams['loainha']) ? $queryParams['loainha'] : null;
        $queryParams[$searchModel->searchModelName()]['nguoi_thue'] = isset($queryParams['nguoithue']) ? $queryParams['nguoithue'] : null;
        $queryParams[$searchModel->searchModelName()]['thoi_han_thue'] = isset($queryParams['thoihanthue']) ? $queryParams['thoihanthue'] : null;
        $queryParams[$searchModel->searchModelName()]['so_hop_dong'] = isset($queryParams['sohopdong']) ? $queryParams['sohopdong'] : null;

        $search = $searchModel->search($queryParams);
        $model['search'] = $searchModel;
        $model['dataProvider'] = $search;
        $model['duong'] = VDuong::find()->all();
        $model['ranh_phuong'] = Phuong::find()->orderBy('stt')->all();
        $model['loainha'] = Loainha::find()->all();
        $model['thoihan'] = Thoihan::find()->where(['status' => 1])->orderBy('so_thang')->all();
        return $model;
    }

    private function getUrl($urlText, $searchModel){
        $url = Yii::$app->urlManager->createUrl([
            $urlText,
            'sonha' => $searchModel->so_nha,
            'tenduong' => $searchModel->ten_duong,
            'phuong' => $searchModel->ma_phuong,
            'loainha' => $searchModel->id_loainha,
            'nguoithue' => $searchModel->nguoi_thue,
            'thoihanthue' => $searchModel->thoi_han_thue,
            'sohopdong' => $searchModel->so_hop_dong,
        ]);
        return $url;
    }

    public function actionThanhly($sonha = null, $tenduong = null, $phuong = null, $loainha = null, $thoihanthue = null, $nguoithue = null, $sohopdong = null)
    {
        $request = Yii::$app->request;

        $model['search'] = new SearchHopdongThanhly();
        $queryParams['SearchHopdongThanhly']['so_nha'] = $sonha;
        $queryParams['SearchHopdongThanhly']['ten_duong'] = $tenduong;
        $queryParams['SearchHopdongThanhly']['ma_phuong'] = $phuong;
        $queryParams['SearchHopdongThanhly']['loainha'] = $loainha;
        $queryParams['SearchHopdongThanhly']['nguoi_thue'] = $nguoithue;
        $queryParams['SearchHopdongThanhly']['thoi_han_thue'] = $thoihanthue;
        $queryParams['SearchHopdongThanhly']['so_hop_dong'] = $sohopdong;

        $search = $model['search']->search($queryParams);

        $model['dataProvider'] = $search['dataProvider'];
        $model['total'] = $search['total'];
        $model['duong'] = VDuong::find()->all();
        $model['ranh_phuong'] = Phuong::find()->orderBy('stt')->all();
        $model['loainha'] = Loainha::find()->all();
        $model['thoihan'] = Thoihan::find()->where(['status' => 1])->orderBy('so_thang')->all();

        if ($request->isPost) {
            $model['search']->load($request->post());
            $url = Yii::$app->urlManager->createUrl([
                'quan-ly/hopdong/thanhly',
                'sonha' => $model['search']->so_nha,
                'tenduong' => $model['search']->ten_duong,
                'phuong' => $model['search']->ma_phuong,
                'loainha' => $model['search']->loainha,
                'nguoithue' => $model['search']->nguoi_thue,
                'thoihanthue' => $model['search']->thoi_han_thue,
                'sohopdong' => $model['search']->so_hop_dong,
            ]);
            return $this->redirect($url);
        }
        return $this->render('thanhly', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionCreate($id = null)
    {
        $request = Yii::$app->request;
        if (!UtilService::paramValidate($id) || $ho = ThongTinHo::findOne(['id_ho' => $id, 'status' => 1]) == null) {
            return $this->render('notfound');
        }
        $model['ho'] = ThongTinHo::findOne(['id_ho' => $id, 'status' => 1]);

        $model['hopdong'] = Hopdong::findOne(['id_ho' => $id, 'status' => Constants::STATUS_TEMP]);
        if ($model['hopdong'] == null) {
            $model['hopdong'] = new Hopdong();
            $model['hopdong']->id_ho = $id;
            $model['hopdong']->status = Constants::STATUS_TEMP;
            $model['hopdong']->save(false);
        }



        $model['can'] = $model['ho']->thongtincan;
        $model['config'] = ConfigChothue::findOne(['id_config' => 1]);
        $model['bangchiettinh'] = new BangChietTinh();
        $model['quyetdinh'] = QuyetdinhTienthuenha::find()->where(['status' => 1])->orderBy('ngay_quyetdinh')->all();
        $model['thoihan'] = Thoihan::find()->where(['status' => 1])->orderBy('so_thang')->all();
        $model['miengiam'] = Miengiam::find()->where(['status' => 1])->orderBy('muc_giam')->all();

        if ($request->isPost && $model['hopdong']->load($request->post()) && $model['hopdong']->saveModel($model['ho'])) {
            return $this->redirect(Yii::$app->urlManager->createUrl(['quan-ly/hopdong/view','id' => $model['hopdong']->id_hopdong]));
        }

        return $this->render('create', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionView($id = null)
    {
        $request = Yii::$app->request;
        if (!UtilService::paramValidate($id) || $hopdong = Hopdong::findOne(['id_hopdong' => $id, 'status' => 1]) == null) {
            return $this->render('notfound');
        }

        $model['hopdong'] = Hopdong::find()->where(['id_hopdong' => $id, 'status' => 1])->one();
        $model['config'] = ConfigChothue::findOne(['id_config' => 1]);
        $model['can'] = $model['hopdong']->thongtinho->thongtincan;

        $ngayhethan = date('Y-m-d',strtotime(str_replace('/','-',$model['hopdong']->ngay_het_han)));

        if($ngayhethan < date('Y-m-d')){
            $model['hethan'] = true;
        } else {
            $model['hethan'] = false;
        }

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return [
                'title'=> "Chi tiết hợp đồng",
                'content'=>$this->renderAjax('view_ajax', [
                    'model' => $model,
                    'const' => $this->const,
                ]),
                'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"])
            ];
        }

        return $this->render('view', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionUpdate($id = null)
    {
        $request = Yii::$app->request;

        $model['hopdong'] = Hopdong::findOne($id);
        $model['thoihan'] = Thoihan::find()->where(['status' => 1])->orderBy('so_thang')->all();

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật hợp đồng",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Lưu',['class'=>'btn btn-primary pull-left','type'=>"submit"])
                ];
            }else if($request->isPost && $model['hopdong']->load($request->post()) && $model['hopdong']->saveModel()){
                return [
                    'redirect'=> Yii::$app->urlManager->createUrl(['quan-ly/hopdong/view','id' => $id]),
                ];
            }else{
                return [
                    'title'=> "Cập nhật hợp đồng",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Lưu',['class'=>'btn btn-primary pull-left','type'=>"submit"])
                ];
            }

        }
    }

    public function actionExhopdong()
    {
        $get = Yii::$app->request->get();
        $hopdong = HopDong::findOne(['id_hopdong' => $get['id_hopdong']]);
        $vho = VHo::findOne(['id_ho' => $hopdong->id_ho]);
        $config = ConfigChothue::findOne(['id_config' => 1]);
        return $this->renderPartial('exhopdong', ['hopdong' => $hopdong, 'vho' => $vho, 'config' => $config]);
    }


    public function actionExphuluc()
    {
        $get = Yii::$app->request->get();
        $hopdong = HopDong::findOne(['id_hopdong' => $get['id_hopdong']]);
        $dsthuenha = NguoiThue::find()->where(['id_hopdong' => $get['id_hopdong']])->all();
        return $this->renderPartial('exphuluc', ['hopdong' => $hopdong, 'dsthuenha' => $dsthuenha]);
    }

    public function roundSotien($sotien)
    {
        $a = abs(round($sotien / 1000) - $sotien / 1000);
        if ($a <= 0.25) {
            return round($sotien / 1000) * 1000;
        } else {
            return floor($sotien / 1000) * 1000 + 0.5 * 1000;
        }
    }

    public function actionThanhlyhopdong()
    {
        $request = Yii::$app->request;
        $get = $request->get();
        $hopdong = HopDong::findOne(['id_hopdong' => $get['id_hopdong']]);
        $config = ConfigChothue::findOne(['id_config' => 1]);
        $vho = VHo::findOne(['id_ho' => $hopdong->id_ho]);
        if ($request->isPost) {
            $hopdong->thanh_ly = 1;
            $hopdong->ngay_thanh_ly = $request->post()['ngay_thanh_ly'];
            $hopdong->save();
            return $this->redirect($request->referrer);
        }
        return $this->renderPartial('thanhlyhopdong', [
            'hopdong' => $hopdong,
            'config' => $config,
            'vho' => $vho,
        ]);
    }

    public function actionXuatfile()
    {
        $request = Yii::$app->request;
        if ($request->isGet) {
            $get = $request->get();
            $hopdong = HopDong::findOne(['id_hopdong' => $get['id_hopdong']]);
            $config = ConfigChothue::findOne(['id_config' => 1]);
            $vho = VHo::findOne(['id_ho' => $hopdong->id_ho]);

            return $this->render('xuatfile', ['hopdong' => $hopdong, 'vho' => $vho]);
        }
    }

    public function actionThemhothue()
    {
        $request = Yii::$app->request;
        if ($request->isGet) {
            $get = $request->get();
            if ($get == null) {
                return $this->redirect(Yii::$app->homeUrl . Yii::getAlias('danh-sach-nha-o'));
            } else {
                $can = ThongTinCan::findOne(['id_can' => $get['id_can']]);
                return $this->render('laphopdong', ['can' => $can]);
            }
        }
    }

    public function actionCreatebctnhaxuong()
    {
        $request = Yii::$app->request;
        if ($request->isGet) {
            $get = $request->get();
            if ($get == null) {
                return $this->redirect(Yii::$app->homeUrl . Yii::getAlias('danh-sach-nha'));
            }
            if (!isset($get['id_can']) || $get['id_can'] == null) {
                return $this->redirect(Yii::$app->homeUrl . Yii::getAlias('danh-sach-nha'));
            }
            $can = VCan::findOne(['id_can' => $get['id_can']]);
            if ($can == null || $can->id_loainha == 1 || $can->id_loainha == 2 || $can->id_loainha == 3) {
                return $this->redirect(Yii::$app->homeUrl . Yii::getAlias('danh-sach-nha'));
            }

            return $this->render('createbctnhaxuong', [
                'can' => $can,
            ]);
        }
        if ($request->isPost) {
            $post = $request->post();

            DebugService::dumpdie($post);
            $ho = new ThongTinHo();
            $ho->id_can = $post['id_can'];
            $ho->save();

            $post['bct']['id_ho'] = $ho->id_ho;
            $post['bct']['gia_dat'] = str_replace(',', '', $post['bct']['gia_dat']);
            $post['bct']['gia_thue_nha'] = str_replace(',', '', $post['bct']['gia_thue_nha']);
            $bct = new BangChietTinh();
            $bct->load($post, 'bct');
            if ($bct->validate()) {
                $bct->save();
                return $this->redirect(Yii::$app->homeUrl . Yii::getAlias('lap-hop-dong'));
            } else {
                DebugService::dumpdie($bct->getErrors());
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
        if(!isset($queryParams['sohopdong'])){$queryParams['sohopdong'] = null;}
        if(!isset($queryParams['nguoithue'])){$queryParams['nguoithue'] = null;}
        if(!isset($queryParams['thoihanthue'])){$queryParams['thoihanthue'] = null;}
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

        if(!isset($queryParams['q'])){
            $query = VHopdong::find();
            $title = 'Danh sách hợp đồng';
        } else {
            if($queryParams['q'] == 'saphethan'){
                $query = VHopdongsaphethan::find();
                $title = 'Danh sách hợp đồng sắp hết hạn';
            }elseif($queryParams['q'] == 'hethan'){
                $query = VHopdonghethan::find();
                $title = 'Danh sách hợp đồng hết hạn';
            }elseif($queryParams['q'] == 'conhan'){
                $query = VHopdongconhan::find();
                $title = 'Danh sách hợp đồng còn hạn';
            }elseif($queryParams['q'] == 'khongco'){
                $query = VHopdongkhongco::find();
                $title = 'Danh sách hợp đồng không có';
            }elseif($queryParams['q'] == 'chuanhap'){
                $query = VHopdongchuanhap::find();
                $title = 'Danh sách hợp đồng chưa nhập';
            } else {
                $query = VHopdong::find();
                $title = 'Danh sách hợp đồng';
            }
        }
        $query->select("
           rownum,
            so_nha,
            ten_duong,
            tenphuong,
            ten_loainha,
            cap_nha,
            dien_tich_su_dung,
            nguoi_thue,
            so_hop_dong,
            gia_thue,
            gia_giam,
            gia_phai_tra,
            thoi_han_thue,
            ngay_ki,
            ngay_het_han,
            ghi_chu")
            ->where(['thanh_ly' => 0])
            ->andFilterWhere(['like', 'upper(so_nha)', mb_strtoupper($queryParams['sonha'])])
            ->andFilterWhere(['like', 'upper(ten_duong)', mb_strtoupper($queryParams['tenduong'])])
            ->andFilterWhere(['like', 'upper(so_hop_dong)', mb_strtoupper($queryParams['sohopdong'])])
            ->andFilterWhere(['like', 'upper(nguoi_thue)', mb_strtoupper($queryParams['nguoithue'])])
            ->andFilterWhere(['like', 'upper(ma_phuong)', mb_strtoupper($queryParams['phuong'])])
            ->andFilterWhere(['thoi_han_thue' => $queryParams['thoihanthue']])
            ->andFilterWhere(['id_loainha' => $queryParams['loainha']])
            ->orderBy('stt, id_loainha asc, ten_duong,stt_can')
            ->asArray()
            ;
//DebugService::dumpdie($data->all());
        $writer = WriterFactory::create(Type::XLSX);
        $writer->openToBrowser('DanhSachHopDong_' . date('dmY_His') . '.xlsx');

        $writer->addRowWithStyle(["$title" . date('dmY_His')], $style_header);
        $writer->addRow([]);
        $writer->addRowWithStyle(['STT', 'Số nhà', 'Tên đường', 'Tên phường', 'Loại nhà', 'Cấp nhà', 'Diện tích sử dụng', 'Người thuê', 'Số hợp đồng', 'Giá thuê', 'Giá giảm', 'Giá trả', 'Thời hạn thuê', 'Ngày ký', 'Ngày hết hạn', 'Ghi chú'], $style);
        $writer->addRows($query->all());
        $writer->close();

    }

    public function actionDelete($id)
    {
        $request = Yii::$app->request;

        $model['hopdong'] = Hopdong::findOne($id);
        $id_ho = $model['hopdong']->id_ho;

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Xóa hợp đồng",
                    'content'=>$this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Xóa',['class'=>'btn btn-danger pull-left','type'=>"submit"])
                ];
            }else if($request->isPost && $model['hopdong']->deleteModel()){
                return [
                    'redirect'=> Yii::$app->urlManager->createUrl(['quan-ly/ho/view','id' => $id_ho]),
                ];
            }else{
                return [
                    'title'=> "Xóa hợp đồng",
                    'content'=>$this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Xóa',['class'=>'btn btn-danger pull-left','type'=>"submit"])
                ];
            }
        }

        if (!UtilityService::paramValidate($id)) {
            return $this->redirect($request->referrer);
        }

        $model['hopdong'] = HopDong::find()->with('khoanThus', 'soThus')->where(['id_hopdong' => $id])->one();
        $model['ho'] = ThongTinHo::findOne($model['hopdong']->id_ho);
        if ($request->isPost) {
            $model['hopdong']->so_hop_dong = 'a';
            $model['hopdong']->status = 0;
            $model['hopdong']->updated_by = Yii::$app->user->id;
            $model['hopdong']->updated_at = date('Y-m-d H:i:s');
            $model['hopdong']->validate();
            if ($model['hopdong']->validate()) {
                $model['hopdong']->save();
                $model['ho']->nguoi_thue = '';
                $model['ho']->updated_by = Yii::$app->user->id;
                $model['ho']->updated_at = date('Y-m-d H:i:s');
                $model['ho']->save();
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                DebugService::dumpdie($model['hopdong']->getErrors());
            }
        }

        return $this->renderPartial('delete', [
            'model' => $model,
        ]);
    }

    public function actionExword($id = null){

    }

}

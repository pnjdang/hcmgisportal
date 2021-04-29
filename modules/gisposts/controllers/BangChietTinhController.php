<?php

namespace app\modules\quanly\controllers;

use app\modules\quanly\models\bangchiettinh\BangChietTinh;
use app\modules\quanly\models\bangchiettinh\BctNhao;
use app\modules\quanly\models\hopdong\Hopdong;
use app\models\ConfigChothue;
use app\models\danhmuc\loainha\Loainha;
use app\models\danhmuc\miengiam\Miengiam;
use app\models\danhmuc\phuong\Phuong;
use app\models\danhmuc\quyetdinhtienthuenha\QuyetdinhTienthuenha;
use app\models\danhmuc\thoigianbotri\DmThoigianbotri;
use app\models\danhmuc\thoihan\Thoihan;
use app\models\GiaHan;
use app\modules\quanly\base\AbstractController;
use app\models\NguoiThue;
use app\models\RanhPhuong;
use app\models\SearchHopdong;
use app\models\SearchHopdongchuanhap;
use app\models\SearchHopdongconhan;
use app\models\SearchHopdonghethan;
use app\models\SearchHopdongkhongco;
use app\models\SearchHopdongsaphethan;
use app\models\SearchHopdongThanhly;
use app\modules\quanly\models\ThongTinHo;
use app\models\VCan;
use app\models\VDanhsachthuenha;
use app\models\VDuong;
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

class BangChietTinhController extends AbstractController
{

    public $const;

    public function init()
    {
        $this->const = [
            'title' => 'Bảng chiết tính',
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

    public function actionIndex()
    {
        $request = Yii::$app->request;

        $model['search'] = new SearchHopdong();
        $search = $model['search']->search($request->queryParams);
        $model['dataProvider'] = $search['dataProvider'];
        $model['total'] = $search['total'];
        $model['duong'] = VDuong::find()->all();
        $model['ranh_phuong'] = Phuong::find()->where(['status' => 1])->orderBy('stt')->all();
        $model['loainha'] = Loainha::find()->where(['status' => 1])->orderBy('id_loainha')->all();
        $model['thoihan'] = Thoihan::find()->where(['status' => 1])->orderBy('so_thang')->all();
        if ($request->isPost) {
            $model['search']->load($request->post());
            $url = Yii::$app->urlManager->createUrl('hopdong/index');
            $url .= '?SearchHopdong[so_hop_dong]=' . $model['search']->so_hop_dong;
            $url .= '&SearchHopdong[nguoi_thue]=' . $model['search']->nguoi_thue;
            $url .= '&SearchHopdong[so_nha]=' . $model['search']->so_nha;
            $url .= '&SearchHopdong[ten_duong]=' . $model['search']->ten_duong;
            $url .= '&SearchHopdong[ma_phuong]=' . $model['search']->ma_phuong;
            $url .= '&SearchHopdong[thoi_han_thue]=' . $model['search']->thoi_han_thue;
            $url .= '&SearchHopdong[loainha]=' . $model['search']->loainha;
            return $this->redirect($url);
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionCreate($id = null)
    {
        $request = Yii::$app->request;

        $model['bangchiettinh'] = new BangChietTinh();
        $model['hopdong'] = Hopdong::findOne($id);
        $model['fulldiachi'] = $model['hopdong']->thongtinho->thongtincan->fulldiachi;
        $model['thoigianbotri'] = DmThoigianbotri::find()->orderBy('he_so')->indexBy('id_thoigianbotri')->all();
        $model['miengiam'] = Miengiam::find()->where(['status' => 1])->orderBy('muc_giam')->indexBy('id_miengiam')->all();
        $model['quyetdinh'] = QuyetdinhTienthuenha::find()->where(['status' => 1])->orderBy('ngay_quyetdinh')->all();

        $loainha = $model['hopdong']->thongtinho->thongtincan->id_loainha;
        if($loainha == 1 || $loainha == 2 || $loainha == 3){
            $model['bctnhaos'] = [new BctNhao()];
        }

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Lập bảng chiết tính",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Lưu', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])

                ];
            } else if ($model['bangchiettinh']->load($request->post()) && $model['bangchiettinh']->save()) {
                $model['hopdong']->id_bct = $model['bangchiettinh']->id_bangchiettinh;
                $model['hopdong']->nguoi_thue = $model['bangchiettinh']->nguoi_thue;
                $model['hopdong']->save(false);
                return [
                    'redirect' => Yii::$app->urlManager->createUrl(['quan-ly/hopdong/create','id' => $model['hopdong']->id_ho]),
                ];
            } else {
                return [
                    'title' => "Thêm mới hộ",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Lưu', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])

                ];
            }
        }

//        if (!UtilService::paramValidate($id)) {
//            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
//        }
//        $model['ho'] = ThongTinHo::find()->with(['thongtincan','thongtincan.phuong'])->where(['id_ho' => $id])->one();
//        $model['can'] = $model['ho']->thongtincan;
//        if ($model['ho'] == null) {
//            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
//        }
//        $model['config'] = ConfigChothue::findOne(['id_config' => 1]);
//        $model['hopdong'] = new HopDong();
//        $model['bangchiettinh'] = new BangChietTinh();
//        $model['quyetdinh'] = QuyetdinhTienthuenha::find()->where(['status' => 1])->orderBy('ngay_quyetdinh')->all();
//        $model['thoihan'] = Thoihan::find()->where(['status' => 1])->orderBy('so_thang')->all();
//        $model['miengiam'] = Miengiam::find()->where(['status' => 1])->orderBy('muc_giam')->all();
//
//        if ($request->isPost) {
//            \date_default_timezone_set('Asia/Ho_chi_minh');
//            $post = $request->post();
//            $model['hopdong']->load($post);
//            $model['ho'] = new ThongTinHo();
//            $model['ho']->id_can = $model['can']->id_can;
//            $model['ho']->status = 1;
//            $model['ho']->save();
//            $model['hopdong']->ngay_het_han = date('Y-m-d', strtotime(date('Y-m-d', strtotime($model['hopdong']->ngay_bat_dau)) . " +" . $model['hopdong']->thoi_han_thue . " month"));
//            $model['hopdong']->status = 1;
//            $model['hopdong']->created_by = Yii::$app->user->id;
//            $model['hopdong']->created_at = date('Y-m-d H:i:s');
//            $model['hopdong']->id_ho = $model['ho']->id_ho;
//            $model['hopdong']->save();
//
//            $model['bangchiettinh']->load($request->post());
//            $model['bangchiettinh']->created_by = Yii::$app->user->id;
//            $model['bangchiettinh']->created_at = date('Y-m-d H:i:s');
//            $model['bangchiettinh']->dien_tich = $model['ho']->dien_tich_su_dung;
//            $model['bangchiettinh']->status = 1;
//            $model['bangchiettinh']->save();
//            return $this->redirect(Yii::$app->urlManager->createUrl('hopdong/view') . '?id=' . $model['hopdong']->id_hopdong);
//
//        }

        if($model['bangchiettinh']->load($request->post())){
            $model['bangchiettinh']->save();
//            DebugService::dumpdie($model['bangchiettinh']);
            $model['hopdong']->id_bct = $model['bangchiettinh']->id_bangchiettinh;
            $model['hopdong']->nguoi_thue = $model['bangchiettinh']->nguoi_thue;
            $model['hopdong']->save(false);
            return $this->redirect(Yii::$app->urlManager->createUrl(['quan-ly/hopdong/create','id' => $model['hopdong']->id_ho]));
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreatehopdong()
    {
        $request = Yii::$app->request;
        $model['hopdong'] = new HopDong();
        if ($request->isPost) {
            $model['hopdong']->load($request->post());
            return $this->redirect(Yii::$app->urlManager->createUrl('hopdong/create') . '?id=' . $model['hopdong']->id_ho);
        }
        return $this->renderAjax('createhopdong', [
            'model' => $model
        ]);
    }

    public function actionView($id = null)
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $model['bangchiettinh'] = BangChietTinh::findOne(['id_bangchiettinh' => $id, 'status' => 1]);
            $model['hopdong'] = Hopdong::findOne(['id_bct' => $id]);
            $model['ho'] = $model['hopdong']->thongtinho;
            $model['can'] = $model['ho']->thongtincan;
            return $this->renderPartial('view', [
                'model' => $model
            ]);
        } else {
            if (!UtilService::paramValidate($id) || $model['bct'] = BangChietTinh::findOne(['id_bangchiettinh' => $id, 'status' => 1]) == null) {
                return $this->render('notfound');
            }
            $model['bangchiettinh'] = $bct = BangChietTinh::findOne(['id_bangchiettinh' => $id, 'status' => 1]);
            $model['hopdong'] = Hopdong::findOne(['id_bct' => $id]);
            $model['ho'] = $model['hopdong']->thongtinho;
            $model['can'] = $model['ho']->thongtincan;

//            DebugService::dumpdie($model['bangchiettinh']);
            $giathue = (1 + $bct->heso_k2 + $bct->heso_k3 + $bct->heso_k4) * $bct->gia_chuan * 55.24;
            DebugService::dumpdie($this->roundSotien($giathue)*80/100);


            return $this->render('view', [
                'model' => $model,
                'const' => $this->const,
            ]);
        }

    }

    public function actionHopdong()
    {
        if (Yii::$app->request->isGet) {
            $get = Yii::$app->request->get();
            $id_ho = $get['id_ho'];
            $config = ConfigChothue::findOne(['id_config' => 1]);
            return $this->render('hopdong', [
                'config' => $config,
                'id_ho' => $id_ho
            ]);
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            DebugService::dumpdie($post);

            return $this->redirect(Yii::$app->request->referrer);
        }

    }

    public function actionThongtinchitiet()
    {
        if (Yii::$app->request->isGet) {
            $get = Yii::$app->request->get();
            $ho = VDanhsachthuenha::findOne(['id_ho' => $get['id_ho']]);

            return $this->render('thongtinchitiet', [
                'ho' => $ho
            ]);
        }
    }

    public function actionUpdate($id = null)
    {
        $request = Yii::$app->request;
        if (is_null($request->get()) || !UtilService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        $model['hopdong'] = HopDong::find()->with('thongtinho')->where(['id_hopdong' => $id])->one();
        if ($model['hopdong'] == null) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        $model['bangchiettinh'] = $bct = BangChietTinh::findOne(['id_bangchiettinh' => $id, 'status' => 1]);
        $model['hopdong'] = Hopdong::findOne(['id_bct' => $id]);
        $model['ho'] = $model['hopdong']->thongtinho;
        $model['can'] = $model['ho']->thongtincan;
        $model['fulldiachi'] = $model['ho']->thongtincan->fulldiachi;
        $model['quyetdinh'] = QuyetdinhTienthuenha::find()->where(['status' => 1])->orderBy('ngay_quyetdinh')->all();
        $model['thoigianbotri'] = DmThoigianbotri::find()->orderBy('he_so')->indexBy('id_thoigianbotri')->all();
        $model['miengiam'] = Miengiam::find()->where(['status' => 1])->orderBy('muc_giam')->all();
        if ($request->isPost) {
            \date_default_timezone_set('Asia/Ho_chi_minh');
            $post = $request->post();
//            DebugService::dumpdie($post);

            $model['hopdong']->load($post);

            $model['hopdong']->status = 1;
            $model['hopdong']->created_by = Yii::$app->user->id;
            $model['hopdong']->created_at = date('Y-m-d H:i:s');
            $model['hopdong']->validate();
            $model['hopdong']->save();
            UtilityService::alert('update');

            return $this->redirect(Yii::$app->urlManager->createUrl('hopdong/view') . '?id=' . $model['hopdong']->id_hopdong);

        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $search = new SearchHopdong();
        $search->load($request->post());
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
        $data = VHopdong::find()->select("
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
            ->andWhere(($search->so_hop_dong == null) ? '1=1' : "so_hop_dong like '%" . $search->so_hop_dong . "%'")
            ->andWhere(($search->so_nha == null) ? '1=1' : "so_nha like '%" . $search->so_nha . "%'")
            ->andWhere(($search->nguoi_thue == null) ? '1=1' : "nguoi_thue like '%" . mb_strtoupper($search->nguoi_thue) . "%'")
            ->andWhere(($search->ten_duong == null) ? '1=1' : "upper(ten_duong) = '" . mb_strtoupper($search->ten_duong) . "'")
            ->andWhere(($search->ma_phuong == null) ? '1=1' : "ma_phuong like '" . $search->ma_phuong . "'")
            ->andWhere(($search->thoi_han_thue == null) ? '1=1' : "thoi_han_thue = " . $search->thoi_han_thue)
            ->andWhere(($search->loainha == null) ? '1=1' : "id_loainha = " . $search->loainha)
            ->orderBy('stt, id_loainha asc, ten_duong, so_luu_kho,stt_can')
            ->asArray()
            ->all();
//DebugService::dumpdie($data);
        $writer = WriterFactory::create(Type::XLSX);
        $writer->openToBrowser('DanhSachHopDong_' . date('dmY_His') . '.xlsx');

        $writer->addRowWithStyle(["Danh sách hợp đồng " . date('dmY_His')], $style_header);
        $writer->addRow([]);
        $writer->addRowWithStyle(['STT', 'Số nhà', 'Tên đường', 'Tên phường', 'Loại nhà', 'Cấp nhà', 'Diện tích sử dụng', 'Người thuê', 'Số hợp đồng', 'Giá thuê', 'Giá giảm', 'Giá trả', 'Thời hạn thuê', 'Ngày ký', 'Ngày hết hạn', 'Ghi chú'], $style);
        $writer->addRows($data);
        $writer->close();

    }

    public function actionHethan()
    {
        $model['search'] = new SearchHopdonghethan();
        $model['hethan'] = $model['search']->search(Yii::$app->request->queryParams);
        $model['phuong'] = RanhPhuong::find()->orderBy('stt')->all();
        if (isset(Yii::$app->request->queryParams['SearchHopdonghethan'])) {
            $param = Yii::$app->request->queryParams['SearchHopdonghethan'];
            $url = '?';
            $url .= 'so_hop_dong=' . $param['so_hop_dong'];
            $url .= '&nguoi_thue=' . $param['nguoi_thue'];
            $url .= '&so_nha=' . $param['so_nha'];
            $url .= '&ten_duong=' . $param['ten_duong'];
            $url .= '&ma_phuong=' . $param['ma_phuong'];
            $url .= '&thoigian=' . $param['thoigian'];
        } else {
            $url = '';
        }

        return $this->render('danhsach/hethan', [
            'model' => $model,
            'url' => $url
        ]);
    }

    public function actionSaphethan()
    {
        $model['search'] = new SearchHopdongsaphethan();
        $model['saphethan'] = $model['search']->search(Yii::$app->request->queryParams);
        $model['phuong'] = RanhPhuong::find()->orderBy('stt')->all();
        if (isset(Yii::$app->request->queryParams['SearchHopdongsaphethan'])) {
            $param = Yii::$app->request->queryParams['SearchHopdongsaphethan'];
            $url = '?';
            $url .= 'so_hop_dong=' . $param['so_hop_dong'];
            $url .= '&nguoi_thue=' . $param['nguoi_thue'];
            $url .= '&so_nha=' . $param['so_nha'];
            $url .= '&ten_duong=' . $param['ten_duong'];
            $url .= '&ma_phuong=' . $param['ma_phuong'];
            $url .= '&thoigian=' . $param['thoigian'];
        } else {
            $url = '';
        }
        return $this->render('danhsach/saphethan', [
            'model' => $model,
            'url' => $url
        ]);
    }

    public function actionConhan()
    {
        $model['search'] = new SearchHopdongconhan();
        $model['conhan'] = $model['search']->search(Yii::$app->request->queryParams);
        $model['phuong'] = RanhPhuong::find()->orderBy('stt')->all();
        if (isset(Yii::$app->request->queryParams['SearchHopdongconhan'])) {
            $param = Yii::$app->request->queryParams['SearchHopdongconhan'];
            $url = '?';
            $url .= 'so_hop_dong=' . $param['so_hop_dong'];
            $url .= '&nguoi_thue=' . $param['nguoi_thue'];
            $url .= '&so_nha=' . $param['so_nha'];
            $url .= '&ten_duong=' . $param['ten_duong'];
            $url .= '&ma_phuong=' . $param['ma_phuong'];
            $url .= '&thoigian=' . $param['thoigian'];
        } else {
            $url = '';
        }
        return $this->render('danhsach/conhan', [
            'model' => $model,
            'url' => $url
        ]);
    }

    public function actionChuanhap()
    {
        $model['search'] = new SearchHopdongchuanhap();
        $model['chuanhap'] = $model['search']->search(Yii::$app->request->queryParams);
        $model['phuong'] = RanhPhuong::find()->orderBy('stt')->all();
        if (isset(Yii::$app->request->queryParams['SearchHopdongchuanhap'])) {
            $param = Yii::$app->request->queryParams['SearchHopdongchuanhap'];
            $url = '?';
            $url .= 'so_hop_dong=' . $param['so_hop_dong'];
            $url .= '&nguoi_thue=' . $param['nguoi_thue'];
            $url .= '&so_nha=' . $param['so_nha'];
            $url .= '&ten_duong=' . $param['ten_duong'];
            $url .= '&ma_phuong=' . $param['ma_phuong'];
            $url .= '&thoigian=' . $param['thoigian'];
        } else {
            $url = '';
        }
        return $this->render('danhsach/chuanhap', [
            'model' => $model,
            'url' => $url
        ]);
    }

    public function actionKhongco()
    {
        $model['search'] = new SearchHopdongkhongco();
        $model['khongco'] = $model['search']->search(Yii::$app->request->queryParams);
        $model['phuong'] = RanhPhuong::find()->orderBy('stt')->all();
        if (isset(Yii::$app->request->queryParams['SearchHopdongkhongco'])) {
            $param = Yii::$app->request->queryParams['SearchHopdongkhongco'];
            $url = '?';
            $url .= 'so_hop_dong=' . $param['so_hop_dong'];
            $url .= '&nguoi_thue=' . $param['nguoi_thue'];
            $url .= '&so_nha=' . $param['so_nha'];
            $url .= '&ten_duong=' . $param['ten_duong'];
            $url .= '&ma_phuong=' . $param['ma_phuong'];
            $url .= '&thoigian=' . $param['thoigian'];
        } else {
            $url = '';
        }
        return $this->render('danhsach/khongco', [
            'model' => $model,
            'url' => $url
        ]);
    }

    public function actionDelete($id = null)
    {
        $request = Yii::$app->request;
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

    public function actionTest($id = null)
    {
        DebugService::dumpdie(ThongTinHo::find()->joinWith('hopdongHientai')->where(['thong_tin_ho.id_ho' => 2])->all());
    }
}

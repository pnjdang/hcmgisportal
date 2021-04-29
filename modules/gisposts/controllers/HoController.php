<?php

namespace app\modules\quanly\controllers;

use app\modules\danhmuc\models\loainha\Loainha;
use app\modules\quanly\base\AbstractController;
use app\modules\quanly\base\Constants;
use app\modules\quanly\models\can\ThongTinCan;
use app\modules\quanly\models\ho\ThongTinHo;
use app\modules\quanly\models\ho\SearchHo;
use app\services\DebugService;
use yii\helpers\Html;
use app\models\DmLoainha;
use app\modules\quanly\models\hopdong\Hopdong;
use app\modules\danhmuc\models\phuong\Phuong;
use app\models\SearchHothanhly;
use app\modules\quanly\models\tailieu\TaiLieu;
use app\modules\quanly\models\VDuong;
use app\services\UtilService;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\WriterFactory;
use yii\web\Response;
use Yii;
use yii\data\ActiveDataProvider;

class HoController extends AbstractController
{

    public $const;

    public function init()
    {
        $this->const = [
            'title' => 'Hộ',
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
                    'label' => 'Cập nhật thông tin chi đoàn',
                    'url' => 'update',
                ],
                'view' => [
                    'label' => 'Thông tin chi tiết chi đoàn',
                    'url' => 'view',
                ],
                'statistic' => [
                    'label' => 'Thống kê chi đoàn',
                    'url' => 'statistic',
                ],
                'file' => [
                    'label' => 'Hồ sơ',
                    'url' => 'statistic',
                ],
            ],
        ];

        parent::init();
    }

    public function actionIndex($sonha = null, $tenduong = null, $phuong = null, $loainha = null)
    {
        $request = Yii::$app->request;

        $model['search'] = new SearchHo();
        $queryParams['SearchHo']['so_nha'] = $sonha;
        $queryParams['SearchHo']['ten_duong'] = $tenduong;
        $queryParams['SearchHo']['ma_phuong'] = $phuong;
        $queryParams['SearchHo']['id_loainha'] = $loainha;

        $search = $model['search']->search($queryParams);

        $model['dataProvider'] = $search;
        $model['duong'] = VDuong::find()->all();
        $model['ranh_phuong'] = Phuong::find()->orderBy('stt')->all();
        $model['loainha'] = Loainha::find()->all();

        if ($request->isPost) {
            $model['search']->load($request->post());
            $url = Yii::$app->urlManager->createUrl([
                'quan-ly/ho/index',
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
        if (!UtilService::paramValidate($id) || $model['ho'] = ThongTinHo::findOne(['id_ho' => $id, 'status' => 1]) == null) {
            return $this->render('notfound');
        }
        $model['ho'] = ThongTinHo::find()->joinWith('thongtincan')->where(['thong_tin_ho.status' => 1, 'id_ho' => $id])->one();
        if ($model['ho'] == null) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        $model['can'] = $model['ho']->relatedRecords['thongtincan'];
        $model['phuong'] = $model['can']->phuong;
        if ($model['ho']->so_luu_kho != null) {
            $model['tailieu'] = new ActiveDataProvider([
                'query' => TaiLieu::find()->where(['so_luu_kho' => $model['ho']->so_luu_kho]),
            ]);
        } else {
            $model['tailieu'] = new ActiveDataProvider([
                'query' => TaiLieu::find()->where(['so_luu_kho' => 0]),
            ]);
        }
        $model['hopdong'] = new ActiveDataProvider([
            'query' => HopDong::find()->where(['id_ho' => $model['ho']->id_ho])->andWhere(['<>', 'status', Constants::STATUS_TEMP])->andWhere(['<>', 'status', Constants::STATUS_INACTIVE]),
            'sort' => [
                'defaultOrder' => [
                    'ngay_het_han' => SORT_DESC,
                ]
            ]
        ]);


        return $this->render('view', [
            'model' => $model,
            'const' => $this->const,
        ]);
    }

    public function actionCreate($id = null)
    {
        $request = Yii::$app->request;
        $model['ho'] = new ThongTinHo();
        $model['ho']->id_can = $id;
        $model['ho']->da_ban = false;
        $model['ho']->thanh_ly = 0;
        $model['ho']->chuyen_giao = false;
        $model['ho']->status = 1;
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Thêm mới hộ",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Lưu', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])

                ];
            } else if ($model['ho']->load($request->post()) && $model['ho']->save()) {
                return [
                    'redirect' => Yii::$app->urlManager->createUrl(['quan-ly/can/view', 'id' => $id]),
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
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model['ho']->load($request->post()) && $model['ho']->save()) {
                return $this->redirect(['view', 'id' => $model['ho']->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
//                    'const' => $this->const,
                ]);
            }
        }
    }

    public function actionUpdate($id = null)
    {
        $request = Yii::$app->request;
        $model['ho'] = ThongTinHo::findOne($id);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Cập nhật vị trí có thể cho thuê",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Lưu', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])

                ];
            } else if ($model['ho']->load($request->post()) && $model['ho']->save()) {
                return [
                    'redirect' => Yii::$app->urlManager->createUrl(['quan-ly/can/view', 'id' => $model['ho']->id_can]),
                ];
            } else {
                return [
                    'title' => "Cập nhật vị trí có thể cho thuê",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Lưu', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])

                ];
            }
        }
    }

    public function actionDelete($id = null)
    {
        if (!UtilService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }

        $request = Yii::$app->request;

        $model = ThongTinHo::findOne($id);
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "<b>Xóa căn</b>",
                    'content' => $this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Xóa', ['class' => 'btn btn-danger pull-left', 'type' => "submit"])

                ];
            } else if ($model->deleteModel()) {
                return [
                    'redirect' => Yii::$app->urlManager->createUrl(['quan-ly/can/view', 'id' => $model->id_can]),
                    'title' => "<b>Xóa Căn</b>",
                    'content' => '<span class="text-success">Xóa căn nhà thành công</span>',
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"])
                ];
            } else {
                return [
                    'title' => "<b>Xóa căn</b>",
                    'content' => $this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Xóa', ['class' => 'btn btn-danger pull-left', 'type' => "submit"])

                ];
            }
        }


        $model['ho'] = ThongTinHo::find()->where(['thong_tin_ho.id_ho' => $id])->one();
        if ($model['ho'] == null) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        if (Yii::$app->request->isPost) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['ho']->load(Yii::$app->request->post());
            $model['ho']->status = 0;
            $model['ho']->updated_by = Yii::$app->user->id;
            $model['ho']->updated_at = date('Y-m-d H:i:s');
            $model['ho']->save();
            $model['hopdong'] = HopDong::findOne(['id_ho' => $model['ho']->id_ho, 'status' => 1]);
            if ($model['hopdong'] != null) {
                $model['hopdong']->status = 0;
                $model['hopdong']->updated_by = Yii::$app->user->id;
                $model['hopdong']->updated_at = date('Y-m-d H:i:s');
                $model['hopdong']->save();
            }

            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->renderPartial('delete', [
            'model' => $model,
        ]);
    }

    public function actionThanhly()
    {
        $request = Yii::$app->request;

        $model['search'] = new SearchHothanhly();
        $search = $model['search']->search($request->queryParams);
        $model['dataProvider'] = $search;
        $model['duong'] = VDuong::find()->all();
        $model['ranh_phuong'] = RanhPhuong::find()->orderBy('stt')->all();
        $model['dm_loainha'] = DmLoainha::find()->all();
        if ($request->isPost) {
            $model['search']->load($request->post());
            $url = Yii::$app->urlManager->createUrl('ho/thanhly');
            $url .= '?SearchHothanhly[so_nha]=' . $model['search']->so_nha;
            $url .= '&SearchHothanhly[ten_duong]=' . $model['search']->ten_duong;
            $url .= '&SearchHothanhly[ma_phuong]=' . $model['search']->ma_phuong;
            $url .= '&SearchHothanhly[id_loainha]=' . $model['search']->id_loainha;
            $url .= '&SearchHothanhly[thoigian_thanhly]=' . $model['search']->thoigian_thanhly;
            return $this->redirect($url);
        }
        return $this->render('thanhly', [
            'model' => $model,
        ]);
    }


    public function actionFile($id = null)
    {
        $this->layout = "@app/modules/quanly/views/layouts/main";

        $model['ho'] = ThongTinHo::find()->with('thongtincan')->where(['id_ho' => $id])->one();
//        DebugService::dumpdie($model['ho']);
        if ($model['ho'] == null) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
        if ($model['ho']->so_luu_kho != null) {
            $model['tailieu'] = new ActiveDataProvider([
                'query' => TaiLieu::find()->where(['so_luu_kho' => $model['ho']->so_luu_kho]),
            ]);
        } else {
            $model['tailieu'] = new ActiveDataProvider([
                'query' => TaiLieu::find()->where(['so_luu_kho' => 0]),
            ]);
        }
        return $this->render('file', [
            'model' => $model,
            'const' => $this->const,
        ]);
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

        $thongtinho = ThongTinHo::find()->joinWith(['hopdong','thongtincan', 'thongtincan.phuong', 'thongtincan.loainha'])->where(['thong_tin_ho.status' => 1])
            ->andFilterWhere(['like', 'upper(thong_tin_can.so_nha)', mb_strtoupper($queryParams['sonha'])])
            ->andFilterWhere(['like', 'upper(thong_tin_can.ma_phuong)', mb_strtoupper($queryParams['phuong'])])
            ->andFilterWhere(['like', 'upper(thong_tin_can.tenduong)', mb_strtoupper($queryParams['tenduong'])])
            ->andFilterWhere(["id_loainha" => $queryParams['loainha']])
            ->orderBy('thong_tin_can.stt_phuong,thong_tin_can.id_loainha,thong_tin_can.stt_can')
            ->all();
        $data = [];
        $stt = 1;
        foreach ($thongtinho as $i => $ho) {

            $data[$stt]['stt'] = $stt;
            $data[$stt]['stt_can'] = (in_array($i + 1, array_column($data, 'stt_can'))) ? '' : $i + 1;
            $data[$stt]['stt_ho'] = $stt;
            $data[$stt]['so_luu_kho'] = $ho->so_luu_kho;
            $data[$stt]['so_nha'] = $ho->thongtincan->so_nha;
            $data[$stt]['ten_duong'] = $ho->thongtincan->ten_duong;
            $data[$stt]['ten_phuong'] = $ho->thongtincan->phuong->tenphuong;
            $data[$stt]['vi_tri'] = $ho->vi_tri;
            $data[$stt]['so_to_bd'] = $ho->thongtincan->so_to_bd;
            $data[$stt]['so_thua'] = $ho->thongtincan->so_thua;
            $data[$stt]['dien_tich_khuon_vien'] = $ho->thongtincan->dien_tich_khuon_vien;
            $data[$stt]['dien_tich_su_dung'] = $ho->dien_tich_su_dung;
            $data[$stt]['nguoi_thue'] = ($ho->hopdong != null) ? $ho->hopdong->nguoi_thue : '';
            $data[$stt]['so_hop_dong'] = ($ho->hopdong != null) ? $ho->hopdong->so_hop_dong : '';
            $data[$stt]['thoi_han'] = ($ho->hopdong != null) ? $ho->hopdong->thoi_han_thue : '';
            $data[$stt]['ngay_het_han'] = ($ho->hopdong != null && $ho->hopdong->ngay_het_han != null) ? date('d-m-Y', strtotime($ho->hopdong->ngay_het_han)) : '';
            $data[$stt]['ghi_chu'] = ($ho->hopdong != null) ? $ho->hopdong->ghi_chu : '';

            $stt++;
        }

//        DebugService::dumpdie($data);
        $writerNha = WriterFactory::create(Type::XLSX);
        $writerNha->openToBrowser('DanhSachHo_' . date('dmY_His') . '.xlsx');
        $writerNha->addRowWithStyle(["Danh sách hộ " . date('dmY_His')], $style_header);
        $writerNha->addRow([]);
        $writerNha->addRowWithStyle(['STT', 'STT Căn', 'STT hộ', 'Số lưu kho', 'Số nhà', 'Tên đường', 'Tên phường', 'Vị trí', 'Số tờ bản đồ', 'Số thửa', 'Diện tích khuôn viên', 'Diện tích sử dụng', 'Người thuê', 'Số hợp đồng', 'Thời hạn thuê', 'Ngày hết hạn', 'Ghi chú'], $style);
        $writerNha->addRows($data);
        $writerNha->close();
    }

}

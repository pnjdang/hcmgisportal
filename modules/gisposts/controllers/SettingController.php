<?php

namespace app\modules\quanly\controllers;

use app\models\ConfigChothue;
use app\models\DataImport;
use app\models\DmLoainha;
use app\models\GiaHan;
use app\models\HopDong;
use app\models\NguoiThue;
use app\models\RanhPhuong;
use app\models\TaiKhoan;
use app\models\ThongTinCan;
use app\models\ThongTinHo;
use app\models\VCan;
use app\models\VHopdong;
use app\modules\quanly\base\AbstractController;
use app\services\DebugService;
use Box\Spout\Common\Type;
use Box\Spout\Reader\ReaderFactory;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\UploadedFile;

class SettingController extends AbstractController
{

    public function actionChothue(){
        $request = Yii::$app->request;
        $model = ConfigChothue::findOne(['id_config' => 1]);

        if($request->isPost){

        }

        return $this->render('chothue', ['model' => $model]);
    }

    public function actionSetting()
    {
        if (Yii::$app->request->isGet) {
            $model = ConfigChothue::findOne(['id_config' => 1]);
            return $this->render('setting', ['models' => $model]);
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            //DebugService::dumpdie($post);
            $config = ConfigChothue::findOne(['id_config' => 1]);
            if ($config == null) {
                $config = new ConfigChothue();
            }
            $config->load($post, 'config');
            if ($config->validate()) {
                $config->save();
            } else {
                DebugService::dumpdie($config->getErrors());
            }
            return $this->redirect(Yii::$app->request->referrer);
        }

    }

    public function actionUpdatesetting($id = null)
    {
        $request = Yii::$app->request;
        $model = ConfigChothue::findOne(['id_config' => $id]);

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Cập nhật thông tin bên cho thuê nhà ở</b>",
                    'content'=>$this->renderAjax('updatesetting', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Cập nhật',['class'=>'btn btn-warning pull-left','type'=>"submit"])

                ];
            } elseif($request->isPost && $model->load($request->post()) && $model->save()) {
                return [
                    'redirect'=>Yii::$app->request->referrer,
                ];
            } else {
                return [
                    'title'=> "<b>Cập nhật thông tin bên cho thuê nhà ở</b>",
                    'content'=>$this->renderAjax('updatesetting', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Cập nhật',['class'=>'btn btn-warning pull-left','type'=>"submit"])

                ];
            }
        }
    }

    public function actionThongtincanhan()
    {
        if (Yii::$app->request->isGet) {
            $taikhoan = Yii::$app->user->getIdentity();
            return $this->render('thongtincanhan', ['taikhoan' => $taikhoan]);
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            //DebugService::dumpdie($post);
            $taikhoan = TaiKhoan::findOne(['id_taikhoan' => $post['taikhoan']['id_taikhoan']]);
            if ($post['taikhoan']['mat_khau_cu'] == null) {
                $taikhoan->ho_ten = $post['taikhoan']['ho_ten'];
                $taikhoan->chuc_vu = $post['taikhoan']['chuc_vu'];
                $taikhoan->phong_ban = $post['taikhoan']['phong_ban'];
                if ($taikhoan->validate()) {
                    $taikhoan->save();
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    DebugService::dumpdie($taikhoan->getErrors);
                }
            } else {
                if ($taikhoan->mat_khau != md5($post['taikhoan']['mat_khau_cu'] . '@hcmgis#')) {
                    Yii::$app->session->addFlash('mat_khau_cu', true);
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    if ($post['taikhoan']['mat_khau_moi'] != $post['taikhoan']['mat_khau_moi_c']) {
                        Yii::$app->session->addFlash('mat_khau_moi_c', true);
                        return $this->redirect(Yii::$app->request->referrer);
                    } else {
                        $taikhoan->ho_ten = $post['taikhoan']['ho_ten'];
                        $taikhoan->chuc_vu = $post['taikhoan']['chuc_vu'];
                        $taikhoan->phong_ban = $post['taikhoan']['phong_ban'];
                        $taikhoan->mat_khau = md5($post['taikhoan']['mat_khau_moi'] . '@hcmgis#');
                        if ($taikhoan->validate()) {
                            $taikhoan->save();
                            Yii::$app->session->addFlash('mat_khau_moi', true);
                            return $this->redirect(Yii::$app->request->referrer);
                        } else {
                            DebugService::dumpdie($taikhoan->getErrors);
                        }
                    }
                }
            }
        }
    }

    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        //DebugService::dumpdie($post);
        $taikhoan = TaiKhoan::findOne(['ten_taikhoan' => $post['taikhoan']['ten_taikhoan']]);
        if ($taikhoan == null) {
            $taikhoan = new TaiKhoan();
            $taikhoan->load($post, 'taikhoan');
            if ($taikhoan->validate()) {
                $taikhoan->save();
            } else {
                DebugService::dumpdie($taikhoan->getErrors());
            }
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionUpdate()
    {
        if (Yii::$app->request->isGet) {
            $get = Yii::$app->request->get();
            $taikhoan = TaiKhoan::findOne(['id_taikhoan' => $get['id_taikhoan']]);
            return $this->render('update', ['taikhoan' => $taikhoan]);
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $taikhoan = TaiKhoan::findOne(['id_taikhoan' => $post['taikhoan']['id_taikhoan']]);
            $taikhoan->load($post, 'taikhoan');
            if ($taikhoan->validate()) {
                $taikhoan->save();
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                DebugService::dumpdie($taikhoan->getErrors);
            }
        }
    }

    public function actionDelete()
    {
        $post = Yii::$app->request->post();
        TaiKhoan::findOne(['id_taikhoan' => $post['taikhoan']['id_taikhoan']])->delete();
        return $this->redirect(Yii::$app->urlManager->createUrl('quan-ly-tai-khoan'));
    }


    public function actionTaikhoan()
    {
        if (Yii::$app->request->isGet) {
            $tai_khoans = TaiKhoan::find()->orderBy('id_taikhoan')->all();
            return $this->render('taikhoan', ['tai_khoans' => $tai_khoans]);
        }
    }

    public function actionDanhsachcanxoa()
    {
        $query = VCan::find()->where('delete = 1');
        $countQuery = $query->count();
        $pages = new Pagination(['totalCount' => $countQuery, 'pageSize' => 30]);
        $vcan = $query->orderBy('stt')->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('danhsachcanxoa', [
            'vcan' => $vcan,
            'pages' => $pages,
        ]);
    }

    public function actionDataimport()
    {
        if (Yii::$app->request->isGet) {
            $dataFile = new DataImport();
            return $this->render('dataimport', ['dataFile' => $dataFile]);
        }
        if (Yii::$app->request->isPost) {
            $dataFile = new DataImport();
            $dataFile->dataFile = UploadedFile::getInstance($dataFile, 'dataFile');
            $dataFile->upload();

            $reader = ReaderFactory::create(Type::XLSX);
            $filePath = Yii::$app->basePath . '/uploads/' . $dataFile->dataFile->baseName . '.' . $dataFile->dataFile->extension;
            $reader->open($filePath);
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($a = $sheet->getRowIterator() as $i => $row) {
                    if ($i >= 2) {
                        $can = ThongTinCan::findOne(['stt_can' => $row[0]]);

                        if ($can == null) {
                            $can = new ThongTinCan();
                            $can->stt_can = $row[0];
                            $can->dien_tich_khuon_vien = (double)$row[4];
                            $can->so_nha = (string)$row[7];
                            $can->ten_duong = $row[8];
                            $dm_loainha = DmLoainha::find()->all();
                            foreach ($dm_loainha as $i => $loainha) {
                                if ($loainha->ten_loainha == $row[2]) {
                                    $can->id_loainha = $loainha->id_loainha;
                                }
                            }
                            $phuong = RanhPhuong::find()->all();
                            foreach ($phuong as $k => $p) {
                                if ($p->tenphuong == $row[9]) {
                                    $can->ma_phuong = $p->maphuong;
                                }
                            }
                            if ($can->validate()) {
                                $can->save();
                            } else {
                                DebugService::dumpdie($can->getErrors());
                            }
                        }


                        $ho = new ThongTinHo();
                        $ho->id_can = $can->id_can;
                        $ho->stt_ho = $row[1];
                        $ho->cap_nha = (string)$row[3];
                        $ho->dien_tich_su_dung = (double)$row[5];
                        $ho->vi_tri = (string)$row[6];
                        $ho->nguoi_thue = $row[11];
                        $ho->hop_dong_hien_tai = (string)$row[12];
                        $ho->thoi_han = (string)$row[16];
                        $ho->ghi_chu = $row[17];
                        if ($ho->validate()) {
                            $ho->save();
                        } else {
                            DebugService::dumpdie($ho->getErrors());
                        }

                        $hop_dong = new HopDong();
                        $hop_dong->id_ho = $ho->id_ho;
                        $hop_dong->nguoi_thue = $row[11];
                        $hop_dong->so_hop_dong = (string)$row[12];
                        $hop_dong->gia_thue = (integer)$row[13];
                        $hop_dong->gia_giam = (integer)$row[14];
                        $hop_dong->gia_phai_tra = (integer)$row[15];
                        $hop_dong->thoi_han_thue = $row[16];
                        if ($hop_dong->validate()) {
                            $hop_dong->save();
                        } else {
                            DebugService::dumpdie($hop_dong->getErrors());
                        }
                    }
                }
            }

            $reader->close();
            return $this->render('dataimport', ['dataFile' => $dataFile]);
        }

    }

    public function actionThongbao()
    {
        $get = Yii::$app->request->get();
        $where = "(ngay_het_han ) >= 'now'::text::date AND (ngay_het_han - 15) < 'now'::text::date";
        $query = VHopdong::find()->where($where);
        $countQuery = $query->count();
        $pages = new Pagination(['totalCount' => $countQuery, 'pageSize' => 30]);
        $query->orderBy('ngay_het_han asc');
        $danhsach = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $duongs = VHopdong::find()->select('ten_duong')->where($where)->distinct()->orderBy('ten_duong')->all();
        $ranh_phuong = RanhPhuong::find()->orderBy('stt')->all();
        if ($get == null) {
            $maphuong = '';
        } else {
            if (isset($get['q'])) {
                $maphuong = ($get['q'] != null && $danhsach != null) ? $danhsach[0]['ma_phuong'] : '';
            } else {
                $maphuong = '';
            }
        }
        return $this->render('thongbao', [
            'danhsach' => $danhsach,
            'count' => $countQuery,
            'pages' => $pages,
            'ranh_phuong' => $ranh_phuong,
            'maphuong' => $maphuong,
            'duongs' => $duongs,
        ]);
    }

    public function actionRestorecan()
    {
        $request = Yii::$app->request;
        if ($request->isGet) {
            $get = $request->get();
            return $this->renderPartial('restorecan', ['id_can' => $get['id_can']]);
        }
        if ($request->isPost) {
            $post = $request->post();
            $can = ThongTinCan::findOne(['id_can' => $post['id_can']]);
            $can->delete = '';
            $can->save();
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionDeletefullcan()
    {

        $request = Yii::$app->request;
        $get = $request->get();
        if (!isset($get['id_can']) || $get['id_can'] == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/danhsachcanxoa');
        } else {
            $id_can = $get['id_can'];
        }
        if ($request->isGet) {
            return $this->renderPartial('deletefullcan');
        }
        if ($request->isPost) {
            $can = ThongTinCan::findOne(['id_can' => $id_can]);
            $can->delete();
            $ho = ThongTinHo::find()->where(['id_can' => $id_can])->all();
            foreach ($ho as $i => $h) {
                $hopdong = HopDong::findOne(['id_ho' => $h->id_ho]);
                GiaHan::deleteAll(['id_hopdong' => $hopdong->id_hopdong]);
                NguoiThue::deleteAll(['id_hopdong' => $hopdong->id_hopdong]);
                $hopdong->delete();
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
}

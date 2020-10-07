<?php

namespace app\controllers\admin;

use app\controllers\base\AbstractAdminController;
use app\controllers\base\AbstractTlkhcnController;
use app\models\chuyengia\Chuyengia;
use app\models\chuyengia\ChuyengiaChuyennganh;
use app\models\chuyengia\ChuyengiaConfig;
use app\models\chuyengia\ChuyengiaLinhvuc;
use app\models\danhmuc\chuyengia\donvi\Donvi;
use app\models\danhmuc\chuyengia\hocham\HocHam;
use app\models\danhmuc\chuyengia\hocvi\HocVi;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap1\LinhvucnghiencuuCap1;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap3\LinhvucnghiencuuCap3;
use app\models\danhmuc\chuyengia\loaicongtrinhnghiencuu\LoaiCongtrinhnghiencuu;
use app\models\danhmuc\chuyengia\ngoaingu\Ngoaingu;
use app\models\FileUpload;
use app\models\danhmuc\chuyengia\linhvucquanly\LinhvucQuanly;
use app\models\chuyengia\SearchChuyengia;
use app\models\chuyengia\SearchChuyengiaCongtac;
use app\models\chuyengia\SearchChuyengiaCongtrinh;
use app\models\chuyengia\SearchChuyengiaDaotao;
use app\models\chuyengia\SearchChuyengiaDetai;
use app\models\chuyengia\SearchChuyengiaNgoaingu;
use app\models\VChuyengia;
use app\services\DebugService;
use app\services\UtilityService;
use Box\Spout\Common\Type;
use Box\Spout\Reader\ReaderFactory;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * DschuyengiaController implements the CRUD actions for VChuyengia model.
 */
class ChuyengiaController extends AbstractAdminController
{

    /**
     * Lists all VChuyengia models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $this->layout = "@app/views/layouts/layout_map";
        $searchModel = new SearchChuyengia();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VChuyengia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->with('donvi', 'hocham', 'hocvi', 'chuyengiaChuyennganhs', 'chuyengiaChuyennganhs.cap3', 'chuyengiaLinhvucs', 'chuyengiaLinhvucs.cap1')->where(['id_chuyengia' => $id])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        return $this->render('view', [
            'model' => $model,
        ]);

    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model['chuyengia'] = new Chuyengia();
        $model['hocham'] = HocHam::find()->where(['status' => 1])->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->where(['status' => 1])->orderBy('ten_hv')->all();
        $model['linhvucquanly'] = LinhvucQuanly::find()->orderBy('id_lvql')->all();
        $model['donvicongtac'] = Donvi::find()->orderBy('id_donvi')->all();
        $model['linhvucnghiencuu'] = LinhvucnghiencuuCap1::find()->where(['status' => 1])->orderBy('id_cap1')->all();
        if ($model['chuyengia']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['chuyengia']->created_by = Yii::$app->user->id;
            $model['chuyengia']->created_at = date('Y-m-d H:i:s');
            $model['chuyengia']->status = 1;
            $model['chuyengia']->save();
            UtilityService::alert('create');
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/chuyengia/view') . '?id=' . $model['chuyengia']->id_chuyengia);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    public function actionUpdate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['chuyengia'] = Chuyengia::find()->with('donvi', 'hocham', 'hocvi', 'chuyengiaChuyennganhs', 'chuyengiaChuyennganhs.cap3', 'chuyengiaLinhvucs')->joinWith('chuyengiaLinhvucs.cap1')->where(['id_chuyengia' => $id])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['chuyengia']->linhvucnghiencuu = ArrayHelper::getColumn($model['chuyengia']->chuyengiaLinhvucs, 'cap1_id');
        $model['chuyengia']->chuyennganh = ArrayHelper::map($model['chuyengia']->chuyengiaChuyennganhs, 'cap3_id', 'cap3.ma_ten_cap3');
        $model['hocham'] = HocHam::find()->where(['status' => 1])->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->where(['status' => 1])->orderBy('ten_hv')->all();
        $model['chucvu'] = Chucvu::find()->where(['status' => 1])->orderBy('ten_chucvu')->all();
        $model['linhvucquanly'] = LinhvucQuanly::find()->orderBy('id_lvql')->all();
        $model['linhvucnghiencuu'] = LinhvucnghiencuuCap1::find()->where(['status' => 1])->orderBy('id_cap1')->all();
        if($model['chuyengia']->donvi != null){
            $model['donvi'] = [$model['chuyengia']->donvi->id_donvi => $model['chuyengia']->donvi->ten_donvi];
        } else {
            $model['donvi'] = null;

        }
        if ($model['chuyengia']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['chuyengia']->updated_by = Yii::$app->user->id;
            $model['chuyengia']->updated_at = date('Y-m-d');
            $model['chuyengia']->save();
            UtilityService::alert('update');
            return $this->redirect(['view', 'id' => $model['chuyengia']->id_chuyengia]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }

    public function actionDelete($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['chuyengia'] = Chuyengia::findOne($id);
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }

        if ($request->isPost) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['chuyengia']->status = 0;
            $model['chuyengia']->updated_by = Yii::$app->user->id;
            $model['chuyengia']->updated_at = date('Y-m-d H:i:s');
            $model['chuyengia']->save();
            UtilityService::alert('delete');
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        return $this->renderPartial('delete',[
            'model' => $model
        ]);

    }

    protected function findModel($id)
    {
        if (($model = Chuyengia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCongtrinh($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['loaicongtrinh'] = LoaiCongtrinhnghiencuu::find()->where(['status' => 1])->orderBy('ten_loaicongtrinh')->all();
        $model['search'] = new SearchChuyengiaCongtrinh();
        $model['congtrinh'] = $model['search']->search(Yii::$app->request->queryParams, $id);

        return $this->render('congtrinh', [
            'model' => $model,
        ]);
    }

    public function actionNgoaingu($id = null){
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['ngoaingu'] = Ngoaingu::find()->orderBy('ten_ngoaingu')->all();
        $model['search'] = new SearchChuyengiaNgoaingu();
        $model['trinhdongoaingu'] = $model['search']->search(Yii::$app->request->queryParams, $id);

        return $this->render('trinhdongoaingu', [
            'model' => $model,
        ]);
    }

    public function actionCongtac($id = null){
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['search'] = new SearchChuyengiaCongtac();
        $model['congtac'] = $model['search']->search(Yii::$app->request->queryParams, $id);

        return $this->render('congtac', [
            'model' => $model,
        ]);
    }

    public function actionDaotao($id = null){
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['search'] = new SearchChuyengiaDaotao();
        $model['daotao'] = $model['search']->search(Yii::$app->request->queryParams, $id);

        return $this->render('daotao', [
            'model' => $model,
        ]);
    }

    public function actionDetai($id = null){
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $model['search'] = new SearchChuyengiaDetai();
        $model['detai'] = $model['search']->search(Yii::$app->request->queryParams, $id);

        return $this->render('detai', [
            'model' => $model,
        ]);
    }


    public function actionImport()
    {
        $model = new FileUpload();
        if (\Yii::$app->request->isPost) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model->file = \yii\web\UploadedFile::getInstance($model, 'file');
            $model->uploadFile();
            $inputFileName = \Yii::$app->basePath . '/uploads/file/import/' . $model->file->baseName . '.' . $model->file->extension;
            $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
            $reader->open($inputFileName);

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $i => $row) {
                    if ($i >= 2) {
                        $chuyengia = new Chuyengia();
                        $chuyengia->ho_ten = $row[2];
                        $chuyengia->nam_sinh = $row[3];
                        if ($row[4] == 'Nam') {
                            $chuyengia->gioi_tinh = 1;
                        } else {
                            $chuyengia->gioi_tinh = 0;
                        }
                        $hocham = HocHam::findOne(['ten_hh' => $row[5]]);
                        if ($hocham != null) {
                            $chuyengia->hocham_id = $hocham->id_hh;
                        } else {
                            $chuyengia->hocham_id = null;
                        }
                        $chuyengia->nam_hocham = $row[6];
                        $hocvi = HocVi::findOne(['ten_hv' => $row[7]]);
                        if ($hocvi != null) {
                            $chuyengia->hocvi_id = $hocvi->id_hv;
                        } else {
                            $chuyengia->hocvi_id = null;
                        }
                        $chuyengia->nam_hocvi = $row[8];
                        $chuyengia->congviec_hiennay = $row[12];
                        $chuyengia->chucvu_hientai = $row[13];
                        $chuyengia->diachi_nharieng = $row[14];
                        $chuyengia->dien_thoai = (String)$row[15];
                        $chuyengia->di_dong = (String)$row[16];
                        $chuyengia->email = (String)$row[17];
                        $chuyengia->donvi_id = $row[18];
                        $chuyengia->status = 1;
                        $chuyengia->created_at = date('Y-m-d H:i:s');
                        $chuyengia->created_by = Yii::$app->user->id;


                        if ($chuyengia->validate()) {
                            $chuyengia->save();
                            $chuyengia_linhvuc = new ChuyengiaLinhvuc();
                            $chuyengia_linhvuc->chuyengia_id = $chuyengia->id_chuyengia;
                            $cap1 = LinhvucnghiencuuCap1::find()->where(['upper(ten_cap1)' => mb_strtoupper(trim($row[9]))])->one();
                            if ($cap1 != null) {
                                $chuyengia_linhvuc->cap1_id = $cap1->id_cap1;
                                $chuyengia_linhvuc->save();

                            }

                            $chuyengia_chuyennganh = new ChuyengiaChuyennganh();
                            $chuyengia_chuyennganh->chuyengia_id = $chuyengia->id_chuyengia;
                            $cap3 = LinhvucnghiencuuCap3::find()->where(['upper(ma_cap3)' => mb_strtoupper(trim($row[10]))])->one();
                            if ($cap3 != null) {
                                $chuyengia_chuyennganh->cap3_id = $cap3->id_cap3;
                                $chuyengia_chuyennganh->save();

                            }
                        } else {
//                            DebugService::dumpdie($i);
                            DebugService::dumpdie($chuyengia->getErrors());
                        }
                    }
                }
            }
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('import', [
            'model' => $model,
        ]);
    }

}

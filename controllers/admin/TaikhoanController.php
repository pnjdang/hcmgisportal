<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 6/7/2017
 * Time: 5:08 PM
 */

namespace app\controllers\admin;

use app\controllers\base\AbstractAdminController;
use app\controllers\base\AbstractTlkhcnController;
//use app\models\AnhDaiDien;
use app\models\DoiMatKhau;
use app\models\LoaiTaikhoan;
use app\models\TaiKhoan;
use app\services\DebugService;
use app\services\UtilityService;
use \yii\web\UploadedFile;
use Yii;


class TaikhoanController extends AbstractAdminController
{

    public function actionIndex()
    {
        $model['taikhoan'] = Yii::$app->user->identity;
        $model['doimatkhau'] = new DoiMatKhau();
        //$model['anhdaidien'] = new AnhDaiDien();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpdate()
    {
        $post = Yii::$app->request->post();
        $taikhoan = Yii::$app->user->identity;
        $taikhoan->load($post);
        $taikhoan->save();
        UtilityService::alert('update');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpload()
    {
        $post = Yii::$app->request->post();
        $anhdaidien = new AnhDaiDien();
        $anhdaidien->anhdaidien = UploadedFile::getInstance($anhdaidien, 'anhdaidien');
        if ($anhdaidien->uploadAnhDaiDien(Yii::$app->user->identity->ten_dang_nhap, Yii::$app->user->identity->id_taikhoan)) {
            // file is uploaded successfully
            UtilityService::alert('update');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionChangepass()
    {
        $model = new DoiMatKhau();
        $model->load(\Yii::$app->request->post());
        if ($model->changePassword()) {
            UtilityService::alert('pass_success');
            return $this->redirect(\Yii::$app->request->referrer . '#doimatkhau');
        } else {
            UtilityService::alert('pass_error');
            return $this->redirect(\Yii::$app->request->referrer . '#doimatkhau');
        }
    }

    public function actionQuanlytaikhoan()
    {

        $request = Yii::$app->request;
        $model['danhsachtaikhoan'] = TaiKhoan::find()->where(['admin' => false])->andWhere(['status' => 1])->orderBy('id_taikhoan')->all();
        $model['danhsachdaxoa'] = null;
        $model['taikhoan'] = new TaiKhoan();
        $model['loaitaikhoan'] = LoaiTaikhoan::find()->orderBy('id_loaitk')->all();
        if ($request->isGet) {
            return $this->render('quanlytaikhoan', [
                'model' => $model,
            ]);
        }
        if ($request->isPost) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['taikhoan']->load($request->post());
            $model['taikhoan']->admin = false;
            $model['taikhoan']->mat_khau= md5($model['taikhoan']->mat_khau.'@hcmgis#');
            $model['taikhoan']->create_at = date("Y-m-d H:i:s");
            $model['taikhoan']->tinh_trang = 1;
            $model['taikhoan']->save();
            return $this->redirect($request->referrer);
        }


    }

    public function actionUpdatetaikhoan()
    {
        $request = Yii::$app->request;
        if(!isset($request->get()['id']) || $request->get()['id'] == null || !is_numeric($request->get()['id'])){
            return $this->redirect(Yii::$app->urlManager->createUrl('taikhoan/quanlytaikhoan'));
        }
        $id = $request->get()['id'];
        $model['taikhoan'] = TaiKhoan::findOne(['id_taikhoan' => $id]);
        if($model['taikhoan'] == null){
            return $this->redirect(Yii::$app->urlManager->createUrl('taikhoan/quanlytaikhoan'));
        }
        $model['loaitaikhoan'] = LoaiTaikhoan::find()->orderBy('id_loaitk')->all();
            if ($request->isGet) {
                return $this->renderAjax('updatetaikhoan', [
                    'model' => $model,
                ]);
            }
            if ($request->isPost) {
                $model['taikhoan']->load($request->post());
                $model['taikhoan']->save();
                UtilityService::alert('update');
                return $this->redirect($request->referrer);
            }



    }

    public function actionRestoretaikhoan()
    {
        $request = Yii::$app->request;
        $id = $request->get()['id'];
        $model['taikhoan'] = TaiKhoan::findOne(['id_taikhoan' => $id]);

        if ($request->isGet) {
            return $this->renderPartial('restoretaikhoan', [
                'model' => $model,
            ]);
        }

        if ($request->isPost) {
            $model['taikhoan']->tinh_trang = 0;
            $model['taikhoan']->save();
            UtilityService::alert('restore');
            return $this->redirect($request->referrer);
        }
    }

}
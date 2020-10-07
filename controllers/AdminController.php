<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/8/2017
 * Time: 3:41 PM
 */
namespace app\controllers;

use app\controllers\base\AbstractTlkhcnController;
use app\models\ChungLoai;
use app\models\ChuyenGia;
use app\models\ChuyengiaChuyennganh;
use app\models\CongnhanChatluong;
use app\models\DoituongPhucvu;
use app\models\LienHe;
use app\models\LinhvucnghiencuuCap1;
use app\models\LinhvucnghiencuuCap3;
use app\models\LinhvucThunghiem;
use app\models\PdkChuyengia;
use app\models\PdkPhongthinghiem;
use app\models\PhongThiNghiem;
use app\models\ReportThongtin;
use app\models\SearchLienhe;
use app\models\TaiKhoan;
use app\models\TempPhongthinghiem;
use app\models\TieuChuan;
use app\models\TkChuyengia;
use app\models\TkPtnQuanhuyen;
use app\models\TochucHoptac;
use app\services\DebugService;
use app\services\UtilityService;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;


class AdminController extends AbstractTlkhcnController{

    public function actionMap()
    {
        $this->layout = "@app/views/layouts/layout_map";
        return $this->render('map');
    }

    public function actionInbox()
    {
        $searchModel = new SearchLienhe();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('inbox', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReply($id){
        $request = \Yii::$app->request;
        $model['lienhe'] = LienHe::findOne($id);

        if($request->isPost){
            $model['lienhe']->load($request->post());
            $model['lienhe']->save();
            return $this->redirect($request->referrer);
        }

        return $this->renderPartial('reply',[
            'model' => $model,
        ]);

    }

    public function actionReportphongthinghiem(){
        $query = TempPhongthinghiem::find()->joinWith('dtpv')->joinWith('taikhoan');
        $model['report'] = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'created_at',
                    'ten_tv',
                    'taikhoan_id',
                    'status',
                ]
            ]
        ]);
        return $this->render('reportphongthinghiem',[
            'model' => $model,
        ]);
    }

    public function actionCheckphongthinghiem($id){
        $model['temp'] = TempPhongthinghiem::find()->where(['status' => 0, 'id_tempptn' => $id])->one();
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['status' => 1, 'id_ptn' => $model['temp']->ptn_id])->one();
        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();
        $model['phongthinghiem']->linhvucChecked = ArrayHelper::getColumn($model['temp']->getPhongthinghiemLinhvucs()->asArray()->all(), 'lv_id');
        $model['phongthinghiem']->chatluongChecked = ArrayHelper::getColumn($model['temp']->getPhongthinghiemChatluongs()->asArray()->all(), 'cncl_id');
        $model['phongthinghiem']->hoivienChecked = ArrayHelper::getColumn($model['temp']->getPhongthinghiemHoptacs()->asArray()->all(), 'tcht_id');
        $model['phongthinghiem']->tieuchuanChecked = ArrayHelper::getColumn($model['temp']->getPhongthinghiemTieuchuans()->asArray()->all(), 'tc_id');
        $model['phongthinghiem']->phanloaiChecked = ArrayHelper::map($model['temp']->getPhongthinghiemChungloais()->asArray()->all(), 'id_ptn_cl', 'pl_id', 'cl_id');

        if(\Yii::$app->request->isPost && $model['phongthinghiem']->load(\Yii::$app->request->post())){
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['phongthinghiem']->status = 1;
            $model['phongthinghiem']->updated_at = date('Y-m-d H:i:s');
            $model['phongthinghiem']->updated_by = \Yii::$app->user->id;
//            DebugService::dumpdie($model['phongthinghiem']);
            $model['phongthinghiem']->save();
            $model['temp']->status = 1;
            $model['temp']->updated_at = date('Y-m-d H:i:s');
            $model['temp']->updated_by = \Yii::$app->user->id;
            $model['temp']->save();
            UtilityService::alert('updated_success');
            return $this->redirect(\Yii::$app->urlManager->createUrl('admin/reportphongthinghiem'));
        }
        return $this->render('checkphongthinghiem',[
            'model' => $model,
        ]);
    }

    public function actionReportcheck($id){
        $model = ReportThongtin::findOne($id);

        if(\Yii::$app->request->isPost){
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model->status = 1;
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(\Yii::$app->request->referrer);
        }

        return $this->renderPartial('reportcheck',[
            'model' => $model,
        ]);
    }
}

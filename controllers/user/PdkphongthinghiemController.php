<?php

namespace app\controllers\user;

use app\controllers\base\AbstractTlkhcnController;
use app\controllers\base\AbstractUserController;
use app\models\danhmuc\phongthinghiem\chungloai\ChungLoai;
use app\models\danhmuc\phongthinghiem\congnhanchatluong\CongnhanChatluong;
use app\models\danhmuc\phongthinghiem\doituongphucvu\DoituongPhucvu;
use app\models\LinhvucThunghiem;
use app\models\phongthinghiem\PhongThiNghiem;
use app\models\phongthinghiem\SearchPdkPhongthinghiem;
use app\models\TieuChuan;
use app\models\TochucHoptac;
use app\services\DebugService;
use app\services\UtilityService;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * DschuyengiaController implements the CRUD actions for VChuyengia model.
 */
class PdkphongthinghiemController extends AbstractUserController
{

    public function actionIndex()
    {
        $searchModel = new SearchPdkPhongthinghiem();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->user->id);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }

        $model['phongthinghiem'] = PhongThiNghiem::find()
            ->joinWith('dtpv')
            ->joinWith('phongthinghiemLinhvucs')
            ->joinWith('phongthinghiemTieuchuans')
            ->joinWith('phongthinghiemHoptacs')
            ->joinWith('phongthinghiemChatluongs')
            ->joinWith('phongthinghiemChungloais')
            ->where(['id_ptn' => $id, 'phong_thi_nghiem.status' => 2,'created_by' => Yii::$app->user->id])->one();
        if ($model['phongthinghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/phongthinghiem/index'));
        }

        return $this->renderPartial('view', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id = null){
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkphongthinghiem/index'));
        }
        $request = Yii::$app->request;
        $model['ptn'] = PhongThiNghiem::find()->where(['id_ptn' => $id,'status' => 2])->one();
        if ($model['ptn'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkphongthinghiem/index'));
        }
        $model['dmlvtn'] = LinhvucThunghiem::find()->orderBy('id_lv')->all();
        $model['dmchungloai'] = ChungLoai::find()->orderBy('id_cl')->all();
        $model['dmtieuchuan'] = TieuChuan::find()->orderBy('id_tc')->all();
        $model['dmchatluong'] = CongnhanChatluong::find()->orderBy('id_cncl')->all();
        $model['dmdoituong'] = DoituongPhucvu::find()->orderBy('id_dtpv')->all();
        $model['dmhoivien'] = TochucHoptac::find()->orderBy('id_tcht')->all();
        $model['ptn']->linhvucChecked = ArrayHelper::getColumn($model['ptn']->getPhongthinghiemLinhvucs()->asArray()->all(), 'lv_id');
        $model['ptn']->chatluongChecked = ArrayHelper::getColumn($model['ptn']->getPhongthinghiemChatluongs()->asArray()->all(), 'cncl_id');
        $model['ptn']->hoivienChecked = ArrayHelper::getColumn($model['ptn']->getPhongthinghiemHoptacs()->asArray()->all(), 'tcht_id');
        $model['ptn']->tieuchuanChecked = ArrayHelper::getColumn($model['ptn']->getPhongthinghiemTieuchuans()->asArray()->all(), 'tc_id');
        $model['ptn']->phanloaiChecked = ArrayHelper::map($model['ptn']->getPhongthinghiemChungloais()->asArray()->all(), 'id_ptn_cl', 'pl_id', 'cl_id');

        if ($model['ptn']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['ptn']->updated_by = Yii::$app->user->id;
            $model['ptn']->updated_at = date('Y-m-d H:i:s');
            $model['ptn']->status = 2;
            $model['ptn']->save();
            UtilityService::alert('updated');
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkphongthinghiem/index'));
        }
        return $this->render('update2',[
            'model' => $model
        ]);
    }

    public function actionDelete($id = null){

        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkphongthinghiem/index'));
        }
        $request = Yii::$app->request;
        $model['phongthinghiem'] = PhongThiNghiem::find()->where(['id_ptn' => $id,'status' => 2])->one();
        if ($model['phongthinghiem'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkphongthinghiem/index'));
        }

        if ($request->isPost) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            //status = 0: xoa chuyen gia
            //status = 1: active chuyen gia
            //status = 2: active pdk chuyen gia
            //status = 3: xoa pdk chuyen gia
            $model['phongthinghiem']->status = 3;
            $model['phongthinghiem']->updated_by = Yii::$app->user->id;
            $model['phongthinghiem']->updated_at = date('Y-m-d H:i:s');
            $model['phongthinghiem']->validate();
            $model['phongthinghiem']->save();
            UtilityService::alert('delete');
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkphongthinghiem/index'));
        }
        return $this->renderPartial('delete',[
            'model' => $model
        ]);
    }
}

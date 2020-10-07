<?php

namespace app\controllers\user;

use app\controllers\base\AbstractTlkhcnController;
use app\controllers\base\AbstractUserController;
use app\models\chuyengia\Chuyengia;
use app\models\ChuyengiaChuyennganh;
use app\models\ChuyengiaLinhvuc;
use app\models\danhmuc\chuyengia\hocham\HocHam;
use app\models\danhmuc\chuyengia\hocvi\HocVi;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap1\LinhvucnghiencuuCap1;
use app\models\LinhvucnghiencuuCap3;
use app\models\SearchChuyengia;
use app\models\SearchChuyengiaChuyennganh;
use app\models\SearchChuyengiaLinhvuc;
use app\models\SearchLinhvucnghiencuuCap3;
use app\models\chuyengia\SearchPdkChuyengia;
use app\services\DebugService;
use app\services\UtilityService;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * DschuyengiaController implements the CRUD actions for VChuyengia model.
 */
class PdkchuyengiaController extends AbstractUserController
{

    public function actionIndex()
    {
        $searchModel = new SearchPdkChuyengia();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->user->id);
        $model['hocham'] = HocHam::find()->where(['status' => 1])->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->where(['status' => 1])->orderBy('ten_hv')->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionView($id = null){
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id,'status' => 2])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkchuyengia/index'));
        }
        return $this->renderPartial('view',[
            'model' => $model
        ]);
    }

    public function actionUpdate($id = null){
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id,'status' => 2])->one();
        $model['hocham'] = HocHam::find()->where(['status' => 1])->orderBy('ten_hh')->all();
        $model['hocvi'] = HocVi::find()->where(['status' => 1])->orderBy('ten_hv')->all();
        $model['linhvucnghiencuu'] = LinhvucnghiencuuCap1::find()->where(['status' => 1])->orderBy('id_cap1')->all();
        $model['chuyengia']->linhvucnghiencuu = ArrayHelper::getColumn($model['chuyengia']->chuyengiaLinhvucs, 'cap1_id');

        $model['chuyengia']->chuyennganh = ArrayHelper::map($model['chuyengia']->chuyengiaChuyennganhs, 'cap3_id', 'cap3.ma_ten_cap3');
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkchuyengia/index'));
        }

        if ($model['chuyengia']->load($request->post())) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model['chuyengia']->updated_by = Yii::$app->user->id;
            $model['chuyengia']->updated_at = date('Y-m-d H:i:s');
            $model['chuyengia']->status = 2;
            $model['chuyengia']->save();
            UtilityService::alert('update');
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkchuyengia/index'));
        }
        return $this->render('update',[
            'model' => $model
        ]);
    }

    public function actionDelete($id = null){

        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id,'status' => 2])->one();
        if ($model['chuyengia'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkchuyengia/index'));
        }

        if ($request->isPost) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            //status = 0: xoa chuyen gia
            //status = 1: active chuyen gia
            //status = 2: active pdk chuyen gia
            //status = 3: xoa pdk chuyen gia
            $model['chuyengia']->status = 3;
            $model['chuyengia']->updated_by = Yii::$app->user->id;
            $model['chuyengia']->updated_at = date('Y-m-d H:i:s');
            $model['chuyengia']->save();
            UtilityService::alert('delete');
            return $this->redirect(Yii::$app->urlManager->createUrl('user/pdkchuyengia/index'));
        }
        return $this->renderPartial('delete',[
            'model' => $model
        ]);
    }
}

<?php

namespace app\controllers\admin\capnhatchuyengia;

use app\controllers\base\AbstractAdminController;
use app\models\chuyengia\Chuyengia;
use app\models\chuyengia\ChuyengiaNgoaingu;
use app\models\danhmuc\chuyengia\ngoaingu\Ngoaingu;
use app\models\chuyengia\SearchChuyengiaNgoaingu;
use app\services\UtilityService;
use Yii;


class TrinhdongoainguController extends AbstractAdminController
{

    public function actionNgoaingu($id = null)
    {
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

        return $this->render('ngoaingu', [
            'model' => $model,
        ]);
    }

    public function actionCreate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['trinhdongoaingu'] = new ChuyengiaNgoaingu();
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        $model['ngoaingu'] = Ngoaingu::find()->orderBy('id_ngoaingu')->all();
        if ($model['trinhdongoaingu']->load($request->post())) {
            $model['trinhdongoaingu']->chuyengia_id = $model['chuyengia']->id_chuyengia;
            $model['trinhdongoaingu']->save();
            UtilityService::alert('created');
            return $this->redirect(['ngoaingu', 'id' => $model['chuyengia']->id_chuyengia]);
        } else {
            return $this->renderPartial('create', [
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
        $model['trinhdongoaingu'] = ChuyengiaNgoaingu::find()->with('chuyengia')->where(['id_chuyengiangoaingu' => $id])->one();
        $model['ngoaingu'] = Ngoaingu::find()->orderBy('id_ngoaingu')->all();
        if ($model['trinhdongoaingu']->load($request->post())) {
            $model['trinhdongoaingu']->chuyengia_id = $model['trinhdongoaingu']->chuyengia->id_chuyengia;
            $model['trinhdongoaingu']->save();
            UtilityService::alert('updated');
            return $this->redirect(['ngoaingu', 'id' => $model['trinhdongoaingu']->chuyengia->id_chuyengia]);
        } else {
            return $this->renderPartial('update', [
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
        $model['trinhdongoaingu'] = ChuyengiaNgoaingu::find()->with('ngoaingu','chuyengia')->where(['id_chuyengiangoaingu' => $id])->one();
        if ($model['trinhdongoaingu'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        if($request->isPost){
            $model['trinhdongoaingu']->delete();
            UtilityService::alert('deleted');
            return $this->redirect(['ngoaingu', 'id' => $model['trinhdongoaingu']->chuyengia->id_chuyengia]);
        }
        return $this->renderPartial('delete',[
            'model' => $model,
        ]);
    }
}

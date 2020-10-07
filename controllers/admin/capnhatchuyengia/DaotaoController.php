<?php

namespace app\controllers\admin\capnhatchuyengia;

use app\controllers\base\AbstractAdminController;
use app\models\chuyengia\Chuyengia;
use app\models\chuyengia\ChuyengiaDaotao;
use app\models\chuyengia\SearchChuyengiaDaotao;
use app\services\UtilityService;
use Yii;

class DaotaoController extends AbstractAdminController
{

    public function actionDaotao($id = null)
    {
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

    public function actionCreate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['daotao'] = new ChuyengiaDaotao();
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 1])->one();
        if ($model['daotao']->load($request->post())) {
            $model['daotao']->chuyengia_id = $model['chuyengia']->id_chuyengia;
            $model['daotao']->save();
            return $this->redirect(['daotao', 'id' => $model['chuyengia']->id_chuyengia]);
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
        $model['daotao'] = ChuyengiaDaotao::find()->with('chuyengia')->where(['id_chuyengiadaotao' => $id])->one();
        if ($model['daotao']->load($request->post())) {
            $model['daotao']->save();
            return $this->redirect(['daotao', 'id' => $model['daotao']->chuyengia->id_chuyengia]);
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
        $model['daotao'] = ChuyengiaDaotao::find()->with('chuyengia')->where(['id_chuyengiadaotao' => $id])->one();
        if ($model['daotao'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index'));
        }

        if($request->isPost){
            $model['daotao']->delete();
            return $this->redirect(['daotao', 'id' => $model['daotao']->chuyengia->id_chuyengia]);
        }
        return $this->renderPartial('delete',[
            'model' => $model,
        ]);
    }
}

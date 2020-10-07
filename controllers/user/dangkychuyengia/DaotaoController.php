<?php

namespace app\controllers\user\dangkychuyengia;

use app\controllers\base\AbstractUserController;
use app\models\chuyengia\Chuyengia;
use app\models\chuyengia\ChuyengiaDaotao;
use app\services\UtilityService;
use Yii;

class DaotaoController extends AbstractUserController
{

    public function actionCreate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['daotao'] = new ChuyengiaDaotao();
        $model['chuyengia'] = Chuyengia::find()->where(['id_chuyengia' => $id, 'status' => 2])->one();
        if ($model['daotao']->load($request->post())) {
            $model['daotao']->chuyengia_id = $model['chuyengia']->id_chuyengia;
            $model['daotao']->save();
            return $this->redirect(['user/chuyengia/daotao', 'id' => $model['chuyengia']->id_chuyengia]);
        } else {
            return $this->renderPartial('create', [
                'model' => $model,
            ]);
        }

    }

    public function actionUpdate($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['daotao'] = ChuyengiaDaotao::find()->with('chuyengia')->where(['id_chuyengiadaotao' => $id])->one();
        if ($model['daotao']->load($request->post())) {
            $model['daotao']->save();
            return $this->redirect(['user/chuyengia/daotao', 'id' => $model['daotao']->chuyengia->id_chuyengia]);
        } else {
            return $this->renderPartial('update', [
                'model' => $model,
            ]);
        }

    }

    public function actionDelete($id = null)
    {
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }
        $request = Yii::$app->request;
        $model['daotao'] = ChuyengiaDaotao::find()->with('chuyengia')->where(['id_chuyengiadaotao' => $id])->one();
        if ($model['daotao'] == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl('user/chuyengia/index'));
        }

        if($request->isPost){
            $model['daotao']->delete();
            return $this->redirect(['user/chuyengia/daotao', 'id' => $model['daotao']->chuyengia->id_chuyengia]);
        }
        return $this->renderPartial('delete',[
            'model' => $model,
        ]);
    }
}

<?php

namespace app\modules\quanly\controllers;

use app\modules\danhmuc\models\loainha\Loainha;
use app\modules\danhmuc\models\phuong\Phuong;
use app\modules\quanly\base\AbstractController;
use app\modules\quanly\models\can\ThongTinCan;
use app\modules\quanly\models\ho\ThongTinHo;
use app\modules\quanly\models\tailieu\TaiLieu;
use app\modules\quanly\models\tailieu\UploadFile;
use app\services\UtilService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\UploadedFile;

class TailieuController extends AbstractController
{

    public function actionDanhsach($id){
        if (!UtilService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('can/index'));
        }
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
        return $this->render('danhsach',[
            'model' => $model
        ]);
    }
    public function actionCreate($id = null)
    {
        $this->enableCsrfValidation = false;
        $request = Yii::$app->request;

        if($request->isAjax){
            $model['tailieu'] = new TaiLieu();
            $model['ho'] = ThongTinHo::findOne($id);
            $model['file'] = new UploadFile();

            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Thêm mới tài liệu</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Thêm mới',['class'=>'btn btn-success pull-left','type'=>"submit"])
                ];
            } elseif($request->isPost){
                $post = $request->post();
                $model['tailieu']->load($post);
                $model['tailieu']->id_ho = $model['ho']->id_ho;
                $model['tailieu']->save();
                $model['file']->a = UploadedFile::getInstance($model['file'], 'a');
                $model['file']->uploadFile($model['ho']->so_luu_kho, $model['tailieu']->id_tailieu, $post['ma']);
                return [
                    'redirect'=> Yii::$app->urlManager->createUrl(['quan-ly/ho/view','id' => $model['ho']->id_ho]),
                ];
            } else {
                return [
                    'title'=> "<b>Thêm mới tài liệu</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Thêm mới',['class'=>'btn btn-success pull-left','type'=>"submit"])
                ];
            }
        }
    }

    public function actionDelete($id = null)
    {
        $request = Yii::$app->request;
        $model = TaiLieu::findOne($id);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Xóa tài liệu</b>",
                    'content'=>$this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Xóa',['class'=>'btn btn-danger pull-left','type'=>"submit"])

                ];
            }else if($request->isPost && $model->delete()){
                return [
                    'redirect'=> Yii::$app->urlManager->createUrl(['quan-ly/ho/view','id' => $model['ho']->id_ho]),
                ];
            }else{
                return [
                    'title'=> "<b>Xóa tài liệu</b>",
                    'content'=>$this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                        Html::button('Xóa',['class'=>'btn btn-danger pull-left','type'=>"submit"])

                ];
            }
        }
    }
}

<?php

namespace app\controllers\danhmuc\phongthinghiem;

use app\controllers\base\AbstractAdminController;
use app\models\danhmuc\phongthinghiem\chungloai\ChungLoai;
use Yii;
use app\models\danhmuc\phongthinghiem\phanloai\PhanLoai;
use app\models\danhmuc\phongthinghiem\phanloai\SearchPhanloai;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * PhanloaiController implements the CRUD actions for PhanLoai model.
 */
class PhanloaiController extends AbstractAdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PhanLoai models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SearchPhanloai();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single PhanLoai model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "<b>Chi tiết Phân loại</b>",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                            Html::a('Cập nhật',['update','id'=>$id],['class'=>'btn btn-warning pull-left','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new PhanLoai model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new PhanLoai();
        $chungloai = ChungLoai::find()->all();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Thêm mới Phân loại</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'chungloai' => $chungloai,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Thêm mới',['class'=>'btn btn-success pull-left','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "<b>Thêm mới Phân loại</b>",
                    'content'=>'<span class="text-success">Thêm mới Phân loại thành công</span>',
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                            Html::a('Tiếp tục thêm mới',['create'],['class'=>'btn btn-success pull-left','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "<b>Thêm mới Phân loại</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'chungloai' => $chungloai,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Thêm mới',['class'=>'btn btn-success pull-left','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_pl]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'chungloai' => $chungloai,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing PhanLoai model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $chungloai = ChungLoai::find()->all();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Cập nhật Phân loại</b>",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'chungloai' => $chungloai,

                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Cập nhật',['class'=>'btn btn-warning pull-left','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "<b>Chi tiết Phân loại</b>",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                            Html::a('Cập nhật',['update','id'=>$id],['class'=>'btn btn-warning pull-left','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "<b>Chi tiết Phân loại</b>",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'chungloai' => $chungloai,

                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Cập nhật',['class'=>'btn btn-warning pull-left','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_pl]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'chungloai' => $chungloai,
                ]);
            }
        }
    }

    /**
     * Delete an existing PhanLoai model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
public function actionDelete($id)
{
$request = Yii::$app->request;
$this->findModel($id)->delete();

if($request->isAjax){
/*
*   Process for ajax request
*/
Yii::$app->response->format = Response::FORMAT_JSON;
return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
}else{
/*
*   Process for non-ajax request
*/
return $this->redirect(['index']);
}


}

     /**
     * Delete multiple existing PhanLoai model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the PhanLoai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhanLoai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhanLoai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

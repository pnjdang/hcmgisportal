<?php

namespace app\controllers\danhmuc\chuyengia;

use app\controllers\base\AbstractAdminController;
use app\services\UtilityService;
use Yii;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap1\LinhvucnghiencuuCap1;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap1\SearchLinhvucnghiencuuCap1;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
date_default_timezone_set('Asia/Ho_chi_minh');
/**
 * Linhvucnghiencuucap1Controller implements the CRUD actions for LinhvucnghiencuuCap1 model.
 */
class Linhvucnghiencuucap1Controller extends AbstractAdminController
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
//                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all LinhvucnghiencuuCap1 models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SearchLinhvucnghiencuuCap1();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single LinhvucnghiencuuCap1 model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "<b>Chi tiết Lĩnh vực nghiên cứu cấp 1</b>",
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
     * Creates a new LinhvucnghiencuuCap1 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new LinhvucnghiencuuCap1();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Thêm mới Lĩnh vực nghiên cứu cấp 1</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Thêm mới',['class'=>'btn btn-success pull-left','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $model->status = 1;
                $model->created_by = Yii::$app->user->id;
                $model->created_at = date('Y-m-d H:i:s');
                $model->save();

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "<b>Thêm mới Lĩnh vực nghiên cứu cấp 1</b>",
                    'content'=>'<span class="text-success">Thêm mới Lĩnh vực nghiên cứu cấp 1 thành công</span>',
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                            Html::a('Tiếp tục thêm mới',['create'],['class'=>'btn btn-success pull-left','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "<b>Thêm mới Lĩnh vực nghiên cứu cấp 1</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
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
                $model->status = 1;
                $model->created_by = Yii::$app->user->id;
                $model->created_at = date('Y-m-d H:i:s');
                $model->save();
                return $this->redirect(['view', 'id' => $model->id_cap1]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing LinhvucnghiencuuCap1 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Cập nhật Lĩnh vực nghiên cứu cấp 1</b>",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Cập nhật',['class'=>'btn btn-warning pull-left','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $model->status = 1;
                $model->updated_by = Yii::$app->user->id;
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "<b>Chi tiết Lĩnh vực nghiên cứu cấp 1</b>",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                            Html::a('Cập nhật',['update','id'=>$id],['class'=>'btn btn-warning pull-left','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "<b>Chi tiết Lĩnh vực nghiên cứu cấp 1</b>",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
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
                $model->status = 1;
                $model->updated_by = Yii::$app->user->id;
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
                return $this->redirect(['view', 'id' => $model->id_cap1]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing LinhvucnghiencuuCap1 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id = null)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->status = 0;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->id;
        $model->save();
        return $this->redirect(Yii::$app->urlManager->createUrl('linhvucnghiencuucap1/index'));
    }

     /**
     * Delete multiple existing LinhvucnghiencuuCap1 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */


    /**
     * Finds the LinhvucnghiencuuCap1 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LinhvucnghiencuuCap1 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LinhvucnghiencuuCap1::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLinhvuccap1($q = null, $id = null) {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = LinhvucnghiencuuCap1::find();
            $sqlWhere = "upper(ten_cap1) like '%' || upper('$q') || '%'";
//            DebugService::dumpdie($query->select("id_canhan AS id, concat(ho_ten, ' - ', NULL, dm_donvi.ten_donvi) AS text")->where($sqlWhere)->andWhere(['canhan.status' => 1]));
            $out['results'] = $query->select('id_cap1 AS id, ten_cap1 AS text')->where($sqlWhere)->andWhere(['status' => 1])->orderBy('id_cap1')->asArray()->all();
        }

        return $out;
    }
}

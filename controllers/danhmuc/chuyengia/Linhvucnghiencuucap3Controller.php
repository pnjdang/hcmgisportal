<?php

namespace app\controllers\danhmuc\chuyengia;

use app\controllers\base\AbstractAdminController;
use app\services\DebugService;
use Yii;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap3\LinhvucnghiencuuCap3;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap3\SearchLinhvucnghiencuuCap3;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * Linhvucnghiencuucap3Controller implements the CRUD actions for LinhvucnghiencuuCap3 model.
 */
class Linhvucnghiencuucap3Controller extends AbstractAdminController
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
     * Lists all LinhvucnghiencuuCap3 models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SearchLinhvucnghiencuuCap3();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single LinhvucnghiencuuCap3 model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "<b>Chi tiết Lĩnh vực nghiên cứu cấp 3</b>",
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
     * Creates a new LinhvucnghiencuuCap3 model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        date_default_timezone_set('Asia/Ho_chi_minh');
        $request = Yii::$app->request;
        $model['linhvuccap3'] = new LinhvucnghiencuuCap3();
        $model['linhvuccap2'] = (new Query())->select('id_cap2,ten_cap2,ten_cap1')
        ->from('linhvucnghiencuu_cap2')
        ->leftJoin('linhvucnghiencuu_cap1','linhvucnghiencuu_cap2.id_cap1 = linhvucnghiencuu_cap1.id_cap1')
        ->orderBy('linhvucnghiencuu_cap1.id_cap1')
        ->all();
        $model['linhvuccap2'] = ArrayHelper::map($model['linhvuccap2'],'id_cap2','ten_cap2','ten_cap1');
//DebugService::dumpdie($model['linhvuccap2']);
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Thêm mới Lĩnh vực nghiên cứu cấp 3</b>",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Thêm mới',['class'=>'btn btn-success pull-left','type'=>"submit"])
        
                ];         
            }else if($model['linhvuccap3']->load($request->post())){
                $model['linhvuccap3']->status = 1;
                $model['linhvuccap3']->created_by = Yii::$app->user->id;
                $model['linhvuccap3']->created_at = date('Y-m-d H:i:s');
                $model['linhvuccap3']->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "<b>Thêm mới Lĩnh vực nghiên cứu cấp 3</b>",
                    'content'=>'<span class="text-success">Thêm mới Lĩnh vực nghiên cứu cấp 3 thành công</span>',
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                            Html::a('Tiếp tục thêm mới',['create'],['class'=>'btn btn-success pull-left','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "<b>Thêm mới Lĩnh vực nghiên cứu cấp 3</b>",
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
            if ($model['linhvuccap3']->load($request->post())) {
                $model['linhvuccap3']->status = 1;
                $model['linhvuccap3']->created_by = Yii::$app->user->id;
                $model['linhvuccap3']->created_at = date('Y-m-d H:i:s');
                $model['linhvuccap3']->save();
                return $this->redirect(['view', 'id' => $model['linhvuccap3']->id_cap3]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing LinhvucnghiencuuCap3 model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model['linhvuccap3'] = $this->findModel($id);
        $model['linhvuccap2'] = (new Query())->select('id_cap2,ten_cap2,ten_cap1')
            ->from('linhvucnghiencuu_cap2')
            ->leftJoin('linhvucnghiencuu_cap1','linhvucnghiencuu_cap2.id_cap1 = linhvucnghiencuu_cap1.id_cap1')
            ->orderBy('linhvucnghiencuu_cap1.id_cap1')
            ->all();
        $model['linhvuccap2'] = ArrayHelper::map($model['linhvuccap2'],'id_cap2','ten_cap2','ten_cap1');
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<b>Cập nhật Lĩnh vực nghiên cứu cấp 3</b>",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Cập nhật',['class'=>'btn btn-warning pull-left','type'=>"submit"])
                ];         
            }else if($model['linhvuccap3']->load($request->post())){
                $model['linhvuccap3']->status = 1;
                $model['linhvuccap3']->updated_by = Yii::$app->user->id;
                $model['linhvuccap3']->updated_at = date('Y-m-d H:i:s');
                $model['linhvuccap3']->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "<b>Chi tiết Lĩnh vực nghiên cứu cấp 3</b>",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                            Html::a('Cập nhật',['update','id'=>$id],['class'=>'btn btn-warning pull-left','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "<b>Chi tiết Lĩnh vực nghiên cứu cấp 3</b>",
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
            if ($model['linhvuccap3']->load($request->post())) {
                $model['linhvuccap3']->status = 1;
                $model['linhvuccap3']->updated_by = Yii::$app->user->id;
                $model['linhvuccap3']->updated_at = date('Y-m-d H:i:s');
                $model['linhvuccap3']->save();
                return $this->redirect(['view', 'id' => $model->id_cap3]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing LinhvucnghiencuuCap3 model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->status = 0;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->id;
        $model->save();
        return $this->redirect(Yii::$app->urlManager->createUrl('linhvucnghiencuucap3/index'));


    }



    /**
     * Finds the LinhvucnghiencuuCap3 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LinhvucnghiencuuCap3 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LinhvucnghiencuuCap3::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLinhvuccap3($q = null, $id = null) {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = LinhvucnghiencuuCap3::find();
            $sqlWhere = "upper(ma_ten_cap3) like '%' || upper('$q') || '%'";
//            DebugService::dumpdie($query->select("id_canhan AS id, concat(ho_ten, ' - ', NULL, dm_donvi.ten_donvi) AS text")->where($sqlWhere)->andWhere(['canhan.status' => 1]));
            $out['results'] = $query->select('id_cap3 AS id, ma_ten_cap3 AS text')->where($sqlWhere)->andWhere(['status' => 1])->orderBy('id_cap3')->asArray()->all();
        }

        return $out;
    }
}

<?php

namespace app\controllers\admin;

use Yii;
use app\models\GisPosts;
use app\models\GisPostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use app\services\DebugService;

/**
 * GisPostsController implements the CRUD actions for GisPosts model.
 */
class GisPostsController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $this->layout = "@app/views/layouts/admin/main";
        
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
     * Lists all GisPosts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GisPostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$post_type = GisPosts::find()->select('post_type')->groupBy('post_type')->all();
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'post_type' => $post_type,
//           'const' => $this->const
        ]);
    }


    /**
     * Displays a single GisPosts model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Bài viết #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary pull-left','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
//                'const' => $this->const,
            ]);
        }
    }

    /**
     * Creates a new GisPosts model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new GisPosts();
        //DebugService::dumpdie($model);
        date_default_timezone_set('Asia/Ho_chi_minh');
        $model->post_date = date('Y-m-d H:i:s');
        $model->post_date_gmt = date('Y-m-d H:i:s');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new GisPosts",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary pull-left','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new GisPosts",
                    'content'=>'<span class="text-success">Create GisPosts success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary pull-left','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "Create new GisPosts",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary pull-left','type'=>"submit"])

                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->ID]);
            } else {
                return $this->render('create', [
                    'model' => $model,
//                    'const' => $this->const,
                ]);
            }
        }

    }

    /**
     * Updates an existing GisPosts model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        date_default_timezone_set('Asia/Ho_chi_minh');
        $model->post_modified = date('Y-m-d H:i:s');
        $model->post_modified_gmt = date('Y-m-d H:i:s');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật bài viết #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary pull-left','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Bài viết #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary pull-left','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Cập nhật bài viết #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-right','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary pull-left','type'=>"submit"])
                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->ID]);
            } else {
                return $this->render('update', [
                    'model' => $model,
//                    'const' => $this->const,
                ]);
            }
        }
    }

    /**
     * Delete an existing GisPosts model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
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
     * Finds the GisPosts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GisPosts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GisPosts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

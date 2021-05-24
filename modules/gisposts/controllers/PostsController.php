<?php

namespace app\modules\gisposts\controllers;

use app\modules\gisposts\models\categories\PostType;
use app\modules\gisposts\models\media\UploadForm;
use app\services\DebugService;
use Yii;
use app\modules\gisposts\models\posts\GisPosts;
use app\modules\gisposts\models\posts\SearchGisPosts;
use app\modules\gisposts\base\AbstractController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * PostsController implements the CRUD actions for GisPosts model.
 */
class PostsController extends AbstractController
{

    public $const;

    public function init()
    {
        $this->const = [
            'title' => 'Bài viết',
            'actions' => [
                'index' => [
                    'label' => 'Danh sách',
                    'url' => 'index',
                ],
                'create' => [
                    'label' => 'Thêm mới',
                    'url' => 'create',
                ],
                'update' => [
                    'label' => 'Cập nhật',
                    'url' => 'update',
                ],
                'update-test' => [
                    'label' => 'Cập nhật',
                    'url' => 'update',
                ],
                'view' => [
                    'label' => 'Chi tiết',
                    'url' => 'view',
                ],
                'statistic' => [
                    'label' => 'Thống kê',
                    'url' => 'statistic',
                ],
                'map' => [
                    'label' => 'Cập nhật vị trí',
                    'url' => 'map',
                ],
                'file' => [
                    'label' => 'Tài liệu',
                    'url' => 'file',
                ],
            ],
        ];

        parent::init();
    }

    /**
     * Lists all GisPosts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchGisPosts();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $categories['post_type'] = PostType::find()->orderBy('type_name')->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'const' => $this->const,
            'categories' => $categories,
        ]);
    }


    /**
     * Displays a single GisPosts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "GisPosts #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                    'const' => $this->const,
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary pull-left', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'const' => $this->const,
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
        $categories['post_type'] = PostType::find()->orderBy('type_name')->all();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new GisPosts",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'categories' => $categories,
                        'const' => $this->const,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Create new GisPosts",
                    'content' => '<span class="text-success">Create GisPosts success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary pull-left', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Create new GisPosts",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'categories' => $categories,
                        'const' => $this->const,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'categories' => $categories,
                    'const' => $this->const,
                ]);
            }
        }

    }

    /**
     * Updates an existing GisPosts model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $categories['post_type'] = PostType::find()->orderBy('type_name')->all();
        $image = new UploadForm();


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update GisPosts #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'categories' => $categories,
                        'const' => $this->const,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                $image->file = UploadedFile::getInstance($image, 'file');
                if ($image->uploadFileWithModel($model)) {
                    return [
                        'forceReload' => '#pjax-media-index',
                        'forceClose' => true,
                    ];
                }
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "GisPosts #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'const' => $this->const,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary pull-left', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update GisPosts #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'categories' => $categories,
                        'const' => $this->const,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $image->file = UploadedFile::getInstance($image, 'file');
                if($image->uploadFileWithModel($model,'images')){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'image' => $image,
                    'categories' => $categories,
                    'const' => $this->const,
                ]);
            }
        }
    }

    /**
     * Delete an existing GisPosts model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isPost) {
                $model->delete();
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'forceClose'=>true,
                ];

            }
        }
    }


    /**
     * Finds the GisPosts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
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

    public function actionUpdateTest($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $categories['post_type'] = PostType::find()->orderBy('type_name')->all();
        $image = new UploadForm();


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update GisPosts #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'categories' => $categories,
                        'const' => $this->const,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                $image->file = UploadedFile::getInstance($image, 'file');
                if ($image->uploadFileWithModel($model)) {
                    return [
                        'forceReload' => '#pjax-media-index',
                        'forceClose' => true,
                    ];
                }
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "GisPosts #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'const' => $this->const,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary pull-left', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update GisPosts #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'categories' => $categories,
                        'const' => $this->const,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $image->file = UploadedFile::getInstance($image, 'file');
                if($image->uploadFileWithModel($model,'Image')){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                return $this->render('update-test', [
                    'model' => $model,
                    'image' => $image,
                    'categories' => $categories,
                    'const' => $this->const,
                ]);
            }
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 5/4/2021
 * Time: 2:32 PM
 */

namespace app\modules\gisposts\controllers;


use app\modules\gisposts\models\media\FileType;
use \app\modules\gisposts\models\media\UploadForm;
use app\modules\gisposts\base\AbstractController;
use app\modules\gisposts\models\media\FileUpload;
use app\services\DebugService;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\UploadedFile;

class MediaController extends AbstractController
{
    public $const;

    public function init()
    {
        $this->const = [
            'title' => 'Media',
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

    public function actionIndex()
    {
        $this->layout = "@app/modules/gisposts/views/layouts/portfolio";

        $request = \Yii::$app->request;
        $queryParams = $request->queryParams;
        if (isset($queryParams['file_type'])) {
            $filetype = $queryParams['file_type'];
        } else {
            $filetype = null;
        }

//        $model = FileUpload::find()->filterWhere(['file_type' => $filetype])->orderBy('uploaded_at desc')->all();
        $query = FileUpload::find()->filterWhere(['file_type' => $filetype])->orderBy('uploaded_at desc');
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => 24]);
        $model = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'const' => $this->const,
            'model' => $model,
            'pagination' => $pagination,
        ]);
    }

    public function actionView($id)
    {
        $request = \Yii::$app->request;

        $model = FileUpload::findOne($id);
        if ($request->isAjax) {

            \Yii::$app->response->format = Response::FORMAT_JSON;

            return [
                'title' => 'View',
                'content' => $this->renderAjax('view', [
                    'model' => $model,
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]).
                    Html::a('Delete',['delete','id' => $id],['class'=>'btn btn-danger pull-left','role'=>'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreate()
    {
        $request = \Yii::$app->request;
        $model = new UploadForm();
        $filetypes = FileType::find()->all();

        if ($request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;

            if ($request->isGet) {
                return [
                    'title' => 'Thêm mới file',
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'filetypes' => $filetypes,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Upload', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])
                ];
            } elseif ($request->isPost && $model->load($request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->uploadFile()) {
                    return [
                        'forceReload' => '#pjax-media-index',
                        'forceClose' => true,
                    ];
                }
            } else {
                return [
                    'title' => 'Thêm mới file',
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'filetypes' => $filetypes,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Upload', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])
                ];
            }
        } else {
            if ($request->isPost && $model->load($request->post())) {

                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->uploadFile()) {
                    return $this->redirect(\Yii::$app->urlManager->createUrl(['cms/media/index']));
                }

            } else {
                return $this->render('create', [
                    'model' => $model,
                    'filetypes' => $filetypes,
                ]);
            }
        }
    }

    public function actionDelete($id){
        $request = \Yii::$app->request;
        $model = FileUpload::findOne($id);
        if ($request->isAjax) {

            \Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isPost){
                if(!file_exists($model->file_path)){
                    $model->delete();
                    return [
                        'forceReload' => '#pjax-media-index',
                        'forceClose' => true,
                    ];
                } elseif(unlink(realpath($model->file_path))){
                    $model->delete();
                    return [
                        'forceReload' => '#pjax-media-index',
                        'forceClose' => true,
                    ];
                } else {
                    return [
                        'title' => 'Delete',
                        'content' => $this->renderAjax('delete', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]).
                            Html::button('Delete', ['class' => 'btn btn-danger pull-left', 'type' => "submit"])
                    ];
                }
            } else {
                return [
                    'title' => 'Delete',
                    'content' => $this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]).
                        Html::button('Delete', ['class' => 'btn btn-danger pull-left', 'type' => "submit"])
                ];

            }

        } else {
            return $this->render('delete', [
                'model' => $model,
            ]);
        }
    }

    public function actionBrowse(){
        $request = \Yii::$app->request;
        $model = FileUpload::find()->orderBy('uploaded_at desc')->all();
        if($request->isAjax){
            \Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isGet){
                return [
                    'title' => 'Media',
                    'content' => $this->render('browse',[
                        'model' => $model
                    ]),
                ];
            }
        }
    }
}
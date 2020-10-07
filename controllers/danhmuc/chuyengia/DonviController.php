<?php

namespace app\controllers\danhmuc\chuyengia;

use app\controllers\base\AbstractAdminController;
use app\models\danhmuc\chuyengia\donvi\Donvi;
use app\models\danhmuc\chuyengia\nhomdonvi\Nhomdonvi;
use app\models\FileUpload;
use app\models\danhmuc\chuyengia\donvi\SearchDonvi;
use app\services\DebugService;
use Box\Spout\Common\Type;
use Box\Spout\Reader\ReaderFactory;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Đơn vịController implements the CRUD actions for Đơn vị model.
 */
class DonviController extends AbstractAdminController
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
     * Lists all Đơn vị models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchDonvi();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Đơn vị model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "<b>Chi tiết Đơn vị</b>",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                    Html::a('Cập nhật', ['update', 'id' => $id], ['class' => 'btn btn-warning pull-left', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Finds the Đơn vị model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Đơn vị the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Donvi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Đơn vị model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        date_default_timezone_set('Asia/Ho_chi_minh');
        $request = Yii::$app->request;
        $model['donvi'] = new Donvi();
        $model['nhomdonvi'] = Nhomdonvi::find()->where(['status' => 1])->orderBy('ten_nhomdonvi')->all();
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "<b>Thêm mới Đơn vị</b>",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Thêm mới', ['class' => 'btn btn-success pull-left', 'type' => "submit"])

                ];
            } else if ($model['donvi']->load($request->post())) {
                $model['donvi']->status = 1;
                $model['donvi']->created_at = date('Y-m-d H:i:s');
                $model['donvi']->created_by = Yii::$app->user->id;
                $model['donvi']->save();
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "<b>Thêm mới Đơn vị</b>",
                    'content' => '<span class="text-success">Thêm mới Đơn vị thành công</span>',
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::a('Tiếp tục thêm mới', ['create'], ['class' => 'btn btn-success pull-left', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "<b>Thêm mới Đơn vị</b>",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Thêm mới', ['class' => 'btn btn-success pull-left', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model['donvi']->load($request->post())) {
                $model['donvi']->status = 1;
                $model['donvi']->created_at = date('Y-m-d H:i:s');
                $model['donvi']->created_by = Yii::$app->user->id;
                $model['donvi']->save();
                return $this->redirect(['view', 'id' => $model['donvi']->id_donvi]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing Đơn vị model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id = null)
    {
        date_default_timezone_set('Asia/Ho_chi_minh');
        $request = Yii::$app->request;
        $model['donvi'] = $this->findModel($id);
        $model['nhomdonvi'] = Nhomdonvi::find()->where(['status' => 1])->orderBy('ten_nhomdonvi')->all();
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "<b>Cập nhật Đơn vị</b>",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Cập nhật', ['class' => 'btn btn-warning pull-left', 'type' => "submit"])
                ];
            } else if ($model['donvi']->load($request->post())) {
                $model['donvi']->updated_at = date('Y-m-d H:i:s');
                $model['donvi']->updated_by = Yii::$app->user->id;
                $model['donvi']->save();
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "<b>Chi tiết Đơn vị</b>",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::a('Cập nhật', ['update', 'id' => $id], ['class' => 'btn btn-warning pull-left', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "<b>Chi tiết Đơn vị</b>",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Cập nhật', ['class' => 'btn btn-warning pull-left', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_donvi]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Đơn vị model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

    /**
     * Delete multiple existing Đơn vị model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    public function actionDonvi($q = null, $id = null)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = Donvi::find();
            $sqlWhere = "upper(ten_donvi) like '%' || upper('$q') || '%'";
//            DebugService::dumpdie($query->select("id_canhan AS id, concat(ho_ten, ' - ', NULL, dm_donvi.ten_donvi) AS text")->where($sqlWhere)->andWhere(['canhan.status' => 1]));
            $out['results'] = $query->select('id_donvi AS id, ten_donvi AS text')->where($sqlWhere)->andWhere(['status' => 1])->asArray()->all();
        }

        return $out;
    }

    public function actionImport()
    {
        $model = new FileUpload();
        if (\Yii::$app->request->isPost) {
            date_default_timezone_set('Asia/Ho_chi_minh');
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->uploadFile();
            $inputFileName = \Yii::$app->basePath . '/uploads/file/import/' . $model->file->baseName . '.' . $model->file->extension;
            $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
            $reader->open($inputFileName);

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $i => $row) {
                    if ($i >= 2) {
                        $donvi = new Donvi();
                        $donvi->ten_donvi = $row[0];
                        $donvi->nguoidungdau = $row[1];
                        $donvi->dia_chi = $row[2];
                        $donvi->dien_thoai = (String)$row[3];
                        $donvi->fax = (String)$row[4];
                        $donvi->website = (String)$row[5];
                        $donvi->status = 1;
                        $donvi->created_at = date('Y-m-d H:i:s');
                        $donvi->created_by = Yii::$app->user->id;
                        if($donvi->validate()){
                            $donvi->save();
                        } else {
//                            DebugService::dumpdie($i);
                            DebugService::dumpdie($donvi->getErrors());
                        }
                    }
                }
            }
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('import', [
            'model' => $model,
        ]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/19/2021
 * Time: 3:31 PM
 */

namespace app\modules\quanly\controllers;


use app\modules\danhmuc\models\thoihan\Thoihan;
use app\modules\quanly\base\AbstractController;
use app\modules\quanly\base\Constants;
use app\modules\quanly\models\hopdong\GiaHan;
use app\modules\quanly\models\hopdong\Hopdong;
use yii\helpers\Html;
use yii\web\Response;
use Yii;

class GiaHanHopDongController extends AbstractController
{
    public $const;

    public function init()
    {
        $this->const = [
            'title' => 'Gia hạn hợp đồng',
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
                    'label' => 'Cập nhật thông tin',
                    'url' => 'update',
                ],
                'view' => [
                    'label' => 'Thông tin chi tiết',
                    'url' => 'view',
                ],
                'statistic' => [
                    'label' => 'Thống kê',
                    'url' => 'statistic',
                ],
                'list' => [
                    'label' => 'Lịch sử gia hạn hợp đồng',
                    'url' => 'list',
                ],
                'file' => [
                    'label' => 'Tài liệu',
                    'url' => 'file',
                ],
            ],
        ];
        parent::init();
    }

    public function actionList($id)
    {
        $request = Yii::$app->request;

        $model['giahan'] = GiaHan::find()->where(['id_hopdong' => $id])->orderBy('ngay_gia_han desc')->all();
        $model['hopdong'] = Hopdong::findOne($id);
        $model['can'] = $model['hopdong']->thongtinho->thongtincan;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Lịch sử gia hạn hợp đồng",
                'content' => $this->renderAjax('list', [
                    'model' => $model,
                ]),
                'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                    Html::a('Gia hạn hợp đồng', Yii::$app->urlManager->createUrl(['quan-ly/gia-han-hop-dong/create', 'id' => $id]), ['class' => 'btn btn-primary pull-left', 'role' => "modal-remote"])
            ];
        } else {
            return $this->render('list', [
                'model' => $model,
                'const' => $this->const,
            ]);

        }
    }

    public function actionCreate($id)
    {
        $request = Yii::$app->request;
        $model['giahan'] = new GiaHan();
        $model['giahan']->id_hopdong = $id;
        $hopdong = Hopdong::findOne($id);
        $model['giahan']->giathue = $hopdong->gia_thue;
        $model['giahan']->giagiam = $hopdong->gia_giam;
        $model['giahan']->giaphaitra = $hopdong->gia_phai_tra;
        $model['thoihan'] = Thoihan::find()->where(['status' => Constants::STATUS_ACTIVE])->orderBy('so_thang')->all();

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Gia hạn hợp đồng",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Gia hạn hợp đồng', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])
                ];
            } elseif ($model['giahan']->load($request->post()) && $model['giahan']->saveModel($hopdong)) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'redirect' => Yii::$app->urlManager->createUrl(['quan-ly/gia-han-hop-dong/list', 'id' => $model['giahan']->id_hopdong])
                ];
            } else {
                return [
                    'title' => "Gia hạn hợp đồng",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Gia hạn hợp đồng', ['class' => 'btn btn-primary pull-left', 'type' => "submit"])
                ];
            }

        }
    }

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model['giahan'] = GiaHan::findOne($id);
        $model['thoihan'] = Thoihan::find()->where(['status' => Constants::STATUS_ACTIVE])->orderBy('so_thang')->all();
        $hopdong = Hopdong::findOne($model['giahan']->id_hopdong);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Gia hạn hợp đồng",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Cập nhật', ['class' => 'btn btn-warning pull-left', 'type' => "submit"])
                ];
            } elseif ($model['giahan']->load($request->post()) && $model['giahan']->saveModel($hopdong)) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'redirect' => Yii::$app->urlManager->createUrl(['quan-ly/gia-han-hop-dong/list', 'id' => $model['giahan']->id_hopdong])
                ];
            } else {
                return [
                    'title' => "Gia hạn hợp đồng",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Cập nhật', ['class' => 'btn btn-warning pull-left', 'type' => "submit"])
                ];
            }

        } else {
            if ($model['giahan']->load($request->post()) && $model['giahan']->saveModel($hopdong)) {

            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model['giahan'] = GiaHan::findOne($id);
        $model['thoihan'] = Thoihan::find()->where(['status' => Constants::STATUS_ACTIVE])->orderBy('so_thang')->all();
        $hopdong = Hopdong::findOne($model['giahan']->id_hopdong);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isPost && $model['giahan']->deleteModel($hopdong)) {
                return [
                    'redirect' => Yii::$app->urlManager->createUrl(['quan-ly/gia-han-hop-dong/list', 'id' => $model['giahan']->id_hopdong])
                ];
            } else {
                return [
                    'title' => "Xóa Gia hạn hợp đồng",
                    'content' => $this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => "modal"]) .
                        Html::button('Xóa', ['class' => 'btn btn-danger pull-left', 'type' => "submit"])
                ];
            }

        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 10/13/2017
 * Time: 3:20 PM
 */

use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\DCrud\DCrudAsset;


DCrudAsset::register($this);

$requestedAction = Yii::$app->requestedAction;
$this->title = $const['actions'][$requestedAction->id]['label'];
$this->params['breadcrumbs'][] = ['label' => $const['actions']['index']['label'] . ' ' . $const['title'], 'url' => [$const['actions']['index']['url']]];
$this->params['breadcrumbs'][] = $model['can']->fulldiachi;
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="portlet box blue-steel">
                <div class="portlet-title">
                    <div class="caption">
                        <span>Chi tiết căn <?= $model['can']->so_nha . ' ' . $model['can']->ten_duong . ' ' . $model['phuong']->tenphuong ?></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <a class='btn btn-warning pull-right' role="modal-remote"
                               href='<?= Yii::$app->urlManager->createUrl(['quan-ly/ho/update', 'id' => $model['ho']->id_ho]) ?>'>Cập
                                nhật</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-scrollable-borderless">
                                <tr>
                                    <th>Người đang thuê</th>
                                    <td colspan="3"><?= ($model['ho']->hopdonghientai != null) ? $model['ho']->hopdonghientai->nguoi_thue : 'Chưa có người thuê' ?></td>
                                </tr>
                                <tr>
                                    <th>Số lưu kho</th>
                                    <td><?= $model['ho']->so_luu_kho ?></td>
                                    <th>Cấp nhà</th>
                                    <td><?= $model['ho']->cap_nha ?></td>
                                </tr>
                                <tr>
                                    <th>Vị trí</th>
                                    <td><?= $model['ho']->vi_tri ?></td>
                                    <th>Diện tích sử dụng</th>
                                    <td colspan="3"><?= $model['ho']->dien_tich_su_dung ?></td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td colspan="5"><?= $model['ho']->ghi_chu ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <?= GridView::widget([
                'id' => 'crud-datatable2',
                'dataProvider' => $model['hopdong'],
                'pjax' => false,
                'columns' => [
                    [
                        'class' => 'kartik\grid\SerialColumn',
                        'width' => '30px',
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'so_hop_dong',
                        'label' => 'Số hợp đồng',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return "<a role='modal-remote' href='" . Yii::$app->urlManager->createUrl(['quan-ly/hopdong/view','id' => $model->id_hopdong]) ."'>" . $model->so_hop_dong . "</a>";
                        }
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'nguoi_thue',
                        'label' => 'Người thuê',
//                            'format' => 'raw',
//                            'value' => function($models){
//                                return ($models->loai_tai_lieu != null) ? $models->loai_tai_lieu : '';
//                            }
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'ghi_chu',
                        'label' => 'Ghi chú',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return ($model->ghi_chu != null) ? $model->ghi_chu : '';
                        }
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'vAlign' => 'middle',
                        'width' => '200px',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            return Url::to(['hopdong/' . $action, 'id' => $key]);
                        },
                        'template' => '{view}{update}{extend}{delete}',
                        'buttons' => [
                            'view' => function ($url) {
                                return Html::a("<span class='fa fa-eye'></span>", $url, ['class' => " btn btn-xs btn-info", 'title' => 'Chi tiết']);
                            },
                            'update' => function ($url) {
                                return Html::a("<span class='fa fa-pencil'></span>", $url, ['class' => " btn btn-xs btn-warning", 'title' => 'Cập nhật', 'role' => 'modal-remote']);
                            },
                            'extend' => function ($url) {
                                return Html::a("<span class='fa fa-plus-circle'></span>", $url, ['class' => " btn btn-xs btn-primary", 'title' => 'Gia hạn', 'role' => 'modal-remote']);
                            },
                            'delete' => function ($url) {
                                return Html::a("<span class='fa fa-trash'></span>", $url, ['class' => " btn btn-xs btn-danger", 'title' => 'Xóa', 'role' => 'modal-remote', 'data-pjax' => 0]);
                            }
                        ],
                    ],
                ],
                'toolbar' => [
                    ['content' =>
                        Html::a('Lập hợp đồng', Yii::$app->urlManager->createUrl(['quan-ly/hopdong/create', 'id' => $model['ho']->id_ho]), ['class' => 'btn btn-success'])
                    ],
                ],
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'panel' => [
                    'type' => 'primary',
                    'headingOptions' => ['class' => 'panel-heading bg-blue-steel'],
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách hợp đồng',
                    'after' => false,
                ]
            ]) ?>
        </div>

        <div class="col-lg-12">
            <?= GridView::widget([
                'id' => 'crud-datatable',
                'dataProvider' => $model['tailieu'],
                'pjax' => false,
                'columns' => [
                    [
                        'class' => 'kartik\grid\SerialColumn',
                        'width' => '30px',
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'ten_tai_lieu',
                        'label' => 'Tên',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return ($model->ten_tai_lieu != null) ? $model->ten_tai_lieu : '';
                        }
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'loai_tai_lieu',
                        'label' => 'Loại',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return ($model->loai_tai_lieu != null) ? $model->loai_tai_lieu : '';
                        }
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'so_tai_lieu',
                        'label' => 'Số',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return ($model->so_tai_lieu != null) ? $model->so_tai_lieu : '';
                        }
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'ngay_tai_lieu',
                        'label' => 'Ngày',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return ($model->ngay_tai_lieu != null) ? date('d-m-Y', strtotime($model->ngay_tai_lieu)) : '';
                        }
                    ],

                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'noi_dung',
                        'label' => 'Nội dung',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return ($model->noi_dung != null) ? $model->noi_dung : '';
                        }
                    ],
                    [
                        'label' => 'Thao tác',
                        'value' => function ($model) {
                            $viewButton = "<a href='" . Yii::$app->homeUrl . $model->duong_dan . "' target='_blank' class='btn btn-info btn-xs'><i class='fa fa-eye'></i></a>";
                            $updateButton = "<a class='btn btn-warning btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('ho/update') . '?id=' . $model->id_tailieu . "'><i class='fa fa-pencil'></i></a>";
                            $deleteButton = Html::a('<span class="fa fa-trash"></span>', Yii::$app->urlManager->createUrl(['quan-ly/tailieu/delete', 'id' => $model->id_tailieu]), ['class' => 'btn btn-danger btn-xs','role' => 'modal-remote']);
                            return $viewButton . $deleteButton;
                        },
                        'format' => 'raw'
                    ],
                ],
                'toolbar' => [
                    ['content' =>
                        Html::a('Thêm mới tài liệu', Yii::$app->urlManager->createUrl(['quan-ly/tailieu/create', 'id' => $model['ho']->id_ho]), ['class' => 'btn btn-success','role' => 'modal-remote']).
                        '{toggleData}' .
                        '{export}'
                    ],
                ],
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'panel' => [
                    'type' => 'primary',
                    'headingOptions' => ['class' => 'panel-heading bg-blue-steel'],
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách tài liệu',
                    'after' => false,
                ]
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 form-group">
            <a class="btn btn-default pull-right"
               href="<?= Yii::$app->urlManager->createUrl(['quan-ly/can/view', 'id' => $model['can']->id_can]) ?>">Quay
                lại</a>
        </div>
    </div>

<?php Modal::begin([
    "id" => "ajaxCrudModal",
    'size' => Modal::SIZE_LARGE,
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>
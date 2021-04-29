<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 10/13/2017
 * Time: 3:20 PM
 */
use kartik\grid\GridView;

?>

<div id="page-content">
    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?= Yii::$app->homeUrl ?>">Trang chủ</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl('can/index') ?>">Danh sách căn</a></li>
            <li class="active"><?= ($model['ho'] != null) ? $model['ho']->thongtincan->so_nha . ' ' . $model['ho']->thongtincan->ten_duong . ' ' . $model['ho']->thongtincan->phuong->tenphuong : '' ?></li>
            <li class="active"><?= ($model['ho']->hopdong != null) ? $model['ho']->hopdong->nguoi_thue : $model['ho']->nguoi_thue ?></li>

        </ol>
    </div>
    <!-- end Breadcrumb -->

    <div class="container">
        <div class="row">

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
                                $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('tailieu/delete') . '?id=' . $model->id_tailieu . "'><i class='fa fa-trash'></i></a>";
                                return $viewButton . $updateButton . $deleteButton;
                            },
                            'format' => 'raw'
                        ],
                    ],
                    'toolbar' => [
                        ['content' =>
                            "<a class='btn btn-success custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('tailieu/create') . '?id=' . $model['ho']->id_ho . "'>Thêm mới</a>" .
                            '{toggleData}' .
                            '{export}'
                        ],
                    ],
                    'striped' => true,
                    'condensed' => true,
                    'responsive' => true,
                    'panel' => [
                        'type' => 'primary',
                        'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách tài liệu',
                        'after' => false,
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="ajaxModalContent">

        </div>
    </div>
</div>
<?php

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\VChuyengia */
?>
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="<?= Yii::$app->homeUrl ?>">Trang chủ</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index') ?>">Danh sách chuyên gia</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active"><?= $model['chuyengia']->ho_ten ?></span>
    </li>
</ul>

<div class="row">
    <div class="col-lg-12">
        <script type="text/javascript">
            $(document).ready(function () {
                $('#notice').delay(5000).fadeOut();
            });
        </script>
        <?php $updated = Yii::$app->session->getFlash('updated') ?>
        <?php if (isset($updated)): ?>
            <div class="portlet box green" id="notice">
                <div class="portlet-title">
                    <div class="caption"><span class="fa fa-check-circle-o"></span> Cập nhật trình độ ngoại ngữ thành công!
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php $created = Yii::$app->session->getFlash('created') ?>
        <?php if (isset($created)): ?>
            <div class="portlet box green" id="notice">
                <div class="portlet-title">
                    <div class="caption"><span class="fa fa-check-circle-o"></span> Thêm mới trình độ ngoại ngữ thành công!
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php $deleted = Yii::$app->session->getFlash('deleted') ?>
        <?php if (isset($deleted)): ?>
            <div class="portlet box green" id="notice">
                <div class="portlet-title">
                    <div class="caption"><span class="fa fa-check-circle-o"></span> Xóa trình độ ngoại ngữ thành công!
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="uppercase">Trình độ ngoại ngữ</span>
                </div>
                <div class="caption pull-right">
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/update') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Thông
                        tin chi tiết</a>
                    <a class="btn btn-primary"
                       href="<?= Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/trinhdongoaingu/ngoaingu') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Ngoại
                        ngữ</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/congtrinh/congtrinh') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Công
                        trình nghiên cứu</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/congtac/congtac') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Công
                        tác</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/daotao/daotao') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Đào
                        tạo</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/detai/detai') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Đề
                        tài</a>
                </div>
            </div>

            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?=
                    GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $model['trinhdongoaingu'],
                        'filterModel' => $model['search'],
                        'pjax' => true,
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn',
                                'width' => '30px',
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'width' => '600px',
                                'attribute' => 'ngoaingu_id',
                                'label' => 'Tên ngoại ngữ',
                                'value' => function ($model) {
                                    return ($model->ngoaingu != null) ? $model->ngoaingu->ten_ngoaingu : '';
                                },
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ArrayHelper::map($model['ngoaingu'], 'id_ngoaingu', 'ten_ngoaingu'),
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'Tất cả'],
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'nghe',
                                'label' => 'Nghe',
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ['Tốt' => 'Tốt', 'Khá' => 'Khá', 'Trung bình' => 'Trung bình'],
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'Tất cả'],
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'noi',
                                'label' => 'Nói',
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ['Tốt' => 'Tốt', 'Khá' => 'Khá', 'Trung bình' => 'Trung bình'],
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'Tất cả'],
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'doc',
                                'label' => 'Đọc',
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ['Tốt' => 'Tốt', 'Khá' => 'Khá', 'Trung bình' => 'Trung bình'],
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'Tất cả'],
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'viet',
                                'label' => 'Viết',
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ['Tốt' => 'Tốt', 'Khá' => 'Khá', 'Trung bình' => 'Trung bình'],
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'Tất cả'],
                                'format' => 'raw'
                            ],
                            [
                                'label' => 'Thao tác',
                                'width' => '100px',
                                'value' => function ($model) {
                                    $updateButton = "<a class='btn btn-warning btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/trinhdongoaingu/update') . '?id=' . $model->id_chuyengiangoaingu . "'><i class='fa fa-pencil'></i></a>";
                                    $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/trinhdongoaingu/delete') . '?id=' . $model->id_chuyengiangoaingu . "'><i class='fa fa-trash'></i></a>";
                                    return $updateButton . $deleteButton;
                                },
                                'format' => 'raw'
                            ],
                        ],
                        'toolbar' => false,
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'type' => 'primary',
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách trình độ ngoại ngữ',
                            'after' => "<a class='btn btn-success btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/trinhdongoaingu/create') . '?id=' . $model['chuyengia']->id_chuyengia . "'><i class='fa fa-plus'></i> Thêm mới</a>",
                            'footer' => false
                        ]
                    ])
                    ?>
                </div>
                <div class="col-lg-12">
                    <a class="btn btn-default pull-left"
                       href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/ngoaingu') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Quay lại</a>
                    <a class="btn btn-default pull-right"
                       href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index') ?>">Danh sách chuyên
                        gia</a>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 50%">
        <div class="modal-content" id="ajaxModalContent" style="padding: 0">

        </div>
    </div>
</div>
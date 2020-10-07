<?php

use kartik\grid\GridView;

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
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="uppercase">Đề tài</span>
                </div>
                <div class="caption pull-right">
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/view').'?id='.$model['chuyengia']->id_chuyengia?>">Thông tin chi tiết</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/ngoaingu').'?id='.$model['chuyengia']->id_chuyengia?>">Ngoại ngữ</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/congtrinh').'?id='.$model['chuyengia']->id_chuyengia?>">Công trình nghiên cứu</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/congtac').'?id='.$model['chuyengia']->id_chuyengia?>">Công tác</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/daotao').'?id='.$model['chuyengia']->id_chuyengia?>">Đào tạo</a>
                    <a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/detai').'?id='.$model['chuyengia']->id_chuyengia?>">Đề tài</a>
                </div>
            </div>

            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?=
                    GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $model['detai'],
                        'filterModel' => $model['search'],
                        'pjax' => true,
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn',
                                'width' => '30px',
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'width' => '40%',
                                'attribute' => 'ten_detai',
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'width' => '80px',
                                'attribute' => 'nam_batdau',
                                'format' => 'raw',
                                'label' => 'Bắt đầu'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'width' => '80px',
                                'attribute' => 'nam_ketthuc',
                                'format' => 'raw',
                                'label' => 'Kết thúc'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'chuong_trinh',
                                'format' => 'raw',
                                'label' => 'Chương trình'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'tinh_trang',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->tinh_trang == 0 ? 'Chưa nghiệm thu' : 'Đã nghiệm thu';
                                },
                                'label' => 'Tình trạng',
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => [1 => 'Đã nghiệm thu', 0 => 'Chưa nghiệm thu'],
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'Tất cả'],
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'width' => '200px',
                                'attribute' => 'vai_tro',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->vai_tro == 1 ? 'Chủ trì' : ('Tham gia <br>' . ($model->noi_dung != null ? '(' . $model->noi_dung . ')' : ''));
                                },
                                'label' => 'Vai trò',
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => [1 => 'Chủ trì', 2 => 'Tham gia'],
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'Tất cả'],

                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'xep_loai',
                                'format' => 'raw',
                                'label' => 'Xếp loại'
                            ],

                        ],
                        'toolbar' => false,
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'type' => 'primary',
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Đề tài',
                            'after' => "<a class='btn btn-success btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('detai/create') . '?id=' . $model['chuyengia']->id_chuyengia . "'><i class='fa fa-plus'></i> Thêm mới</a>",
                            'footer' => false
                        ]
                    ])
                    ?>
                </div>
                <div class="col-lg-12">
                    <a class="btn btn-warning pull-left"
                       href="<?= Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/detai/detai') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Cập
                        nhật thông tin</a>
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
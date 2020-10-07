<?php

use johnitvn\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DschuyengiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Chuyên gia';

$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('admin/site/index') ?>">Tổng quan</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index') ?>">Danh sách tổng hợp</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/chuyennganh') ?>">Danh sách theo chuyên ngành</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active uppercase"><?= $model['linhvuccap3']->ten_cap3?></span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div id="ajaxCrudDatatableChuyennganhchitiet">
                    <?=
                    GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'pjax' => true,
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn',
                                'width' => '30px',
                            ],

                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ho_ten',
                                'width' => '250px',
                                'value' => function ($model) {
                                    $viewButton = "<a href='" . Yii::$app->urlManager->createUrl('admin/chuyengia/view') . "?id=" . $model->id_chuyengia . "'>" . $model->ho_ten . "</a>";
                                    return $viewButton;
                                },
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'nam_sinh',
                                'width' => '80px',
                                'value' => function ($model, $key, $index, $widget) {
                                    if ($model->nam_sinh == '') {
                                        return '';
                                    } else {
                                        return $model->nam_sinh;
                                    }

                                },
                                'format' => 'raw'
                            ],
                            [
                                'attribute' => 'gioi_tinh',
                                'width' => '100px',
                                'value' => function ($model, $key, $index, $widget) {
                                    if ($model->gioi_tinh == 1) {
                                        $gioitinh = 'Nam';
                                    } else {
                                        $gioitinh = 'Nữ';
                                    }
                                    return $gioitinh;
                                },
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => [1 => 'Nam', 2 => 'Nữ'],
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => ''],
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ten_donvi',
                                'value' => function ($model, $key, $index, $widget) {
                                    if ($model->donvi != null) {
                                        return $model->donvi->ten_donvi;
                                    } else {
                                        return '';
                                    }

                                },
                                'format' => 'raw',
                                'label' => 'Đơn vị'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'diachi_nharieng',
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ten_hh',
                                'width' => '100px',
                                'value' => function ($model, $key, $index, $widget) {
                                    if ($model->hocham != null) {
                                        return $model->hocham->ten_hh;
                                    } else {
                                        return '';
                                    }
                                },
                                'format' => 'raw',
                                'label' => 'Học hàm'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ten_hv',
                                'width' => '100px',
                                'value' => function ($model, $key, $index, $widget) {
                                    if ($model->hocvi != null) {
                                        return $model->hocvi->ten_hv;
                                    } else {
                                        return '';
                                    }
                                },
                                'format' => 'raw',
                                'label' => 'Học vị'
                            ],
                            [
                                'label' => 'Thao tác',
                                'width' => '100px',
                                'value' => function ($model) {
                                    $viewButton = "<a href='" . Yii::$app->urlManager->createUrl('admin/chuyengia/view') . '?id=' . $model->id_chuyengia . "' class='btn btn-info btn-xs'><i class='fa fa-eye'></i></a>";
                                    $updateButton = "<a href='" . Yii::$app->urlManager->createUrl('admin/chuyengia/update') . '?id=' . $model->id_chuyengia . "' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a>";
                                    $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('admin/chuyengia/delete') . '?id=' . $model->id_chuyengia . "'><i class='fa fa-trash'></i></a>";
                                    return $viewButton . $updateButton . $deleteButton;
                                },
                                'format' => 'raw'
                            ],

                        ],
                        'toolbar' => [
                            ['content' =>
                                '{toggleData}' .
                                '{export}'
                            ],
                        ],
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'type' => 'primary',
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách chuyên gia theo chuyên ngành <span class="uppercase">' . $model['linhvuccap3']->ten_cap3 . '</span>',
                            'after' => false,
                        ]
                    ])
                    ?>
                    <?php
                    Modal::begin([
                        "id" => "ajaxCrudModal",
                        'size' => Modal::SIZE_LARGE,
                        "footer" => "", // always need it for jquery plugin
                    ])
                    ?>
                    <?php Modal::end(); ?>
                    <div class="col-lg-12">
                        <a class="btn btn-default pull-right"
                           href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/chuyennganh') ?>">Quay
                            lại</a>
                    </div>
                    <div style="clear: both"
                    ">
                </div>

                <div style="clear: both"></div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ajaxModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: auto">
        <div class="modal-content container" id="ajaxModalContent" style="padding: 0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Chi tiết') ?></h4>
            </div>
            <div class="modal-body custom-ajax-form" id="ajaxModalBody">
            </div>
        </div>
    </div>
</div>
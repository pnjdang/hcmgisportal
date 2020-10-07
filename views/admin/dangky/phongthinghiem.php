<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DschuyengiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Chuyên gia';

$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?=
                    GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'pjax' => false,
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn',
                                'width' => '30px',
                            ],

                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ten_tv',
                                'width' => '250px',
                                'value' => function ($model, $key, $index, $widget) {
                                    return "<a>".mb_strtoupper($model->ten_tv)."</a>";
                                },
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ten_ta',
                                'width' => '250px',
                                'value' => function ($model, $key, $index, $widget) {
                                    return "<a>".mb_strtoupper($model->ten_tv)."</a>";
                                },
                                'format' => 'raw'
                            ],

                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'dai_dien',

                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'dia_chi',

                                'format' => 'raw'
                            ],
//                            [
//                                'class' => '\kartik\grid\DataColumn',
//                                'attribute' => 'created_by',
//                                'value' => function ($model, $key, $index, $widget) {
//                                    return $model->taikhoan->ten_dang_nhap;
//                                },
//                                'label' => 'Người đăng ký',
//                                'format' => 'raw'
//                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'created_at',
                                'value' => function ($model, $key, $index, $widget) {
                                    return ($model->created_at != null) ? date('d-m-Y H:i:s', strtotime($model->created_at)) : '';
                                },
                                'label' => 'Thời gian đăng ký',
                                'format' => 'raw'
                            ],
                            [
                                'label' => 'Thao tác',
                                'width' => '100px',
                                'value' => function ($model) {
                                    $viewButton = "<a href='" . Yii::$app->urlManager->createUrl('admin/dangky/viewchuyengia') . '?id=' . $model->id_ptn . "' class='btn btn-info btn-xs'><i class='fa fa-eye'></i></a>";
                                    $updateButton = "<a href='" . Yii::$app->urlManager->createUrl('admin/dangky/updatephongthinghiem') . '?id=' . $model->id_ptn . "' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a>";
                                    $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('admin/chuyengia/delete') . '?id=' . $model->id_ptn . "'><i class='fa fa-trash'></i></a>";
                                    return $updateButton;
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
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách phiếu đăng ký phòng thí nghiệm',
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
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="ajaxModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 40%">
        <div class="modal-content" id="ajaxModalContent" style="padding: 0">

        </div>
    </div>
</div>
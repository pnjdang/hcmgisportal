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
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('admin/site/index') ?>">Tổng quan</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/index') ?>">Danh sách tổng hợp</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/linhvuc') ?>">Danh sách theo lĩnh vực</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active uppercase"><?= $model['linhvucthunghiem']->ten_lv?></span>
    </li>
</ul>
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
                        'pjax' => true,
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn',
                                'width' => '30px',
                            ],

                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ten_tv',
                                'width' => '250px',
                                'value' => function($model){
                                    $viewButton = "<a href='".Yii::$app->urlManager->createUrl('admin/phongthinghiem/view')."?id=".$model->ptn->id_ptn."'>".$model->ptn->ten_tv."</a>";
                                    return $viewButton;
                                },
                                'format' => 'raw',
                                'label' => 'Tên tiếng Việt'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ten_ta',
                                'width' => '250px',
                                'value' => function($model){
                                    $viewButton = "<a href='".Yii::$app->urlManager->createUrl('admin/phongthinghiem/view')."?id=".$model->ptn->id_ptn."'>".$model->ptn->ten_ta."</a>";
                                    return $viewButton;
                                },
                                'format' => 'raw',
                                'label' => 'Tên tiếng Anh'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'coquan_chuquan',
                                'value' => function($model){
                                    return $model->ptn->coquan_chuquan;
                                },
                                'format' => 'raw',
                                'label' => 'Cơ quan chủ quản'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'dia_chi',
                                'value' => function($model){
                                    return $model->ptn->dia_chi;
                                },
                                'format' => 'raw',
                                'label' => 'Địa chỉ'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'dai_dien',
                                'value' => function($model){
                                    return $model->ptn->dai_dien;
                                },
                                'format' => 'raw',
                                'label' => 'Đại diện'
                            ],
                            [
                                'label' => 'Thao tác',
                                'width' => '100px',
                                'value' => function ($model) {
                                    $viewButton = "<a href='" . Yii::$app->urlManager->createUrl('admin/phongthinghiem/view') . '?id=' . $model->ptn->id_ptn . "' class='btn btn-info btn-xs'><i class='fa fa-eye'></i></a>";
                                    $updateButton = "<a href='" . Yii::$app->urlManager->createUrl('admin/phongthinghiem/update') . '?id=' . $model->ptn->id_ptn . "' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a>";
                                    $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('admin/phongthinghiem/delete') . '?id=' . $model->ptn->id_ptn . "'><i class='fa fa-trash'></i></a>";
                                    return $viewButton . $updateButton . $deleteButton;
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
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách phòng thí nghiệm theo lĩnh vực <span class="uppercase">'. $model['linhvucthunghiem']->ten_lv . '</span>',
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
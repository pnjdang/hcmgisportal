<?php

use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use johnitvn\ajaxcrud\CrudAsset;
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
        <span class="active"><?= $model['chuyengia']->ho_ten?></span>
    </li>
</ul>

<div class="row">
    <div class="col-lg-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="uppercase">Trình độ ngoại ngữ</span>
                </div>
                <div class="caption pull-right">
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/view').'?id='.$model['chuyengia']->id_chuyengia?>">Thông tin chi tiết</a>
                    <a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/trinhdongoaingu').'?id='.$model['chuyengia']->id_chuyengia?>">Ngoại ngữ</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/congtrinh').'?id='.$model['chuyengia']->id_chuyengia?>">Công trình nghiên cứu</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/congtac').'?id='.$model['chuyengia']->id_chuyengia?>">Công tác</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/daotao').'?id='.$model['chuyengia']->id_chuyengia?>">Đào tạo</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/detai').'?id='.$model['chuyengia']->id_chuyengia?>">Đề tài</a>
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
                                'value' => function($model){
                                    return ($model->ngoaingu != null) ? $model->ngoaingu->ten_ngoaingu : '';
                                },
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ArrayHelper::map($model['ngoaingu'],'id_ngoaingu', 'ten_ngoaingu'),
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
                                'filter' => ['Tốt' => 'Tốt','Khá' => 'Khá','Trung bình' => 'Trung bình'],
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
                                'filter' => ['Tốt' => 'Tốt','Khá' => 'Khá','Trung bình' => 'Trung bình'],
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
                                'filter' => ['Tốt' => 'Tốt','Khá' => 'Khá','Trung bình' => 'Trung bình'],
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
                                'filter' => ['Tốt' => 'Tốt','Khá' => 'Khá','Trung bình' => 'Trung bình'],
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'Tất cả'],
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
                            'after' => false,
                        ]
                    ])
                    ?>
                </div>
                <div class="col-lg-12">
                    <a class="btn btn-warning pull-left"
                       href="<?= Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/trinhdongoaingu/ngoaingu') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Cập
                        nhật thông tin</a>
                    <a class="btn btn-default pull-right"
                       href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index') ?>">Danh sách chuyên gia</a>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
</div>

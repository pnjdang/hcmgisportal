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
        <a href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/index') ?>">Danh sách chuyên gia</a>
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
                    <span class="uppercase">Công trình nghiên cứu</span>
                </div>
                <div class="caption pull-right">
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/'.$model['controller'].'/update') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Thông
                        tin chi tiết</a>                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/ngoaingu').'?id='.$model['chuyengia']->id_chuyengia?>">Ngoại ngữ</a>
                    <a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/congtrinh').'?id='.$model['chuyengia']->id_chuyengia?>">Công trình nghiên cứu</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/congtac').'?id='.$model['chuyengia']->id_chuyengia?>">Công tác</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/daotao').'?id='.$model['chuyengia']->id_chuyengia?>">Đào tạo</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/detai').'?id='.$model['chuyengia']->id_chuyengia?>">Đề tài</a>
                    <?php if($model['chuyengia']->created_by == Yii::$app->user->id):?>
                        <a class="btn btn-default"
                           href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/congbo') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Công bố thông tin</a>
                    <?php endif?>
                </div>
            </div>

            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?=
                    GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $model['congtrinh'],
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
                                'attribute' => 'ten_congtrinh',
                                'label' => 'Tên công trình',
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'nam',
                                'label' => 'Năm công bố',
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'width' => '170px',
                                'attribute' => 'loaicongtrinh_id',
                                'label' => 'Loại công trình',
                                'filter'=> ArrayHelper::map($model['loaicongtrinh'], 'id_loaicongtrinh', 'ten_loaicongtrinh'),
                                'value' => function($model){
                                    return ($model->loaicongtrinh != null) ? $model->loaicongtrinh->ten_loaicongtrinh : '';
                                },
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'tac_gia',
                                'label' => 'Tác giả',
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'noi_congbo',
                                'label' => 'Nơi công bố',
                                'format' => 'raw'
                            ],
                            [
                                'label' => 'Thao tác',
                                'width' => '100px',
                                'value' => function ($model) {
                                    $updateButton = "<a class='btn btn-warning btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('user/dangkychuyengia/congtrinh/update') . '?id=' . $model->id_chuyengiacongtrinh . "'><i class='fa fa-pencil'></i></a>";
                                    $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('user/dangkychuyengia/congtrinh/delete') . '?id=' . $model->id_chuyengiacongtrinh . "'><i class='fa fa-trash'></i></a>";
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
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách công trình nghiên cứu',
                            'after' => false,
                        ]
                    ])
                    ?>
                </div>
                <div class="col-lg-12">
                    <a class='btn btn-success custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='<?=Yii::$app->urlManager->createUrl('user/dangkychuyengia/congtrinh/create') . '?id=' . $model['chuyengia']->id_chuyengia ?>'><i class='fa fa-plus'></i> Thêm mới</a>
                    <a class="btn btn-default pull-right"
                       href="<?= Yii::$app->urlManager->createUrl('chuyen-gia') ?>">Danh sách chuyên gia</a>
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
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
                    <span class="uppercase">Quá trình công tác</span>
                </div>
                <div class="caption pull-right">
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/view').'?id='.$model['chuyengia']->id_chuyengia?>">Thông tin chi tiết</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/ngoaingu').'?id='.$model['chuyengia']->id_chuyengia?>">Ngoại ngữ</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/congtrinh').'?id='.$model['chuyengia']->id_chuyengia?>">Công trình nghiên cứu</a>
                    <a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/congtac').'?id='.$model['chuyengia']->id_chuyengia?>">Công tác</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/daotao').'?id='.$model['chuyengia']->id_chuyengia?>">Đào tạo</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/detai').'?id='.$model['chuyengia']->id_chuyengia?>">Đề tài</a>
                </div>
            </div>

            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?=
                    GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $model['congtac'],
                        'filterModel' => $model['search'],
                        'pjax' => true,
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn',
                                'width' => '30px',
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'width' => '200px',
                                'attribute' => 'nam_batdau',
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'width' => '200px',
                                'attribute' => 'nam_ketthuc',
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'so_thang',
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'noi_congtac',
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'vitri_congtac',
                                'format' => 'raw'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'linhvuc_congtac',
                                'format' => 'raw'
                            ],
                        ],
                        'toolbar' => false,
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'type' => 'primary',
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách quá trình công tác',
                            'after' => false,
                        ]
                    ])
                    ?>
                </div>
                <div class="col-lg-12">
                    <a class="btn btn-warning pull-left"
                       href="<?= Yii::$app->urlManager->createUrl('admin/capnhatchuyengia/congtac/congtac') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Cập
                        nhật thông tin</a>
                    <a class="btn btn-default pull-right"
                       href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index') ?>">Danh sách chuyên gia</a>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
</div>

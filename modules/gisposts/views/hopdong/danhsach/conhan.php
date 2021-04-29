<?php

use app\modules\DCrud\DCrudAsset;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\grid\GridView;
use yii\bootstrap\Modal;

DCrudAsset::register($this);
$explodeUrl = explode('?', Yii::$app->request->url);
$paramString = (isset($explodeUrl[1])) ? $explodeUrl[1] : '';
$this->title = (isset($const['title'])) ? $const['title'] : 'Danh sách hợp đồng';
$this->params['breadcrumbs'][] = ['label' => $const['actions']['index']['label'] . ' ' . $const['title'], 'url' => [$const['actions']['index']['url']]];
$this->params['breadcrumbs'][] = 'Danh sách hợp đồng còn hạn';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet box blue-steel">
            <div class="portlet-title">
                <div class="caption">
                    <span><i class="fa fa-search"></i> Tìm kiếm</span>
                </div>
            </div>
            <div class="portlet-body" style="min-height: 235px">
                <?php $form = ActiveForm::begin([
                    'id' => 'search_can'
                ]) ?>
                <div class="col-lg-12">
                    <?= $form->field($model['search'], 'nguoi_thue')->input('text')->label('Người thuê') ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model['search'], 'so_hop_dong')->input('text')->label('Số hợp đồng') ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model['search'], 'id_loainha')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($model['loainha'], 'id_loainha', 'ten_loainha'),
                        'options' => ['placeholder' => 'Chọn loại nhà ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Loại nhà') ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model['search'], 'thoi_han_thue')->dropDownList(ArrayHelper::map($model['thoihan'], 'so_thang', 'ghichu_thoihan'), ['prompt' => 'Chọn thời hạn thuê'])->label('Thời hạn thuê') ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model['search'], 'so_nha')->input('text')->label('Số nhà') ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model['search'], 'ten_duong')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($model['duong'], 'ten_duong', 'ten_duong'),
                        'options' => ['placeholder' => 'Chọn tên đường ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Tên đường') ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model['search'], 'ma_phuong')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($model['ranh_phuong'], 'maphuong', 'tenphuong'),
                        'options' => ['placeholder' => 'Chọn phường ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Phường') ?>
                </div>

                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
                <div style="clear: both"></div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php date_default_timezone_set('Asia/Ho_chi_minh'); ?>
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $model['dataProvider'],
            'pjax' => false,
            'columns' => [
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'width' => '30px',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'so_nha',
                    'label' => 'Số nhà',
                    'format' => 'raw'
                ],

                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'dien_tich_su_dung',
                    'label' => 'Diện tích sử dụng',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'so_hop_dong',
                    'label' => 'Số hợp đồng',
                ],

                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'nguoi_thue',
                    'label' => 'Người thuê',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'gia_phai_tra',
                    'label' => 'Giá phải trả',
                    'width' => '100px',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->gia_phai_tra != null) ? number_format($model->gia_phai_tra, 0, ',', '.') : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'thoi_han_thue',
                    'label' => 'Thời hạn thuê',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'ngay_het_han',
                    'label' => 'Ngày hết hạn',
                    'width' => '100px',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->ngay_het_han != null) ? date('d-m-Y', strtotime($model->ngay_het_han)) : '';
                    }
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
                    'label' => 'Thao tác',
                    'value' => function ($model) {
                        $viewButton = "<a href='" . Yii::$app->urlManager->createUrl('hopdong/view') . '?id=' . $model->id_hopdong . "' class='btn btn-info btn-xs'><i class='fa fa-eye'></i></a>";
                        $updateButton = "<a href='" . Yii::$app->urlManager->createUrl('hopdong/update') . '?id=' . $model->id_hopdong . "' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a>";
                        $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('hopdong/delete') . '?id=' . $model->id_hopdong . "'><i class='fa fa-trash'></i></a>";
                        return $viewButton . $updateButton . $deleteButton;
                    },
                    'format' => 'raw'
                ],
            ],
            'toolbar' => [
                'content' =>
                    "<a target='_blank' title='Xuất danh sách hợp đồng còn hạn' data-pjax='0' href='" . Yii::$app->urlManager->createUrl('quan-ly/hopdong/export?q=conhan&' . $paramString) . "' class='btn btn-default'><span class='fa fa-file-excel-o'></span> Xuất file</a>"
            ],
            'striped' => false,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách hợp đồng còn hạn',
                'after' => false,
            ]
        ]) ?>
    </div>
</div>
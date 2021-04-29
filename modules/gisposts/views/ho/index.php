<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 10/13/2017
 * Time: 2:07 PM
 */

use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\DCrud\DCrudAsset;

$this->title = (isset($const['title'])) ? $const['title'] : 'Danh sách hộ';
$this->params['breadcrumbs'][] = $this->title;
$explodeUrl = explode('?', Yii::$app->request->url);
$paramString = (isset($explodeUrl[1])) ? $explodeUrl[1] : '';
DCrudAsset::register($this);
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
                <div class="col-lg-3">
                    <?= $form->field($model['search'], 'so_nha')->input('text')->label('Số nhà') ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model['search'], 'ten_duong')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($model['duong'], 'ten_duong', 'ten_duong'),
                        'options' => ['placeholder' => 'Chọn tên đường ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Tên đường') ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model['search'], 'ma_phuong')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($model['ranh_phuong'], 'maphuong', 'tenphuong'),
                        'options' => ['placeholder' => 'Chọn phường ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Phường') ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model['search'], 'id_loainha')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($model['loainha'], 'id_loainha', 'ten_loainha'),
                        'options' => ['placeholder' => 'Chọn loại nhà ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Loại nhà') ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model['search'], 'thoigian_capnha')->widget(DateRangePicker::classname(), [
                        'convertFormat' => true,
                        'presetDropdown' => true,
                        'pluginOptions' => [
                            'locale' => [
                                'format' => 'd/m/Y',
                                'separator' => ' --- ',
                            ],
                            'opens' => 'left'
                        ], 'pluginEvents' => [
                            "cancel.daterangepicker" => "function(ev, picker) {
picker.element[0].children[1].textContent = '';
$(picker.element[0].nextElementSibling).val('').trigger('change');
}",
                            'apply.daterangepicker' => 'function(ev, picker) { 
var val = picker.startDate.format(picker.locale.format) + picker.locale.separator +
picker.endDate.format(picker.locale.format);

picker.element[0].children[1].textContent = val;
$(picker.element[0].nextElementSibling).val(val);
}',
                        ],
                    ])->label('Thời gian cấp nhà'); ?>
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
                <div style="clear: both"></div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
            'dataProvider' => $model['dataProvider'],
            'pjax' => false,
            'columns' => [
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'width' => '30px',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'id_loainha',
                    'label' => 'Loại nhà',
                    'value' => function ($model) {
                        return ($model->thongtincan->loainha != null) ? $model->thongtincan->loainha->ten_loainha : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'so_nha',
                    'value' => 'thongtincan.so_nha',
                    'label' => 'Số nhà',
                    'format' => 'raw'
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'ten_duong',
                    'value' => 'thongtincan.ten_duong',
                    'label' => 'Tên đường',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'ma_phuong',
                    'label' => 'Tên phường',
                    'value' => function ($model) {
                        return ($model->thongtincan->phuong != null) ? $model->thongtincan->phuong->tenphuong : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'dien_tich_su_dung',
                    'label' => 'Diện tích sử dụng',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return ($data->dien_tich_su_dung != null) ? $data->dien_tich_su_dung . ' m<sup>2</sup>' : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'cap_nha',
                    'label' => 'Cấp nhà',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'nguoi_thue',
                    'label' => 'Người đang thuê',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return ($data->hopdong != null) ? $data->hopdong->nguoi_thue : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'quyetdinh_capnha',
                    'label' => 'Quyết định cấp nhà',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'ngay_capnha',
                    'label' => 'Ngày cấp nhà',
                    'value' => function ($model) {
                        return ($model->ngay_capnha != null) ? date('d-m-Y', strtotime($model->ngay_capnha)) : '';
                    }
                ],
//
                [
                    'label' => 'Thao tác',
                    'value' => function ($model) {
                        $viewButton = "<a href='" . Yii::$app->urlManager->createUrl(['quan-ly/ho/view','id' => $model->id_ho])  . "' class='btn btn-info btn-xs'><i class='fa fa-eye'></i></a>";
                        $fileButton = "<a href='" . Yii::$app->urlManager->createUrl(['quan-ly/ho/file','id' => $model->id_ho])  . "' class='btn btn-primary btn-xs'><i class='fa fa-file'></i></a>";
                        $updateButton = "<a class='btn btn-warning btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('ho/update') . '?id=' . $model->id_ho . "'><i class='fa fa-pencil'></i></a>";
                        $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('ho/delete') . '?id=' . $model->id_ho . "'><i class='fa fa-trash'></i></a>";
                        return $viewButton . $updateButton . $fileButton . $deleteButton;
                    },
                    'format' => 'raw'
                ],
            ],
            'toolbar' => [
                ['content' =>
                    "<a target='_blank' title='Xuất danh sách hộ' data-pjax='0' href='" . Yii::$app->urlManager->createUrl('quan-ly/ho/export?' . $paramString) . "' class='btn btn-default'><span class='fa fa-file-excel-o'></span> Xuất file</a>"
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách hộ',
                'after' => false,
            ]
        ]) ?>
    </div>
</div>
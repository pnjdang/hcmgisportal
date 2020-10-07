<?php

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

return [

    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'created_at',
        'label' => 'Thời gian',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'email',
        'label' => 'Email'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ho_ten',
        'label' => 'Họ tên'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'noi_dung',
        'label' => 'Nội dung'
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'hocham_id',
//        'width' => '120px',
//        'value' => function ($model, $key, $index, $widget) {
//            if ($model->hocham != null) {
//                return $model->hocham->ten_hh;
//            } else {
//                return '';
//            }
//        },
//        'filterType' => GridView::FILTER_SELECT2,
//        'filter' => ArrayHelper::map($model['hocham'],'id_hh', 'ten_hh'),
//        'filterWidgetOptions' => [
//            'pluginOptions' => ['allowClear' => true],
//        ],
//        'filterInputOptions' => ['placeholder' => ''],
//        'format' => 'raw'
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'hocvi_id',
//        'width' => '100px',
//        'value' => function ($model, $key, $index, $widget) {
//            if ($model->hocvi != null) {
//                return $model->hocvi->ten_hv;
//            } else {
//                return '';
//            }
//        },
//        'filterType' => GridView::FILTER_SELECT2,
//        'filter' => ArrayHelper::map($model['hocvi'],'id_hv', 'ten_hv'),
//        'filterWidgetOptions' => [
//            'pluginOptions' => ['allowClear' => true],
//        ],
//        'filterInputOptions' => ['placeholder' => ''],
//        'format' => 'raw'
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'chuyen_mon',
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'ten_dvct',
//        'label' => 'Loại hình tổ chức',
//        'value' => function ($model, $key, $index, $widget) {
//            if ($model->ten_dvct == '') {
//                return '';
//            } else {
//                return $model->ten_dvct;
//            }
//        },
//        'format' => 'raw'
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'ten_lvql',
//        'width' => '150px',
//        'value' => function ($model, $key, $index, $widget) {
//            if ($model->ten_lvql == '') {
//                return '';
//            } else {
//                return $model->ten_lvql;
//            }
//        },
//        'format' => 'raw'
//    ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'ghi_chu',
//     ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'geom',
    // ],
    [
        'label' => 'Thao tác',
        'width' => '100px',
        'value' => function ($model) {
            $viewButton = "<a href='" . Yii::$app->urlManager->createUrl('admin/phongthinghiem/view') . '?id=' . $model->id_lienhe . "' class='btn btn-info btn-xs'><i class='fa fa-eye'></i></a>";
            $replyButton = "<a class='btn btn-warning btn-xs custom-element-load-ajax-div' data-target-div='#ajaxModalContent' data-toggle='modal' data-target='#ajaxModal' data-url='". Yii::$app->urlManager->createUrl('admin/site/reply') ."?id=". $model->id_lienhe."'><i class='fa fa-reply'></i></a>";
//            $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('admin/phongthinghiem/delete') . '?id=' . $model->id_ptn . "'><i class='fa fa-trash'></i></a>";
            return $viewButton . $replyButton;
        },
        'format' => 'raw'
    ],
];
                
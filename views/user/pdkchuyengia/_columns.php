<?php

return [

    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ho_ten',
        'width' => '250px',
        'value' => function ($model, $key, $index, $widget) {
            return "<a href='" . Yii::$app->urlManager->createUrl('user/pdkchuyengia/update') . "?id=" . $model->id_chuyengia . "'>" . mb_strtoupper($model->ho_ten) . "</a>";
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
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'donvi_id',
        'value' => function ($model, $key, $index, $widget) {
            if ($model->donvi != null) {
                return $model->donvi->ten_donvi;
            } else {
                return '';
            }

        },
        'format' => 'raw'
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'label' => 'Trạng thái',
        'value' => function ($model) {
            if ($model->status == 1) {
                return 'Đã duyệt';
            } elseif ($model->status == 2) {
                return 'Đã đăng ký';
            } else {
                return '';
            }
        },
        'format' => 'raw'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'diachi_nharieng',
        'label' => 'Chuyên ngành',
        'value' => function ($model) {
            return implode(\yii\helpers\ArrayHelper::map($model->chuyengiaChuyennganhs, 'cap3.id_cap3', 'cap3.ten_cap3'));
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'diachi_nharieng',
        'label' => 'Lĩnh vực',
        'value' => function ($model) {
            return implode(\yii\helpers\ArrayHelper::map($model->chuyengiaLinhvucs, 'cap1.id_cap1', 'cap1.ten_cap1'));
        }
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'created_at',
//        'label' => 'Thời gian đăng ký',
//        'value' => function ($model) {
//            return ($model->created_at != null) ? date('d-m-Y H:i:s',strtotime($model->created_at)) : '';
//        },
//        'format' => 'raw'
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'updated_at',
//        'label' => 'Thời gian cập nhật',
//        'value' => function ($model) {
//            return ($model->updated_at != null) ? date('d-m-Y H:i:s',strtotime($model->updated_at)) : '';
//        },
//        'format' => 'raw'
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
        'width' => '140px',
        'value' => function ($model) {
            $viewButton = "<a class='btn btn-info btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('user/pdkchuyengia/view') . '?id=' . $model->id_chuyengia . "' class='btn btn-info btn-xs' title='Chi tiết phiếu đăng ký'><i class='fa fa-eye'></i></a>";
            $updateButton = "<a class='btn btn-warning btn-xs' href='" . Yii::$app->urlManager->createUrl('user/pdkchuyengia/update') . '?id=' . $model->id_chuyengia . "' class='btn btn-warning btn-xs' title='Cập nhật phiếu đăng ký'><i class='fa fa-pencil'></i></a>";
            $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('user/pdkchuyengia/delete') . '?id=' . $model->id_chuyengia . "'  title='Xóa phiếu đăng ký'><i class='fa fa-trash'></i></a>";
            return $viewButton . $updateButton . $deleteButton;
        },
        'format' => 'raw'
    ],
];
                
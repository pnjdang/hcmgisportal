<?php
use yii\helpers\ArrayHelper;

if ($model['search']['ten_congtrinh'] != null || $model['search']['loai_congtrinh'] != null) {
    return [
        [
            'class' => 'kartik\grid\SerialColumn',
            'width' => '30px',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'ho_ten',
            'width' => '180px',
            'format' => 'raw',
            'value' => function ($model) {
                return "<a href='" . Yii::$app->urlManager->createUrl('thong-tin-chuyen-gia-chi-tiet') . "?id=" . $model->chuyengia->id_chuyengia . "'>" . $model->chuyengia->ho_ten . "</a>";
            },
            'label' => 'Họ tên'
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'hocham_id',
            'width' => '80px',
            'filter' => ArrayHelper::map($model['hocham'], 'id_hh', 'ten_hh'),
            'value' => function ($model) {
                return ($model->chuyengia->hocham != null) ? $model->chuyengia->hocham->ten_hh : '';
            },
            'label' => 'Học hàm'
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'width' => '80px',
            'attribute' => 'hocvi_id',
            'filter' => ArrayHelper::map($model['hocvi'], 'id_hv', 'ten_hv'),
            'value' => function ($model) {
                return ($model->chuyengia->hocvi != null) ? $model->chuyengia->hocvi->ten_hv : '';
            },
            'label' => 'Học vị'
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'donvi_id',
            'value' => function ($model) {
                if ($model->chuyengia->donvi == null) {
                    return '';
                } else {
                    return $model->chuyengia->donvi->ten_donvi;
                }
            },
            'label' => 'Đơn vị công tác'
        ],
        [
            'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'diachi_nharieng',
            'label' => 'Lĩnh vực',
            'value' => function ($model) {
                return implode(\yii\helpers\ArrayHelper::map($model->chuyengia->chuyengiaLinhvucs, 'cap1.id_cap1', 'cap1.ten_cap1'));
            }
        ],
        [
            'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'diachi_nharieng',
            'label' => 'Chuyên ngành',
            'value' => function ($model) {
                return implode(\yii\helpers\ArrayHelper::map($model->chuyengia->chuyengiaChuyennganhs, 'cap3.id_cap3', 'cap3.ten_cap3'));
            }
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'format' => 'raw',
            'width' => '100px',
            'value' => function ($model) {
                $viewButton = "<a class='btn btn-xs btn-info' href='" . Yii::$app->urlManager->createUrl('user/chuyengia/view') . "?id=" . $model->chuyengia->id_chuyengia . "' title='Thông tin chi tiết'><i class='fa fa-info'></i></a>";
                $updateButton = "<a class='btn btn-xs btn-warning' href='" . Yii::$app->urlManager->createUrl('user/chuyengia/update') . "?id=" . $model->chuyengia->id_chuyengia . "' title='Cập nhật thông tin chuyên gia'><i class='fa fa-pencil'></i></a>";
                return $viewButton . (($model->chuyengia->created_by == Yii::$app->user->id) ? $updateButton : '');
            },
        ],
    ];
} else {

    return [
        [
            'class' => 'kartik\grid\SerialColumn',
            'width' => '30px',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'ho_ten',
            'width' => '180px',
            'format' => 'raw',
            'value' => function ($model) {
                return "<a href='" . Yii::$app->urlManager->createUrl('user/chuyengia/view') . "?id=" . $model->id_chuyengia . "'>" . $model->ho_ten . "</a>";
            },
            'label' => 'Họ tên'
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'hocham_id',
            'width' => '80px',
            'filter' => ArrayHelper::map($model['hocham'], 'id_hh', 'ten_hh'),
            'value' => function ($model) {
                return ($model->hocham != null) ? $model->hocham->ten_hh : '';
            },
            'label' => 'Học hàm'
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'width' => '80px',
            'attribute' => 'hocvi_id',
            'filter' => ArrayHelper::map($model['hocvi'], 'id_hv', 'ten_hv'),
            'value' => function ($model) {
                return ($model->hocvi != null) ? $model->hocvi->ten_hv : '';
            },
            'label' => 'Học vị'
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'donvi_id',
            'value' => function ($model) {
                if ($model->donvi == null) {
                    return '';
                } else {
                    return $model->donvi->ten_donvi;
                }
            },
            'label' => 'Đơn vị công tác'
        ],
        [
            'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'diachi_nharieng',
            'label' => 'Lĩnh vực',
            'value' => function ($model) {
                return implode(\yii\helpers\ArrayHelper::map($model->chuyengiaLinhvucs, 'cap1.id_cap1', 'cap1.ten_cap1'));
            }
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
            'format' => 'raw',
            'width' => '100px',
            'value' => function ($model) {
                $viewButton = "<a class='btn btn-xs btn-info' href='" . Yii::$app->urlManager->createUrl('user/chuyengia/view') . "?id=" . $model['id_chuyengia'] . "' title='Thông tin chi tiết'><i class='fa fa-info'></i></a>";
                $updateButton = "<a class='btn btn-xs btn-warning' href='" . Yii::$app->urlManager->createUrl('user/chuyengia/update') . "?id=" . $model['id_chuyengia'] . "' title='Cập nhật thông tin chuyên gia'><i class='fa fa-pencil'></i></a>";
                return $viewButton . (($model->created_by == Yii::$app->user->id) ? $updateButton : '');
            },
        ],
    ];
}
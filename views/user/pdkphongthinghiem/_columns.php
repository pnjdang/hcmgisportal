<?php

return [

    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ten_tv',
        'width' => '250px',
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
        'attribute' => 'created_at',
        'label' => 'Thời gian đăng ký',
        'value' => function ($model) {
            return ($model->created_at != null) ? date('d-m-Y H:i:s',strtotime($model->created_at)) : '';
        },
        'format' => 'raw'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'updated_at',
        'label' => 'Thời gian cập nhật',
        'value' => function ($model) {
            return ($model->updated_at != null) ? date('d-m-Y H:i:s',strtotime($model->updated_at)) : '';
        },
        'format' => 'raw'
    ],
    [
        'label' => 'Thao tác',
        'width' => '100px',
        'value' => function ($model) {
            $viewButton = "<a class='btn btn-info btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('user/pdkphongthinghiem/view') . '?id=' . $model->id_ptn . "' class='btn btn-info btn-xs' title='Chi tiết phiếu đăng ký'><i class='fa fa-eye'></i></a>";
            $updateButton = "<a class='btn btn-warning btn-xs' href='" . Yii::$app->urlManager->createUrl('user/pdkphongthinghiem/update') . '?id=' . $model->id_ptn . "' class='btn btn-warning btn-xs' title='Cập nhật phiếu đăng ký'><i class='fa fa-pencil'></i></a>";
            $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('user/pdkphongthinghiem/delete') . '?id=' . $model->id_ptn . "'  title='Xóa phiếu đăng ký'><i class='fa fa-trash'></i></a>";
            if($model->status == 2){
                return $viewButton . $updateButton . $deleteButton;
            } else {
                return '';
            }
        },
        'format' => 'raw'
    ],
];
                
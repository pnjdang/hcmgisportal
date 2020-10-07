<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ten_tv',
        'label' => 'Tên tiếng Việt',
        'format' => 'raw',
        'value' => function ($data) {
            return "<a class='custom-element-load-ajax-div' data-target-div='#phongthinghiemModalContent' data-toggle='modal' data-target='#phongthinghiemModal' data-url='".Yii::$app->urlManager->createUrl('user/phongthinghiem/view')."?id=$data->id_ptn'>$data->ten_tv</a>";
        },
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'coquan_chuquan',
        'label' => 'Cơ quan chủ quản',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'dia_chi',
        'label' => 'Địa chỉ',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'dien_thoai',
        'label' => 'Điện thoại',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'dai_dien',
        'label' => 'Người đại diện',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'format' => 'raw',
        'width' => '100px',
        'label' => 'Thao tác',
        'value' => function ($data) {
            if($data->taikhoan_id == Yii::$app->user->id && $data->taikhoan_id != null){
                return "<a title='Chi tiết thông tin' class='btn btn-info btn-xs custom-element-load-ajax-div' data-target-div='#phongthinghiemModalContent' data-toggle='modal' data-target='#phongthinghiemModal' data-url='".Yii::$app->urlManager->createUrl('user/phongthinghiem/view')."?id=$data->id_ptn'><i class='fa fa-eye'></i></a>
            <a title='Thay đổi thông tin' class='btn btn-warning btn-xs' href='".Yii::$app->urlManager->createUrl('user/phongthinghiem/update')."?id=$data->id_ptn'><i class='fa fa-pencil'></i></a>";
            } else {
                return "<a title='Chi tiết thông tin' class='btn btn-info btn-xs custom-element-load-ajax-div' data-target-div='#phongthinghiemModalContent' data-toggle='modal' data-target='#phongthinghiemModal' data-url='".Yii::$app->urlManager->createUrl('user/phongthinghiem/view')."?id=$data->id_ptn'><i class='fa fa-eye'></i></a>";
            }

        },
    ],

];   
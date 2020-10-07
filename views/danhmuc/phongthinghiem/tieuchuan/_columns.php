<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
//        [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'id_tc',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_tc',
        'label' => 'Tên tiêu chuẩn phương pháp thử'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ghi_chu',
        'label' => 'Ghi chú'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Thao tác',
        'dropdown' => false,
        'width' => '120px',
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title' => 'Chi tiết tiêu chuẩn', 'data-toggle' => 'tooltip', 'class' => 'btn btn-xs btn-info','style' => ['margin' => 0]],
        'updateOptions'=>['role'=>'modal-remote','title' => 'Cập nhật tiêu chuẩn', 'data-toggle' => 'tooltip', 'class' => 'btn btn-xs btn-warning','style' => ['margin' => 0]],
        'deleteOptions'=>['role'=>'modal-remote','title' => 'Xóa tiêu chuẩn', 'class' => 'btn btn-xs btn-danger','style' => ['margin' => 0],
            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
            'data-request-method'=>'post',
            'data-toggle'=>'tooltip',
            'data-confirm-title'=>'Bạn có chắc chắn?',
            'data-confirm-message'=>'Bạn có chắc chắn muốn xoá thiết bị này?'],
    ],

];   
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
//        'attribute'=>'id_tcht',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_tc',
        'label' => 'Tên tổ chức thử nghiệm',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ghi_chu',
        'label' => 'Ghi chú',
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
        'viewOptions'=>['role'=>'modal-remote','title' => 'Chi tiết tổ chức', 'data-toggle' => 'tooltip', 'class' => 'btn btn-xs btn-info','style' => ['margin' => 0]],
        'updateOptions'=>['role'=>'modal-remote','title' => 'Cập nhật tổ chức', 'data-toggle' => 'tooltip', 'class' => 'btn btn-xs btn-warning','style' => ['margin' => 0]],
        'deleteOptions'=>['role'=>'modal-remote','title' => 'Xóa tổ chức', 'class' => 'btn btn-xs btn-danger','style' => ['margin' => 0],
            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
            'data-request-method'=>'post',
            'data-toggle'=>'tooltip',
            'data-confirm-title'=>'Bạn có chắc chắn?',
            'data-confirm-message'=>'Bạn có chắc chắn muốn xoá thiết bị này?'],
    ],

];   
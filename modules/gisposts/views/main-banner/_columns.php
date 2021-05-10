<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'file_path',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'file_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'file_caption',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'file_description',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'uploaded_at',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'banner_position',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'width' => '180px',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Xem','data-toggle'=>'tooltip','class'=>'btn btn-info btn-xs'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Cập nhật', 'data-toggle'=>'tooltip','class'=>'btn btn-warning btn-xs'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Xóa','class'=>'btn btn-danger btn-xs',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Xóa',
                          'data-confirm-message'=>'Bạn chắc chắn muốn xóa?'],
    ],

];   
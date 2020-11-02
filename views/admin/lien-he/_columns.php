<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
//        [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'id_lienhe',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ho_ten',
        'width' => '15%',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
        'width' => '15%',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'dien_thoai',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'noi_dung',
        'width' => '30%',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'reply',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'replied_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'replied_by',
    // ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'noi_dung_reply',
         'options'=>['style'=>'word-wrap:break-word;'],
         'width' => '30%',
     ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'width' => '10%',
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
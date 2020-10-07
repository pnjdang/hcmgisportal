<?php
use yii\helpers\Url;

return [
    
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
//        [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'id_cap2',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_cap2',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ma_cap2',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ghichu_cap2',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'status',
//    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_cap1',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Thao tác',
        'width' => '120px',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>[
            'role'=>'modal-remote',
            'title'=>'Chi tiết',
            'data-toggle'=>'tooltip',
            'class' =>'btn btn-xs btn-info'
        ],
        'updateOptions'=>[
            'role'=>'modal-remote',
            'title'=>'Cập nhật', 
            'data-toggle'=>'tooltip',
            'class' =>'btn btn-xs btn-warning'
        ],
        'deleteOptions'=>[
            'role'=>'modal-remote',
            'title'=>'Xóa',
            'class' => 'btn btn-xs btn-danger',
            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
            'data-request-method'=>'post',
            'data-toggle'=>'tooltip',
            'data-confirm-title'=>'Xóa lĩnh vực nghiên cứu cấp 2',
            'data-confirm-message'=>'Bạn chắc chắn muốn xóa danh mục này?',
            'data-confirm-ok' => 'Xóa',
            'data-confirm-cancel' => 'Đóng',                                  
        ], 
    ],

];   
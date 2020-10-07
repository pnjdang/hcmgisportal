<?php
use yii\helpers\Url;

return [
    
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
//        [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'id_donvi',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_donvi',
        'label' => 'Tên đơn vị'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nguoidungdau',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dia_chi',
        'label' => 'Địa chỉ'
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
        // 'attribute'=>'updated_at',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nhomdonvi_id',
        'label' => 'Nhóm đơn vị',
        'value' => function($model){
            return ($model->nhomdonvi != null) ? $model->nhomdonvi->ten_nhomdonvi : '';
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],

     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'dien_thoai',
         'label' => 'Điện thoại'
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'fax',
         'label' => 'Fax'
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'website',
         'label' => 'Website'
     ],
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
            'data-confirm-title'=>'Are you sure?',
            'data-confirm-message'=>'Are you sure want to delete this item',                                 
        ], 
    ],

];   
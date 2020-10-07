<?php
use yii\helpers\Url;

return [
    
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
//        [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'id_pl',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_pl',
        'label' => 'Tên phân loại'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_cl',
        'label' => 'Tên chủng loại',
        'value' => function($model){
            return $model->chungloai->ten_cl;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ghi_chu',
        'label' => 'Ghi chú',
        'value' => function($model){
            return ($model->ghi_chu != null) ? $model->ghi_chu : '';
        }
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
            'data-confirm-title'=>'Xóa danh mục phân loại vật liệu',
            'data-confirm-message'=>'Bạn chắc chắn muốn xóa danh mục này?',
        ], 
    ],

];   
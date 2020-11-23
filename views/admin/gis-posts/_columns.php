<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
//        [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'ID',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'post_author',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'post_date',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'post_date_gmt',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'post_content',
//    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'post_title',
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'post_img',
    // ],
     [
         'class'=>'\kartik\grid\BooleanColumn',
         'attribute'=>'post_status',
         'vAlign' => 'middle'
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'comment_status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ping_status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'post_password',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'post_name',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'to_ping',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'pinged',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'post_modified',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'post_modified_gmt',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'post_content_filtered',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'post_parent',
    // ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'guid',
//     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'menu_order',
    // ],
     [
         'class'=>'kartik\grid\DataColumn',
         'attribute'=>'post_type',
         'width' => '200px',
         'filterType' => GridView::FILTER_SELECT2,
         'filter' => ArrayHelper::map($post_type, 'post_type', 'post_type'), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => '']
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'post_mime_type',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'comment_count',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'width' => '180px',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['title'=>'Xem','data-toggle'=>'tooltip','class'=>'btn btn-info btn-xs'],
        'updateOptions'=>['title'=>'Cập nhật', 'data-toggle'=>'tooltip','class'=>'btn btn-warning btn-xs'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Xóa','class'=>'btn btn-danger btn-xs',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Xóa',
                          'data-confirm-message'=>'Bạn chắc chắn muốn xóa?'],
    ],

];   
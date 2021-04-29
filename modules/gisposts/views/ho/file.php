<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 3/31/2021
 * Time: 2:16 PM
 */

use kartik\grid\GridView;

$requestedAction = Yii::$app->requestedAction;
$this->title = $const['actions'][$requestedAction->id]['label'];
$this->params['breadcrumbs'][] = ['label' => $const['actions']['index']['label'] . ' ' . $const['title'], 'url' => [$const['actions']['index']['url']]];
$this->params['breadcrumbs'][] = ['label' => $model['ho']->nguoi_thue . ' ' . $const['title'], 'url' => [$const['actions']['view']['url'],'id'=> $model['ho']->id_ho]];
$this->params['breadcrumbs'][] = 'Tài liệu';
?>

<div class="row">

    <div class="col-lg-12">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $model['tailieu'],
            'pjax' => false,
            'columns' => [
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'width' => '30px',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'ten_tai_lieu',
                    'label' => 'Tên',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->ten_tai_lieu != null) ? $model->ten_tai_lieu : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'loai_tai_lieu',
                    'label' => 'Loại',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->loai_tai_lieu != null) ? $model->loai_tai_lieu : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'so_tai_lieu',
                    'label' => 'Số',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->so_tai_lieu != null) ? $model->so_tai_lieu : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'ngay_tai_lieu',
                    'label' => 'Ngày',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->ngay_tai_lieu != null) ? date('d-m-Y', strtotime($model->ngay_tai_lieu)) : '';
                    }
                ],

                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'noi_dung',
                    'label' => 'Nội dung',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->noi_dung != null) ? $model->noi_dung : '';
                    }
                ],
                [
                    'label' => 'Thao tác',
                    'value' => function ($model) {
                        $viewButton = "<a href='" . Yii::$app->homeUrl . $model->duong_dan . "' target='_blank' class='btn btn-info btn-xs'><i class='fa fa-eye'></i></a>";
                        $updateButton = "<a class='btn btn-warning btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('ho/update') . '?id=' . $model->id_tailieu . "'><i class='fa fa-pencil'></i></a>";
                        $deleteButton = "<a class='btn btn-danger btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('tailieu/delete') . '?id=' . $model->id_tailieu . "'><i class='fa fa-trash'></i></a>";
                        return $viewButton . $updateButton . $deleteButton;
                    },
                    'format' => 'raw',
                ],
            ],
            'toolbar' => [
                ['content' =>
                    "<a class='btn btn-success custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('tailieu/create') . '?id=' . $model['ho']->id_ho . "'>Thêm mới</a>" .
                    '{toggleData}' .
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách tài liệu',
                'after' => false,
            ]
        ]) ?>
    </div>
</div>
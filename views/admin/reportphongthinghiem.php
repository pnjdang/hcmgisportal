<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/27/2017
 * Time: 8:50 PM
 */
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use johnitvn\ajaxcrud\CrudAsset;
?>
<div class="row">
    <div id="chuyengiaDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $model['report'],
            'pjax' => true,
            'columns' => [
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'width' => '30px',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'format' => 'raw',
                    'attribute' => 'ten_tv',
                    'label' => 'Tên'
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'format' => 'raw',
                    'attribute' => 'taikhoan_id',
                    'value' => function($model){
                        return ($model->taikhoan != null) ? $model->taikhoan->ten_dang_nhap : '';
                    },
                    'label' => 'Người gửi'
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'format' => 'raw',
                    'attribute' => 'created_at',
                    'label' => 'Ngày gửi'
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'format' => 'raw',
                    'attribute' => 'status',
                    'label' => 'Trạng thái',
                    'value' => function($data){
                        if($data['status'] == 1){
                            return 'Đã kiểm tra';
                        } else {
                            return 'Chưa kiểm tra';
                        }
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'format' => 'raw',
                    'width' => '80px',
                    'value'=>function ($data) {
                        if($data['status'] == 1){
                            $check = '';
                        } else {
                            $check = "<a class='btn btn-success btn-xs' href='".Yii::$app->urlManager->createUrl('admin/checkphongthinghiem')."?id=".$data['id_tempptn']."'><i class='fa fa-check'></i></a>";
                        }
                        return $check;
                    },
                ]

            ],
            'toolbar' => [
                ['content' =>
                    '{toggleData}' .
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách yêu cầu cập nhật thông tin phòng thí nghiệm',
                'after' => false,
            ]
        ]) ?>
    </div>

</div>

<div class="modal fade" id="reportModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:900px;">
        <div class="modal-content" id="reportModalContent">

        </div>
    </div>
</div>
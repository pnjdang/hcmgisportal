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
                    'attribute' => 'ten_cg',
                    'value'=>function ($data) {
                        if(isset($data['phongthinghiem_id'])){
                            return $data['ten_tv'];
                        } elseif(isset($data['chuyengia_id'])){
                            return $data['ten_cg'];
                        } else {
                            return '';
                        }
                    },
                    'label' => 'Tên'
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'format' => 'raw',
                    'attribute' => 'truong_du_lieu_sai',
                    'label' => 'Dữ liệu sai'
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'format' => 'raw',
                    'attribute' => 'thong_tin_dinh_chinh',
                    'label' => 'Thông tin đính chính'
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'format' => 'raw',
                    'attribute' => 'ho_ten',
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
                        if(isset($data['phongthinghiem_id'])){
                            $view = "<a class='btn btn-info btn-xs custom-element-load-ajax-div' data-target-div='#reportModalContent' data-toggle='modal' data-target='#reportModal' data-url='".Yii::$app->urlManager->createUrl('dsphongthinghiem/viewphongthinghiem')."?id=".$data['phongthinghiem_id']."'><i class='fa fa-info'></i></a>";
                        } elseif(isset($data['chuyengia_id'])){
                            $view = "<a class='btn btn-info btn-xs custom-element-load-ajax-div' data-target-div='#reportModalContent' data-toggle='modal' data-target='#reportModal' data-url='".Yii::$app->urlManager->createUrl('dschuyengia/viewchuyengia')."?id=".$data['chuyengia_id']."'><i class='fa fa-info'></i></a>";
                        } else {
                            $view =  '';
                        }
                        if($data['status'] == 1){
                            $check = '';
                        } else {
                            $check = "<a class='btn btn-success btn-xs custom-element-load-ajax-div' data-target-div='#reportModalContent' data-toggle='modal' data-target='#reportModal' data-url='".Yii::$app->urlManager->createUrl('admin/reportcheck')."?id=".$data['id_reportthongtin']."'><i class='fa fa-check'></i></a>";
                        }
                        return $check . $view;
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách báo sai thông tin',
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
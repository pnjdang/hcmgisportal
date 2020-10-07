<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/1/2017
 * Time: 3:46 PM
 */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\form\ActiveForm;
use kartik\select2\Select2;

?>
<?php

CrudAsset::register($this);
?>
<?php $success = Yii::$app->session->getFlash('capnhatchuyengia') ?>
<?php if (isset($success)): ?>
    <div class="portlet box green" id="notice">
        <div class="portlet-title">
            <div class="caption"><span class="fa fa-check-circle-o"></span> Cập nhật thông tin chuyên gia thành công!
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $success = Yii::$app->session->getFlash('capnhatphongthinghiem') ?>
<?php if (isset($success)): ?>
    <div class="portlet box green" id="notice">
        <div class="portlet-title">
            <div class="caption"><span class="fa fa-check-circle-o"></span> Cập nhật thông tin phòng thí nghiệm thành công!
            </div>
        </div>
    </div>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#notice').delay(3000).fadeOut();
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet box">
            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?= GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $model['dataProvider']['chuyengia'],
                        'pjax' => true,
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn',
                                'width' => '30px',
                                'header' => 'STT'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'id_pdkcg',
                                'label' => 'Mã'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ho_ten',
                                'width' => '20%',
                                'label' => 'Tên chuyên gia'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'created_at',
                                'label' => 'Thời gian đăng ký'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ket_qua',
                                'label' => 'Kết quả'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ghi_chu',
                                'label' => 'Ghi chú'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if ($model['ket_qua'] == null) {
                                        return "<a class='btn btn-info btn-xs custom-element-load-ajax-div' data-target-div='#chuyengiaModalContent' data-toggle='modal' data-target='#chuyengiaModal' data-url='" . Yii::$app->urlManager->createUrl('user/userviewpdkchuyengia') . "?id=" . $model['id_pdkcg'] . "' title='Thông tin chi tiết'><i class='fa fa-info'></i></a>"
                                        . "<a class='btn btn-warning btn-xs custom-element-load-ajax-div' data-target-div='#chuyengiaModalContent' data-toggle='modal' data-target='#chuyengiaModal' data-url='" . Yii::$app->urlManager->createUrl('user/updatepdkchuyengia') . "?id=" . $model['id_pdkcg'] . "' title='Cập nhật'><i class='fa fa-pencil'></i></a>";
                                    } else {
                                        return "<a class='btn btn-info btn-xs custom-element-load-ajax-div' data-target-div='#chuyengiaModalContent' data-toggle='modal' data-target='#chuyengiaModal' data-url='" . Yii::$app->urlManager->createUrl('user/userviewpdkchuyengia') . "?id=" . $model['id_pdkcg'] . "' title='Thông tin chi tiết'><i class='fa fa-info'></i></a>";
                                    }
                                }
                            ],
                        ],
                        'toolbar' => [

                        ],
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'type' => 'primary',
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách đăng ký thông tin chuyên gia',
                            'after' => false,
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="chuyengiaModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:900px;">
        <div class="modal-content" id="chuyengiaModalContent">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet box">
            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?= GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $model['dataProvider']['phongthinghiem'],
                        'pjax' => true,
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn',
                                'width' => '30px',
                                'header' => 'STT'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'id_pdkptn',
                                'label' => 'Mã'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ten_tv',
                                'width' => '20%',
                                'label' => 'Tên tiếng Việt'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'created_at',
                                'label' => 'Thời gian đăng ký'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ket_qua',
                                'label' => 'Kết quả',
                                'value' => function ($model) {
                                    if($model['ket_qua'] == 1){
                                        return 'Đã duyệt';
                                    }
                                    if($model['ket_qua'] == null){
                                        return '';
                                    }
                                }

                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'ghi_chu',
                                'label' => 'Ghi chú'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if ($model['ket_qua'] == null) {
                                        return "<a class='btn btn-info btn-xs custom-element-load-ajax-div' data-target-div='#chuyengiaModalContent' data-toggle='modal' data-target='#chuyengiaModal' data-url='" . Yii::$app->urlManager->createUrl('user/phongthinghiem/viewpdk') . "?id=" . $model['id_pdkptn'] . "' title='Thông tin chi tiết'><i class='fa fa-info'></i></a>" .
                                        "<a href='" . Yii::$app->urlManager->createUrl('cap-nhat-phieu-dang-ky-phong-thi-nghiem') . "?id=$model->id_pdkptn' class='btn btn-xs btn-warning'><i class='fa fa-pencil'></i></a>";
                                    } else {
                                        return "<a class='btn btn-info btn-xs custom-element-load-ajax-div' data-target-div='#chuyengiaModalContent' data-toggle='modal' data-target='#chuyengiaModal' data-url='" . Yii::$app->urlManager->createUrl('user/phongthinghiem/viewpdk') . "?id=" . $model['id_pdkptn'] . "' title='Thông tin chi tiết'><i class='fa fa-info'></i></a>" ;
                                    }

                                }
                            ],
                        ],
                        'toolbar' => [

                        ],
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'type' => 'primary',
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách đăng ký thông tin phòng thí nghiệm',
                            'after' => false,
                        ],
                    ]) ?>
                    <?php
                    Modal::begin([
                        "id" => "ajaxCrudModal",
                        'size' => Modal::SIZE_LARGE,

                    ])
                    ?>
                    <?php Modal::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>



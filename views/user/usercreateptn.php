<?php

use yii\helpers\Html;


use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>


<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'skin skin-square',
        'enctype' => 'multipart/form-data'
    ]
]) ?>


<div class="row">
    <div class="col-lg-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="font-blue-steel">Thêm mới chuyên gia</span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="tabbable-line form-group">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#thongtinchung">Thông tin chung</a></li>
                        <li><a data-toggle="tab" href="#nghiencuu">Nghiên cứu</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="thongtinchung">
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <?= $form->field($model['chuyengia'], 'ho_ten')->textInput(['maxlength' => true])->label('Họ và tên') ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <?= $form->field($model['chuyengia'], 'nam_sinh')->input('number')->label('Năm sinh') ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($model['chuyengia'], 'gioi_tinh')->dropDownList([1 => 'Nam', 2 => 'Nữ'], ['prompt' => 'Chọn giới tính'])->label('Giới tính') ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <?= $form->field($model['chuyengia'], 'id_hh')->dropDownList(ArrayHelper::map($model['hocham'], 'id_hh', 'ten_hh'), ['prompt' => 'Chọn Học hàm'])->label('Học hàm') ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($model['chuyengia'], 'id_hv')->dropDownList(ArrayHelper::map($model['hocvi'], 'id_hv', 'ten_hv'), ['prompt' => 'Chọn Học vị'])->label('Học vị') ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <?= $form->field($model['chuyengia'], 'id_lvql')->dropDownList(ArrayHelper::map($model['linhvucquanly'], 'id_lvql', 'ten_lvql'), ['prompt' => 'Chọn Lĩnh vực quản lý'])->label('Lĩnh vực quản lý') ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <?= $form->field($model['chuyengia'], 'chuyen_mon')->textInput(['maxlength' => true])->label('Chuyên môn') ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <?= $form->field($model['chuyengia'], 'donvi_congtac')->textInput(['maxlength' => true])->label('Đơn vị công tác') ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <?= $form->field($model['chuyengia'], 'donvi_id')->widget(Select2::classname(), [
                                        'data' => [],
                                        'options' => ['placeholder' => 'Chọn đơn vị ...',],
                                        'pluginOptions' => [
//                            'maximumInputLength' => 10,
                                            'allowClear' => true,
                                            'minimumInputLength' => 1,
                                            'language' => [
                                                'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                                            ],
                                            'ajax' => [
                                                'url' => $urlDV,
                                                'dataType' => 'json',
                                                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                                                'delay' => 1000,
                                            ],
                                            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                                            'templateSelection' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
                                            'templateResult' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
//
                                        ],
                                    ])->label('Đơn vị công tác'); ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <?= $form->field($model['chuyengia'], 'dia_chi')->textInput(['maxlength' => true])->label('Địa chỉ') ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <?= $form->field($model['chuyengia'], 'dien_thoai')->textInput(['maxlength' => true])->label('Điện thoại') ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($model['chuyengia'], 'email')->input('email')->label('Email') ?>
                                </div>
                            </div>
                            <div style="clear: both"></div>

                        </div>

                        <div class="tab-pane" id="nghiencuu">
                            <div class="col-lg-12">
                                <?= $form->field($model['chuyengia'],'dinh_huong')->textarea()->label('Định hướng nghiên cứu')?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['chuyengia'],'congtrinh_nghiencuu')->textarea()->label('Công trình nghiên cứu')?>
                            </div>
                            <div style="clear: both"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-left">Thêm mới chuyên gia</button>
                    <a href="<?= Yii::$app->urlManager->createUrl('dschuyengia') ?>"
                       class="btn btn-default pull-right">Danh sách chuyên gia</a>
                </div>
                <div style="clear: both"></div>

            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<div style="clear: both"></div>
<script>
    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });

</script>


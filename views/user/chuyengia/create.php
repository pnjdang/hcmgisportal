<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\select2\Select2;

$urlDV = \yii\helpers\Url::to(['danhmuc/chuyengia/donvi/donvi']);
$urlCN = \yii\helpers\Url::to(['danhmuc/chuyengia/linhvucnghiencuucap3/linhvuccap3']);
?>

<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="<?= Yii::$app->homeUrl ?>">Trang chủ</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/index') ?>">Danh sách chuyên gia</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Đăng ký thông tin chuyên gia</span>
    </li>
</ul>



<div class="row">
    <div class="col-lg-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="font-blue-steel">Đăng ký thông tin chuyên gia</span>
                </div>

            </div>
            <div class="portlet-body">
                <?php
                $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'skin skin-square'
                    ]
                ])
                ?>

                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <?= $form->field($model['chuyengia'], 'ho_ten')->textInput(['maxlength' => true])->label('Họ và tên') ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model['chuyengia'], 'nam_sinh')->input('number')->label('Năm sinh') ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model['chuyengia'], 'gioi_tinh')->dropDownList([1 => 'Nam', 2 => 'Nữ'], ['prompt' => 'Chọn giới tính'])->label('Giới tính') ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <?= $form->field($model['chuyengia'], 'hocham_id')->dropDownList(ArrayHelper::map($model['hocham'], 'id_hh', 'ten_hh'), ['prompt' => 'Chọn Học hàm'])->label('Học hàm') ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model['chuyengia'], 'nam_hocham')->input('number')->label('Năm được phong') ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model['chuyengia'], 'hocvi_id')->dropDownList(ArrayHelper::map($model['hocvi'], 'id_hv', 'ten_hv'), ['prompt' => 'Chọn Học vị'])->label('Học vị') ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model['chuyengia'], 'nam_hocvi')->input('number')->label('Năm đạt học vị') ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?= $form->field($model['chuyengia'], 'linhvucnghiencuu')->checkboxList(ArrayHelper::map($model['linhvucnghiencuu'], 'id_cap1', 'ten_cap1'), [
                            'itemOptions' => ['unchecked' => null],
                            'item' => function ($index, $label, $name, $checked, $value) {
                                return "<label class='col-md-6'><input type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'> {$label}</label>";
                            },
                        ])->label('Lĩnh vực hoạt động trong 5 năm gần đây') ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?= $form->field($model['chuyengia'], 'chuyennganh')->widget(Select2::classname(), [
                            'options' => ['multiple' => true],
                            'pluginOptions' => [
                                'maximumInputLength' => 10,
                                'allowClear' => true,
                                'language' => [
                                    'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                                ],
                                'ajax' => [
                                    'url' => $urlCN,
                                    'dataType' => 'json',
                                    'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                                    //'delay' => 1000,
                                ],
                                'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                                'templateSelection' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
                                'templateResult' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
//
                            ],
                        ])->label('Chuyên ngành');
                        ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <?= $form->field($model['chuyengia'], 'congviec_hiennay')->input('text')->label('Công việc hiện nay') ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model['chuyengia'], 'chucvu_hientai')->input('text')->label('Chức vụ hiện tại') ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?= $form->field($model['chuyengia'], 'diachi_nharieng')->textInput(['maxlength' => true])->label('Địa chỉ nhà riêng') ?>
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
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?= $form->field($model['chuyengia'], 'donvi_id')->widget(Select2::classname(), [
                            'options' => ['placeholder' => 'Chọn đơn vị công tác'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'language' => [
                                    'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                                ],
                                'ajax' => [
                                    'url' => $urlDV,
                                    'dataType' => 'json',
                                    'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                                    //'delay' => 1000,
                                ],
                                'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                                'templateSelection' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
                                'templateResult' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
//
                            ],
                        ])->label('Đơn vị công tác');
                        ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success pull-left">Thêm mới chuyên gia</button>
                    <a href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/index') ?>"
                       class="btn btn-default pull-right">Danh sách chuyên gia</a>
                </div>
                <div style="clear: both"></div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>


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
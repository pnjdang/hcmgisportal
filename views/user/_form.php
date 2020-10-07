<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\VChuyengia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vchuyengia-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-12">
        <div class="col-sm-12">
            <?= $form->field($model, 'ho_ten')->textInput(['maxlength' => true])->label('Họ và tên') ?>
        </div>

    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <?= $form->field($model, 'nam_sinh')->input('text', ['onkeypress' => 'return event.charCode>= 48 && event.charCode <= 57'])->label('Năm sinh') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'gioi_tinh')->dropDownList([1 => 'Nam', 2 => 'Nữ'], ['prompt' => 'Chọn giới tính'])->label('Giới tính') ?>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <?= $form->field($model, 'hh_id')->dropDownList(ArrayHelper::map($hocham, 'id_hh', 'ten_hh'), ['prompt' => 'Chọn Học hàm'])->label('Học hàm') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'hv_id')->dropDownList(ArrayHelper::map($hocvi, 'id_hv', 'ten_hv'), ['prompt' => 'Chọn Học vị'])->label('Học vị') ?>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-12">
            <?= $form->field($model, 'lvql_id')->dropDownList(ArrayHelper::map($linhvucquanly, 'id_lvql', 'ten_lvql'), ['prompt' => 'Chọn Lĩnh vực quản lý'])->label('Lĩnh vực quản lý') ?>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <?= $form->field($model, 'chuyen_mon')->textInput(['maxlength' => true])->label('Chuyên ngành') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'chuc_vu')->textInput(['maxlength' => true])->label('Chức vụ') ?>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-12">
            <?= $form->field($model, 'dinh_huong')->textarea(['style' => 'height: 100%'])->label('Định hướng nghiên cứu') ?>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-12">
            <?= $form->field($model, 'congtrinh_nghiencuu')->textarea(['style' => 'height: 100%'])->label('Các công trình nghiên cứu') ?>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <?= $form->field($model, 'donvi_congtac')->textInput(['maxlength' => true])->label('Đơn vị công tác') ?>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="col-sm-12">
            <?= $form->field($model, 'dia_chi')->textInput(['maxlength' => true])->label('Địa chỉ') ?>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <?= $form->field($model, 'dien_thoai')->textInput(['maxlength' => true])->label('Điện thoại') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'email')->input('email')->label('Email') ?>
        </div>
    </div>

    <?php if (!Yii::$app->request->isAjax || isset($code)) { ?>
        <div class="col-sm-12 form-group">
            <div class="col-sm-12">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
                <button type="submit"
                        class="btn btn-success pull-left"><?= $model->isNewRecord ? 'Thêm mới' : 'Cập nhật' ?></button>
            </div>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>


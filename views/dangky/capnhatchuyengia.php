<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php $form = ActiveForm::begin() ?>
<div class='col-md-12'>
    <div class='panel panel-default'>
        <div class='panel-heading' style="background-color: #026fb7">
            <h4 class='panel-title' align="center" style="color: white; font-family: Tahoma">PHIẾU ĐĂNG KÝ THÔNG TIN CHUYÊN GIA </h4>
        </div>
        <div class='panel-body'>
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'ho_ten')->textInput(['maxlength' => true])->label('Họ và tên', ['class' => 'font-weight-bold']) ?>
                    </div>

                </div> 
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'nam_sinh')->textInput()->label('Năm sinh', ['class' => 'font-weight-bold']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'gioi_tinh')->dropDownList([1 => 'Nam', 0 => 'Nữ'], ['prompt' => 'Chọn giới tính'])->label('Giới tính', ['class' => 'font-weight-bold']) ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'id_hh')->dropDownList(ArrayHelper::map($hocham, 'id_hh', 'ten_hh'), ['prompt' => 'Chọn Học hàm'])->label('Học hàm', ['class' => 'font-weight-bold']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'id_hv')->dropDownList(ArrayHelper::map($hocvi, 'id_hv', 'ten_hv'), ['prompt' => 'Chọn Học vị'])->label('Học vị', ['class' => 'font-weight-bold']) ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'id_lvql')->dropDownList(ArrayHelper::map($linhvucquanly, 'id_lvql', 'ten_lvql'), ['prompt' => 'Chọn Lĩnh vực quản lý'])->label('Lĩnh vực quản lý', ['class' => 'font-weight-bold']) ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'chuyen_mon')->textInput(['maxlength' => true])->label('Chuyên môn', ['class' => 'font-weight-bold']) ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'id_dvct')->dropDownList(ArrayHelper::map($donvicongtac, 'id_dvct', 'ten_dvct'), ['prompt' => 'Chọn Loại hình'])->label('Loại hình tổ chức', ['class' => 'font-weight-bold']) ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'donvi_congtac')->textInput(['maxlength' => true])->label('Đơn vị công tác', ['class' => 'font-weight-bold']) ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'dia_chi')->textInput(['maxlength' => true])->label('Địa chỉ', ['class' => 'font-weight-bold']) ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'dien_thoai')->textInput(['maxlength' => true])->label('Điện thoại', ['class' => 'font-weight-bold']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Email', ['class' => 'font-weight-bold']) ?>
                    </div>
                </div>
              
            </div>
        </div>
        <div class="form-group" style="text-align: center">
            <button id="submitBtn" type="submit" class="btn btn-animated btn-success" >Câp nhật</button>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
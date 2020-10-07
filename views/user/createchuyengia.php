<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model['pdk'] app\models\VChuyengia */
/* @var $form yii\widgets\ActiveForm */
$urlDV = \yii\helpers\Url::to(['donvi/donvi']);

?>

<div class="vchuyengia-form">
    <?php $form = ActiveForm::begin(); ?>
    <fieldset class="fieldset-border">
        <div class="col-sm-12">
            <div class="col-sm-12">
                <?= $form->field($model['pdk'], 'ho_ten')->textInput(['maxlength' => true])->label('Họ và tên') ?>
            </div>
        </div> 
        <div class="col-sm-12">
            <div class="col-sm-6">
                <?= $form->field($model['pdk'], 'nam_sinh')->input('text',['onkeypress' => 'return event.charCode>= 48 && event.charCode <= 57'])->label('Năm sinh') ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model['pdk'], 'gioi_tinh')->dropDownList([1 => 'Nam', 2 => 'Nữ'], ['prompt' => 'Chọn giới tính'])->label('Giới tính') ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <?= $form->field($model['pdk'], 'hh_id')->dropDownList(ArrayHelper::map($model['hocham'], 'id_hh', 'ten_hh'), ['prompt' => 'Chọn Học hàm'])->label('Học hàm') ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model['pdk'], 'hv_id')->dropDownList(ArrayHelper::map($model['hocvi'], 'id_hv', 'ten_hv'), ['prompt' => 'Chọn Học vị'])->label('Học vị') ?>
            </div>
        </div>
        <div class="col-sm-12">
             <div class="col-sm-12">
            <?= $form->field($model['pdk'], 'lvql_id')->dropDownList(ArrayHelper::map($model['linhvucquanly'], 'id_lvql', 'ten_lvql'), ['prompt' => 'Chọn Lĩnh vực quản lý'])->label('Lĩnh vực quản lý') ?>
             </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-12">
                <?= $form->field($model['pdk'], 'chuyen_mon')->textInput(['maxlength' => true])->label('Chuyên môn') ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-12">
                <?= $form->field($model['pdk'], 'dvct_id')->dropDownList(ArrayHelper::map($model['donvicongtac'], 'id_dvct', 'ten_dvct'), ['prompt' => 'Chọn Loại hình'])->label('Loại hình tổ chức') ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-12">
                <?= $form->field($model['pdk'], 'donvi_id')->widget(Select2::classname(), [
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
                <?= $form->field($model['pdk'], 'dia_chi')->textInput(['maxlength' => true])->label('Địa chỉ') ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <?= $form->field($model['pdk'], 'dien_thoai')->textInput(['maxlength' => true])->label('Điện thoại') ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model['pdk'], 'email')->input('email')->label('Email') ?>
            </div>
        </div>
    </fieldset>

    <?php if (!Yii::$app->request->isAjax || isset($code)) { ?>
        <div class="form-group">
            <div class="modal-footer"><button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button><button type="submit" class="btn btn-success"><?= $model['pdk']->isNewRecord ? 'Thêm mới' : 'Cập nhật'?></button></div>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>


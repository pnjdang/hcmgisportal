<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ['pdk'] app\models\VChuyengia */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Cập nhật thông tin đề tài</h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="col-sm-12">
        <h3>Chuyên gia: <?= $model['detai']->chuyengia->ho_ten?></h3>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model['detai'], 'ten_detai')->textarea()->label('Tên đề tài') ?>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model['detai'], 'chuong_trinh')->input('text')->label('Chương trình') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['detai'], 'vai_tro')->dropDownList([1 => 'Chủ trì',2 => 'Tham gia'],['prompt' => 'Chọn vai trò'])->label('Vai trò') ?>
    </div>
    <div class="col-sm-9">
        <?= $form->field($model['detai'], 'noi_dung')->input('text')->label('Nội dung công việc tham gia') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['detai'], 'nam_batdau')->input('number')->label('Năm bắt đầu') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['detai'], 'nam_ketthuc')->input('number')->label('Năm kết thúc') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['detai'], 'tinh_trang')->dropDownList([1 => 'Đã nghiệm thu',0 => 'Chưa nghiệm thu'],['prompt' => 'Chọn vai trò'])->label('Tình trạng') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['detai'], 'xep_loai')->input('text')->label('Xếp loại') ?>
    </div>


    <div style="clear:both;"></div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-warning pull-left">Cập nhật</button>
    <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
</div>
<?php ActiveForm::end() ?>


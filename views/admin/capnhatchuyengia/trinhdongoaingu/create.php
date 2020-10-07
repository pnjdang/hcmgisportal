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
    <h4 class="modal-title">Thêm mới trình độ ngoại ngữ</h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="col-sm-12">
        <h3>Chuyên gia: <?= $model['chuyengia']->ho_ten?></h3>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model['trinhdongoaingu'], 'ngoaingu_id')->dropDownList(ArrayHelper::map($model['ngoaingu'],'id_ngoaingu','ten_ngoaingu'), ['prompt' => 'Chọn ngoại ngữ'])->label('Ngoại ngữ') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['trinhdongoaingu'], 'nghe')->dropDownList(['Tốt' => 'Tốt','Khá' => 'Khá', 'Trung bình' => 'Trung bình'], ['prompt' => 'Chọn trình độ'])->label('Nghe') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['trinhdongoaingu'], 'noi')->dropDownList(['Tốt' => 'Tốt','Khá' => 'Khá', 'Trung bình' => 'Trung bình'], ['prompt' => 'Chọn trình độ'])->label('Nói') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['trinhdongoaingu'], 'doc')->dropDownList(['Tốt' => 'Tốt','Khá' => 'Khá', 'Trung bình' => 'Trung bình'], ['prompt' => 'Chọn trình độ'])->label('Đọc') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['trinhdongoaingu'], 'viet')->dropDownList(['Tốt' => 'Tốt','Khá' => 'Khá', 'Trung bình' => 'Trung bình'], ['prompt' => 'Chọn trình độ'])->label('Viết') ?>
    </div>

    <div style="clear:both;"></div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success pull-left">Thêm mới</button>
    <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
</div>
<?php ActiveForm::end() ?>


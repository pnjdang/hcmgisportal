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
    <h4 class="modal-title">Thêm mới công trình nghiên cứu</h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="col-sm-12">
        <h3>Chuyên gia: <?= $model['chuyengia']->ho_ten?></h3>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model['congtrinh'], 'ten_congtrinh')->textarea()->label('Tên công trình') ?>
    </div>
    <div class="col-sm-8">
        <?= $form->field($model['congtrinh'], 'loaicongtrinh_id')->dropDownList(ArrayHelper::map($model['loaicongtrinh'],'id_loaicongtrinh','ten_loaicongtrinh'), ['prompt' => 'Chọn loại công trình'])->label('Loại công trình nghiên cứu') ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model['congtrinh'], 'nam')->input('number')->label('Năm công cố') ?>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model['congtrinh'], 'noi_congbo')->input('text')->label('Nơi công bố') ?>
    </div>


    <div style="clear:both;"></div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success pull-left">Thêm mới</button>
    <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
</div>
<?php ActiveForm::end() ?>


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
    <h4 class="modal-title">Thêm mới quá trình công tác</h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="col-sm-12">
        <h3>Chuyên gia: <?= $model['chuyengia']->ho_ten?></h3>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model['congtac'], 'nam_batdau')->input('number')->label('Năm bắt đầu') ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model['congtac'], 'nam_ketthuc')->input('number')->label('Năm kết thúc') ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model['congtac'], 'so_thang')->input('number')->label('Số tháng') ?>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model['congtac'], 'noi_congtac')->input('text')->label('Nơi công tác') ?>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model['congtac'], 'vitri_congtac')->input('text')->label('Vị trí công tác') ?>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model['congtac'], 'linhvuc_congtac')->textarea()->label('Lĩnh vực công tác') ?>
    </div>

    <div style="clear:both;"></div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success pull-left">Thêm mới</button>
    <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
</div>
<?php ActiveForm::end() ?>


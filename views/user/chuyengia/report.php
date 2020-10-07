<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/31/2017
 * Time: 4:05 PM
 */
use kartik\form\ActiveForm;

?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Báo sai thông tin chuyên gia <?= $model['chuyengia']->ho_ten?></h4>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'report',
]) ?>
<div class="modal-body">
    <div class="col-lg-12">
        <?= $form->field($model['report'], 'truong_du_lieu_sai')->input('text')->label('Thông tin không chính xác') ?>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model['report'], 'thong_tin_dinh_chinh')->textarea()->label('Thông tin đính chính') ?>
    </div>
    <div style="clear: both"></div>
</div>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
    <button type="submit" class="btn btn-success pull-left">Gửi</button>
</div>
<?php ActiveForm::end() ?>

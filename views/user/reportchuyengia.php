<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/31/2017
 * Time: 4:05 PM
 */
use kartik\form\ActiveForm;
?>

<div class="row">
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin([
            'id' => 'report',
        ])?>
        <div class="col-lg-12 form-group">
            <?= $form->field($model,'truong_du_lieu_sai')->input('text')->label('Trường dữ liệu')?>
        </div>
        <div class="col-lg-12 form-group">
            <?= $form->field($model,'thong_tin_dinh_chinh')->textarea()->label('Thông tin đính chính')?>
        </div>
        <div class="col-lg-12 form-group">
            <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
            <button type="submit" class="btn btn-success pull-left">Gửi</button>
        </div>
        <?php ActiveForm::end()?>
    </div>
    <div style="clear: both"></div>
</div>

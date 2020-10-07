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
        <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Chi tiết phòng thí nghiệm') ?></h4>
    </div>
<?php $form = ActiveForm::begin([
    'id' => 'report',
]) ?>
    <div class="modal-body">
        <div class="form-group">
            <?= $form->field($model, 'truong_du_lieu_sai')->input('text')->label('Trường dữ liệu') ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'thong_tin_dinh_chinh')->textarea()->label('Thông tin đính chính') ?>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
        <button type="submit" class="btn btn-success pull-left">Gửi</button>
    </div>
<?php ActiveForm::end() ?>
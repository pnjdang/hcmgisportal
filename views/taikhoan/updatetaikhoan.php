<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/3/2017
 * Time: 2:00 PM
 */
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Cập nhật') ?></h4>
</div>
<?php $form = ActiveForm::begin([
]) ?>
<div class="modal-body custom-ajax-form" id="ajaxModalBody">


    <?= $form->field($model['taikhoan'], 'id_loaitk')->dropDownList(ArrayHelper::map($model['loaitaikhoan'], 'id_loaitk', 'ten_loaitk'))->label('Loại tài khoản') ?>
    <?= $form->field($model['taikhoan'], 'tinh_trang')->dropDownList([-1 => 'Xóa', 0 => 'Khóa', 1 => 'Kích hoạt'])->label('Tình trạng') ?>

</div>
<div class="modal-footer">
    <?= Html::input('submit', null, 'Cập nhật', ['class' => 'btn btn-warning pull-left']) ?>
    <?= Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => 'modal']) ?>
</div>
<?php ActiveForm::end() ?>

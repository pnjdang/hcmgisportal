<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/7/2017
 * Time: 4:30 PM
 */
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
?>
<?php $form = ActiveForm::begin([
    'id' => 'usercreate-thietbi',
    'enableClientValidation' => true, 'enableAjaxValidation' => false,
])?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Cập nhật thiết bị thử nghiệm') ?></h4>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <?= $form->field($model['sohuutritue'], 'ketquashtt_id')->dropDownList(ArrayHelper::map($model['ketquashtt'],'id_ketquashtt','ten_ketquashtt'))->label('Sở hữu trí tuệ'); ?>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model['sohuutritue'],'nam')->input('number')->label('Năm')?>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model['sohuutritue'],'so_luong')->input('number')->label('Số lượng')?>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model['sohuutritue'],'ghi_chu')->textarea()->label('Ghi chú')?>
    </div>
    <div style="clear: both"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
    <button type="submit" class="btn btn-warning pull-left">Cập nhật</button>
</div>

<?php ActiveForm::end()?>


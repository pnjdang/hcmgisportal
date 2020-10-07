<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/7/2017
 * Time: 4:30 PM
 */
use kartik\form\ActiveForm;
use kartik\select2\Select2;
$urlTB = \yii\helpers\Url::to(['thietbi/thietbi']);
?>
<?php $form = ActiveForm::begin([
    'id' => 'usercreate-thietbi',
    'enableClientValidation' => true, 'enableAjaxValidation' => false,
])?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Thêm mới thiết bị thử nghiệm') ?></h4>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <?= $form->field($model['thietbithunghiem'], 'thietbi_id')->widget(Select2::classname(), [
            'options' => ['placeholder' => 'Chọn thiết bị ...',],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 1,
                'language' => [
                    'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                ],
                'ajax' => [
                    'url' => $urlTB,
                    'dataType' => 'json',
                    'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                    'delay' => 1000,
                ],
                'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                'templateSelection' => new \yii\web\JsExpression('function(chunhiem) { return chunhiem.text; }'),
                'templateResult' => new \yii\web\JsExpression('function(chunhiem) { return chunhiem.text; }'),
            ],
        ])->label('Thiết bị'); ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model['thietbithunghiem'],'so_hieu')->input('text')->label('Số hiệu')?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model['thietbithunghiem'],'nam_sx')->input('text')->label('Năm sản xuất')?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model['thietbithunghiem'],'hang_sx')->input('text')->label('Hãng sản xuất')?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model['thietbithunghiem'],'so_luong')->input('number')->label('Số lượng')?>
    </div>
    <div class="col-lg-8">
        <?= $form->field($model['thietbithunghiem'],'tinh_trang')->input('text')->label('Tình trạng')?>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model['thietbithunghiem'],'dactinh_kythuat')->textarea()->label('Đặc tính kỹ thuật')?>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model['thietbithunghiem'],'ghi_chu')->textarea()->label('Ghi chú')?>
    </div>
    <div style="clear: both"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
    <button type="submit" class="btn btn-success pull-left">Thêm mới</button>
</div>

<?php ActiveForm::end()?>


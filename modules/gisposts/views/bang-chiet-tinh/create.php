<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/9/2021
 * Time: 11:02 AM
 */

use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;


$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<div class="row">
    <div class="col-lg-12">
        <h4>Bảng chiết tính Hợp đồng thuê nhà <?= $model['fulldiachi']?></h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <?= $form->field($model['bangchiettinh'], 'nguoi_thue')->input('text')->label('Họ tên') ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model['bangchiettinh'], 'tu_ngay')->widget(MaskedInput::class,[
            'clientOptions' => ['alias' =>  'dd/mm/yyyy']
        ])->label('Từ ngày') ?>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model['bangchiettinh'],'phap_ly')->textarea()->label('Pháp lý')?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model['bangchiettinh'], 'quyetdinh_id')->dropDownList(ArrayHelper::map($model['quyetdinh'], 'id_quyetdinh', 'text_short'), ['id' => 'quyetdinh', 'prompt' => 'Chọn quyết định giá thuê'])->label('Quyết định giá thuê') ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model['bangchiettinh'], 'dien_tich')->input('number', ['value' => $model['hopdong']->thongtinho->dien_tich_su_dung,'step' => '.01'])->label('Diện tích') ?>
    </div>

    <?php if(!Yii::$app->request->isAjax):?>
    <div class="row">
        <div class="col-lg-12">
            <?= \yii\helpers\Html::submitButton('Lưu',['class' => 'btn btn-primary'])?>
        </div>
    </div>
    <?php endif;?>
</div>

<?php ActiveForm::end()?>

<script>
    $('#quyetdinh').change(function () {
        $('.div-quyetdinh').hide();
        $('#div' + $(this).val()).show();
    });


    function tinhgiathue(i){
        var k2 = $('#k2'+i).val();
        var k3 = $('#k3'+i).val();
        var k4 = $('#k4'+i).val();
        console.log(1+ k2 + k3 + k4)
    }
</script>

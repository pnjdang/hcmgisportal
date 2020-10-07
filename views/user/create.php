<?php

use yii\helpers\Html;


use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>


<?php $form = ActiveForm::begin() ?>
<div class="col-lg-12" style="text-align: center">
    <h3>PHIẾU THÔNG TIN VỀ PHÒNG THÍ NGHIỆM</h3>
</div>

<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'], 'ten_tv')->input('text')->label('1.1. Tên PTN tiếng Việt') ?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'], 'ten_ta')->input('text')->label('1.2. Tên PTN tiếng Anh') ?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'], 'coquan_chuquan')->input('text')->label('2. Cơ quan chủ quản') ?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'], 'dia_chi')->input('text')->label('3. Địa chỉ') ?>
</div>
<div class="col-lg-12">
    <label>4. Liên hệ</label>

    <div class="col-lg-12">
        <div class="col-lg-6">
            <?= $form->field($model['phongthinghiem'], 'dien_thoai')->input('text', ['onkeypress' => "return event.charCode>= 48 && event.charCode <= 57"])->label('Điện thoại') ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model['phongthinghiem'], 'fax')->input('text', ['onkeypress' => "return event.charCode>= 48 && event.charCode <= 57"])->label('Fax') ?>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-6">
            <?= $form->field($model['phongthinghiem'], 'email')->input('email')->label('Email') ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model['phongthinghiem'], 'website')->input('text')->label('Website') ?>
        </div>
    </div>
</div>


<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'], 'phu_trach')->input('text')->label('5. Người phụ trách PTN') ?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'], 'dai_dien')->input('text')->label('6. Người đại diện') ?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'], 'dactrung_hoatdong')->textarea()->label('7. Đặc trưng hoạt động') ?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'], 'checked')->checkboxList(ArrayHelper::map($model['dmlvtn'], 'id_lv', 'ten_lv'), [
        'itemOptions' => ['unchecked' => null],
        'item' => function ($index, $label, $name, $checked, $value) {
            return "<label class='col-md-6'><input type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'>{$label}</label>";
        },
        'class' => 'switch switch-default switch-success-outline-alt'])->label('8. Lĩnh vực thử nghiệm') ?>
</div>
<div class="col-lg-12">
    <label class="control-label">9. Vật liệu và sản phẩm thử nghiệm</label>
<?php if ($model['dmchungloai'] != null): ?>
    <?php foreach ($model['dmchungloai'] as $i => $cl): ?>
        <div class="col-lg-12">
            <?= $form->field($cl, 'phanloaiChecked')->checkboxList(ArrayHelper::map($cl->phanLoais, 'id_pl', 'ten_pl'), [
                'itemOptions' => ['unchecked' => null],
                'label' => null,
                'item' => function ($index, $label, $name, $checked, $value) {
                    return "<label class='col-md-12'>" . ($index + 1) . ".&nbsp;&nbsp;<input type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'>{$label}</label>";
                },
                'class' => ''])->label($cl->ten_cl) ?>
        </div>
    <?php endforeach ?>
    <div class="col-lg-12 form-group">
        <textarea class="form-control"></textarea>
    </div>
<?php endif ?>
    </div>
<div class="col-lg-12">

<?= $form->field($model['phongthinghiem'], 'tieuchuanChecked')->checkboxList(ArrayHelper::map($model['dmtieuchuan'], 'id_tc', 'ten_tc'), [
    'itemOptions' => ['unchecked' => null],
    'item' => function ($index, $label, $name, $checked, $value) {
        return "<label class='col-md-6'><input type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'>{$label}</label>";
    },
    'class' => 'switch switch-default switch-success-outline-alt'])->label('10. Các phương pháp thử chủ yếu', ['class' => 'font-weight-bold']) ?>
</div>
<div class="col-lg-12">
    <label class="control-label">11. Các thiết bị thử nghiệm chính</label>
</div>
<div class="col-lg-12">
    <label class="control-label">12. Nhân sự PTN</label>
</div>
<div class="col-lg-3">
    <?= $form->field($model['phongthinghiem'],'tien_si')->input('text',['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('Tiến sĩ')?>
</div>
<div class="col-lg-3">
    <?= $form->field($model['phongthinghiem'],'thac_si')->input('text',['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('Thạc sĩ')?>
</div>
<div class="col-lg-3">
    <?= $form->field($model['phongthinghiem'],'cu_nhan')->input('text',['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('Kỹ sư/Cử nhân')?>
</div>
<div class="col-lg-3">
    <?= $form->field($model['phongthinghiem'],'ky_thuat')->input('text',['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('kỹ thuật viên')?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'],'dien_tich')->input('text',['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('13. Diện tích hữu dụng của PTN, m<sup>2</sup> (nếu có được):')?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'],'gia_tri_uoc_tinh')->input('text')->label('14. Giá trị ước tính thiết bị thử nghiệm hiện nay , VNĐ, USD (nếu có)')?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'], 'chatluongChecked')->checkboxList(ArrayHelper::map($model['dmchatluong'], 'id_cncl', 'tieu_chuan'), [
        'itemOptions' => ['unchecked' => null],
        'item' => function ($index, $label, $name, $checked, $value) {
            return "<label class='col-md-6'><input type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'>{$label}</label>";
        },
        'class' => 'switch switch-default switch-success-outline-alt'])->label('15. PTN được Công nhận và/hoặc được Chỉ định', ['class' => 'font-weight-bold']) ?>
</div>
<div class="col-lg-12">
    <textarea class="form-control"></textarea>
</div>
<div class="col-lg-12">
    <label>16. </label>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'],'id_dtpv')->radioList(ArrayHelper::map($model['dmdoituong'], 'id_dtpv', 'ten_dtpv'))->label('17. Đối tượng phục vụ của PTN')?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'],'dinh_huong')->textarea()->label('18. Hướng phát triển trong thời gian tới (khoảng 5 năm, nếu có)')?>
</div>
<div class="col-lg-12">
    <?= $form->field($model['phongthinghiem'],'xac_nhan')->checkbox([], false)->label('19. Đưa các thông tin trên đây của PTN vào danh mục')?>
</div>

<?php if (!Yii::$app->request->isAjax || isset($code)){ ?>
    <div class="col-lg-12 form-group">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-success pull-left">Thêm mới</button>
    </div>
<?php } ?>
<div style="clear: both"></div>
<?php ActiveForm::end(); ?>


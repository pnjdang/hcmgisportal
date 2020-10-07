<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>


<?php $form = ActiveForm::begin() ?>
<div class='col-md-12 '>
    <div class='panel panel-default'>
        <div class='panel-heading' style="background-color: #026fb7">
            <h4 class='panel-title' align="center" style="color: white; font-family: Tahoma">PHIẾU ĐĂNG KÝ THÔNG TIN PHÒNG THÍ NGHIỆM </h4>
        </div>
        <div class='panel-body'>

            <div class="col-sm-12">
                <?= $form->field($model, 'ten_tv')->input('text')->label('1.1. Tên PTN tiếng Việt') ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'ten_ta')->input('text')->label('1.2. Tên PTN tiếng Anh') ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'coquan_chuquan')->input('text')->label('2. Cơ quan chủ quản') ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'dia_chi')->input('text')->label('3. Địa chỉ') ?>
            </div>
            <div class="col-sm-12">
                <label>4. Liên hệ</label>

                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'dien_thoai')->input('text', ['onkeypress' => "return event.charCode>= 48 && event.charCode <= 57"])->label('Điện thoại') ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'fax')->input('text', ['onkeypress' => "return event.charCode>= 48 && event.charCode <= 57"])->label('Fax') ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'email')->input('email')->label('Email') ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'website')->input('text')->label('Website') ?>
                    </div>
                </div>
            </div>


            <div class="col-sm-12">
                <?= $form->field($model, 'phu_trach')->input('text')->label('5. Người phụ trách PTN') ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'dai_dien')->input('text')->label('6. Người đại diện') ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'dactrung_hoatdong')->textarea(['style' => 'height: 100%'])->label('7. Đặc trưng hoạt động') ?>
            </div>
            <div class="col-sm-12">
                <?=
                $form->field($model, 'checked')->checkboxList(ArrayHelper::map($dmlvtn, 'id_lv', 'ten_lv'), [
                    'itemOptions' => ['unchecked' => null],
                    'item' => function ($index, $label, $name, $checked, $value) {
                $c = ($checked == 1) ? 'checked' : '';
                return "<label class='col-md-6'><input type='checkbox'" . $c . "  name='{$name}' value='{$value}' tabindex='3'>{$label}</label>";
            },
                    'class' => 'switch switch-default switch-success-outline-alt'])->label('8. Lĩnh vực thử nghiệm', ['class' => 'font-weight-bold'])
                ?>
            </div>
            <div class="col-sm-12">
                <label>9. Vật liệu và sản phẩm thử nghiệm</label>
                <?php if ($dmchungloai != null): ?>
                    <?php foreach ($dmchungloai as $i => $cl): ?>
                        <div class="col-sm-12">
                            <?=
                            $form->field($cl, 'phanloaiChecked')->checkboxList(ArrayHelper::map($cl->phanLoais, 'id_pl', 'ten_pl'), [
                                'itemOptions' => ['unchecked' => null],
                                'label' => null,
                                'item' => function ($index, $label, $name, $checked, $value) {
                            return "<label class='col-md-12'>" . ($index + 1) . ".&nbsp;&nbsp;<input type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'>{$label}</label>";
                        },
                                'class' => ''])->label($cl->ten_cl, ['class' => 'font-weight-bold'])
                            ?>
                        </div>
                    <?php endforeach ?>
                    <div class="col-sm-12 form-group">
                        <?= $form->field($model, 'ghichu_chungloai')->textarea()->label('Khác:') ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="col-sm-12">
                <?=
                $form->field($model, 'tieuchuanChecked')->checkboxList(ArrayHelper::map($dmtieuchuan, 'id_tc', 'ten_tc'), [
                    'itemOptions' => ['unchecked' => null],
                    'item' => function ($index, $label, $name, $checked, $value) {
                return "<label class='col-md-6'><input type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'>{$label}</label>";
            },
                    'class' => 'switch switch-default switch-success-outline-alt'])->label('10. Các phương pháp thử chủ yếu', ['class' => 'font-weight-bold'])
                ?>
                <div class="col-sm-12">
                    <?= $form->field($model, 'ghichu_tieuchuan')->textarea()->label('Số hiệu:') ?>
                </div>
            </div>
            <div class="col-sm-12">
                <label>14. Các thiết bị thử nghiệm chính</label>
                <?= $form->field($model, 'ghi_chu')->fileInput(['multiple' => 'multiple']); ?>
            </div>
            <div class="col-sm-12">
                <label>12. Nhân sự PTN</label>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'tien_si')->input('text', ['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('Tiến sĩ') ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'thac_si')->input('text', ['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('Thạc sĩ') ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'cu_nhan')->input('text', ['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('Kỹ sư/Cử nhân') ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'ky_thuat')->input('text', ['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('kỹ thuật viên') ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'dien_tich')->input('text', ['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('13. Diện tích hữu dụng của PTN, m<sup>2</sup> (nếu có được):') ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'gia_tri_uoc_tinh')->input('text')->label('14. Giá trị ước tính thiết bị thử nghiệm hiện nay , VNĐ, USD (nếu có)') ?>
            </div>
            <div class="col-sm-12">
                <?=
                $form->field($model, 'chatluongChecked')->checkboxList(ArrayHelper::map($dmchatluong, 'id_cncl', 'tieu_chuan'), [
                    'itemOptions' => ['unchecked' => null],
                    'item' => function ($index, $label, $name, $checked, $value) {
                return "<label class='col-md-6'><input type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'>{$label}</label>";
            },
                    'class' => 'switch switch-default switch-success-outline-alt'])->label('15. PTN được Công nhận và/hoặc được Chỉ định', ['class' => 'font-weight-bold'])
                ?>
                <div class="col-sm-12">
                    <?= $form->field($model, 'ghichu_chatluong')->textarea()->label('Lĩnh vực chỉ đỉnh khác:') ?>
                </div>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'id_dtpv')->radioList(ArrayHelper::map($dmdoituong, 'id_dtpv', 'ten_dtpv'))->label('17. Đối tượng phục vụ của PTN') ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'dinh_huong')->textarea()->label('18. Hướng phát triển trong thời gian tới (khoảng 5 năm, nếu có)') ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
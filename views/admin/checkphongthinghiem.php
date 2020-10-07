<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\file\FileInput;

?>

<?php $form = ActiveForm::begin([
    'id' => 'update-pdk',
    'options' => [
        'class' => 'skin skin-square',
        'enctype' => 'multipart/form-data'
    ]
]) ?>


<div class="row">
    <div class="col-lg-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="font-blue-steel">Cập nhật thông tin phòng thí nghiệm</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="tabbable-line form-group">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#thongtinchung">Thông tin chung</a></li>
                        <li><a data-toggle="tab" href="#vatlieuthunghiem">Vật liệu và sản phẩm thử nghiệm</a></li>
                        <li><a data-toggle="tab" href="#thongtinkhac">Thông tin khác</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="thongtinchung">
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'ten_tv')->input('text',['value' => $model['temp']->ten_tv])->label('1.1. Tên PTN tiếng Việt') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'ten_ta')->input('text',['value' => $model['temp']->ten_ta])->label('1.2. Tên PTN tiếng Anh') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'coquan_chuquan')->input('text',['value' => $model['temp']->coquan_chuquan])->label('2. Cơ quan chủ quản') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'dia_chi')->input('text',['value' => $model['temp']->dia_chi])->label('3. Địa chỉ') ?>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label">4. Liên hệ</label>

                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <?= $form->field($model['phongthinghiem'], 'dien_thoai')->input('text', ['value' => $model['temp']->dien_thoai, 'onkeypress' => "return event.charCode>= 48 && event.charCode <= 57"])->label('Điện thoại') ?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?= $form->field($model['phongthinghiem'], 'fax')->input('text', ['value' => $model['temp']->fax,'onkeypress' => "return event.charCode>= 48 && event.charCode <= 57"])->label('Fax') ?>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <?= $form->field($model['phongthinghiem'], 'email')->input('email',['value' => $model['temp']->email])->label('Email') ?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?= $form->field($model['phongthinghiem'], 'website')->input('text',['value' => $model['temp']->website])->label('Website') ?>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <?= $form->field($model['phongthinghiem'], 'phu_trach')->input('text',['value' => $model['temp']->phu_trach])->label('5. Người phụ trách PTN') ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model['phongthinghiem'], 'dai_dien')->input('text',['value' => $model['temp']->dai_dien])->label('6. Người đại diện') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'dactrung_hoatdong')->textarea()->label('7. Đặc trưng hoạt động') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'linhvucChecked')->checkboxList(ArrayHelper::map($model['dmlvtn'], 'id_lv', 'ten_lv'), [
                                    'itemOptions' => ['unchecked' => null],
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        ($checked == 1) ? $c = 'checked' : $c = '';
                                        return "<label class='col-md-6'><input type='checkbox' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";                                    },
                                    'class' => 'switch switch-default switch-success-outline-alt'])->label('8. Lĩnh vực thử nghiệm') ?>
                            </div>
                            <div class="col-lg-12">
                                <button type="button" class="btnNext btn btn-primary pull-right"><i class="fa fa-angle-double-right"></i> Vật liệu và sản phẩm thử nghiệm</button>
                            </div>
                            <div style="clear: both"></div>

                        </div>
                        <div class="tab-pane" id="vatlieuthunghiem">
                            <div class="col-lg-12">
                                <label class="control-label">9. Vật liệu và sản phẩm thử nghiệm</label>
                                <?php if ($model['dmchungloai'] != null): ?>
                                    <?php foreach ($model['dmchungloai'] as $i => $cl): ?>
                                        <div class="col-lg-12">
                                            <?=
                                            $form->field($model['phongthinghiem'], 'phanloaiChecked[' . $cl->id_cl . ']')->checkboxList(ArrayHelper::map($cl->phanLoais, 'id_pl', 'ten_pl'), [
                                                'itemOptions' => ['unchecked' => null],
                                                'label' => null,
                                                'item' => function ($index, $label, $name, $checked, $value) {
                                                    ($checked == 1) ? $c = 'checked' : $c = '';
                                                    return "<label class='col-md-12'><input type='checkbox' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";
                                                },
                                                'class' => ''])->label($cl->ten_cl, ['class' => 'font-weight-bold'])
                                            ?>
                                        </div>
                                    <?php endforeach ?>
                                    <div class="col-lg-12 form-group">
                                        <textarea class="form-control"></textarea>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="col-lg-12">
                                <button type="button" class="btnNext btn btn-primary pull-right"><i class="fa fa-angle-double-right"></i> Thông tin khác</button>
                                <button type="button" class="btnPrevious btn btn-default pull-left"><i class="fa fa-angle-double-left"></i> Quay lại</button>
                            </div>
                            <div style="clear: both"></div>

                        </div>
                        <div class="tab-pane" id="thongtinkhac">
                            <div class="col-lg-12">

                                <?= $form->field($model['phongthinghiem'], 'tieuchuanChecked')->checkboxList(ArrayHelper::map($model['dmtieuchuan'], 'id_tc', 'ten_tc'), [
                                    'itemOptions' => ['unchecked' => null],
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        ($checked == 1) ? $c = 'checked' : $c = '';
                                        return "<label class='col-md-6'><input type='checkbox' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";                                    },
                                ])->label('10. Các phương pháp thử chủ yếu') ?>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label">12. Nhân sự PTN</label>
                            </div>
                            <div class="col-lg-3">
                                <?= $form->field($model['phongthinghiem'], 'tien_si')->input('number',['value' => $model['temp']->tien_si])->label('Tiến sĩ') ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $form->field($model['phongthinghiem'], 'thac_si')->input('number',['value' => $model['temp']->thac_si])->label('Thạc sĩ') ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $form->field($model['phongthinghiem'], 'cu_nhan')->input('number',['value' => $model['temp']->cu_nhan])->label('Kỹ sư/Cử nhân') ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $form->field($model['phongthinghiem'], 'ky_thuat')->input('number',['value' => $model['temp']->ky_thuat])->label('Kỹ thuật viên') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'dien_tich')->input('text', ['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('13. Diện tích hữu dụng của PTN, m<sup>2</sup> (nếu có được):') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'gia_tri_uoc_tinh')->input('text')->label('14. Giá trị ước tính thiết bị thử nghiệm hiện nay , VNĐ, USD (nếu có)') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'chatluongChecked')->checkboxList(ArrayHelper::map($model['dmchatluong'], 'id_cncl', 'tieu_chuan'), [
                                    'itemOptions' => ['unchecked' => null],
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        ($checked == 1) ? $c = 'checked' : $c = '';
                                        return "<label class='col-md-12'><input type='checkbox' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";                                    },
                                ])->label('15. PTN được Công nhận và/hoặc được Chỉ định') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'ghichu_chatluong')->textarea(['id' => 'chatluongKhac'])->label(false) ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'hoivienChecked')->checkboxList(ArrayHelper::map($model['dmhoivien'], 'id_tcht', 'ten_tc'), [
                                    'itemOptions' => ['unchecked' => null],
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        ($checked == 1) ? $c = 'checked' : $c = '';
                                        return "<label class='col-md-12'><input type='checkbox' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";                                    },
                                ])->label('16. PTN là hội viên của') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'dtpv_id')->radioList(ArrayHelper::map($model['dmdoituong'], 'id_dtpv', 'ten_dtpv'), [
                                    'itemOptions' => ['unchecked' => null],
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        ($checked == 1) ? $c = 'checked' : $c = '';
                                        return "<label class='col-md-12'><input type='radio' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";                                    },
                                ])->label('17. Đối tượng phục vụ của PTN') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'dinh_huong')->textarea()->label('18. Hướng phát triển trong thời gian tới (khoảng 5 năm, nếu có)') ?>
                            </div>
                            <div class="col-lg-12">
                                <?= $form->field($model['phongthinghiem'], 'xac_nhan')->checkbox(['class' => 'icheck','value' => $model['temp']->xac_nhan], false)->label('19. Đưa các thông tin trên đây của PTN vào danh mục') ?>
                            </div>
                            <div class="col-lg-12">
                                <button type="button" class="btnPrevious btn btn-default pull-left"><i class="fa fa-angle-double-left"></i> Quay lại</button>
                                <button type="submit" class="btn btn-warning pull-right"> Cập nhật thông tin</button>
                            </div>
                            <div style="clear: both"></div>
                        </div>
                    </div>
                </div>

                <div style="clear: both"></div>

            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<div style="clear: both"></div>

<script>
    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        $('.btnNext').click(function(){
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
        });
        $('.btnPrevious').click(function(){
            $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        });
    });


</script>
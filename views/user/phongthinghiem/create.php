<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>




<div class="row">
    <div class="col-lg-12">
        <div class="portlet light" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <span class="font-blue-steel">Đăng ký thông tin phòng thí nghiệm</span>
                </div>
            </div>
            <div class="portlet-body form">
                <?php
                    $form = ActiveForm::begin([
                        'id' => 'submit_form',
                        'options' => [
                            'class' => 'skin skin-square'
                        ]
                    ])
                ?>
                    <div class="form-wizard">
                        <div class="form-body">
                            <ul class="nav nav-pills nav-justified steps">
                                <li>
                                    <a href="#tab1" data-toggle="tab" class="step">
                                        <span class="number"> 1 </span>

                                        <div><span class="desc" style="font-size: 16px; font-weight: 300">
                                                                        <i class="fa fa-check"></i> Thông tin chung </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                        <span class="number"> 2 </span>

                                        <div><span class="desc" style="font-size: 16px; font-weight: 300">
                                                <i class="fa fa-check"></i> Lĩnh vực thử nghiệm </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab" class="step active">
                                        <span class="number"> 3 </span>

                                        <div><span class="desc" style="font-size: 16px; font-weight: 300">
                                                <i class="fa fa-check"></i> Vật liệu và sản phẩm thử nghiệm </span>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="#tab4" data-toggle="tab" class="step">
                                        <span class="number"> 4 </span>

                                        <div><span class="desc" style="font-size: 16px; font-weight: 300">
                                                <i class="fa fa-check"></i> Thông tin khác </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div id="bar" class="progress progress-striped" role="progressbar">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">

                                    <div class="form-group">
                                        <?= $form->field($model['ptn'],'ten_tv')->input('text')->label('Tên tiếng Việt')?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model['ptn'],'ten_ta')->input('text')->label('Tên tiếng Anh')?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model['ptn'],'coquan_chuquan')->input('text')->label('Cơ quan chủ quản')?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model['ptn'],'dia_chi')->input('text')->label('Địa chỉ')?>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-lg-12 no-padding-side">
                                            <div class="col-lg-6" style="padding-left: 0">
                                                <?= $form->field($model['ptn'], 'dien_thoai')->input('text', ['onkeypress' => "return event.charCode>= 48 && event.charCode <= 57"])->label('Điện thoại') ?>
                                            </div>
                                            <div class="col-lg-6" style="padding-right: 0">
                                                <?= $form->field($model['ptn'], 'fax')->input('text', ['onkeypress' => "return event.charCode>= 48 && event.charCode <= 57"])->label('Fax') ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 no-padding-side">
                                            <div class="col-lg-6" style="padding-left: 0">
                                                <?= $form->field($model['ptn'], 'email')->input('email')->label('Email') ?>
                                            </div>
                                            <div class="col-lg-6" style="padding-right: 0">
                                                <?= $form->field($model['ptn'], 'website')->input('text')->label('Website') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-6" style="padding-left: 0">
                                            <?= $form->field($model['ptn'], 'phu_trach')->input('text')->label('Người phụ trách PTN') ?>
                                        </div>
                                        <div class="col-lg-6" style="padding-right: 0">
                                            <?= $form->field($model['ptn'], 'dai_dien')->input('text')->label('Người đại diện') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model['ptn'], 'dactrung_hoatdong')->textarea()->label('Đặc trưng hoạt động') ?>
                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <div class="form-group">
                                        <?= $form->field($model['ptn'], 'linhvucChecked')->checkboxList(ArrayHelper::map($model['dmlvtn'], 'id_lv', 'ten_lv'), [
                                            'itemOptions' => ['unchecked' => null],
                                            'item' => function ($index, $label, $name, $checked, $value) {
                                                ($checked == 1) ? $c = 'checked' : $c = '';
                                                return "<label class='col-md-6'><input type='checkbox' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";                                    },
                                            'class' => 'switch switch-default switch-success-outline-alt'])->label('8. Lĩnh vực thử nghiệm') ?>
                                    </div>

                                    <div style="clear: both"></div>
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <div class="form-group">
                                        <label class="control-label">9. Vật liệu và sản phẩm thử nghiệm</label>
                                        <?php if ($model['dmchungloai'] != null): ?>
                                            <?php foreach ($model['dmchungloai'] as $i => $cl): ?>
                                                <div class="col-lg-12">
                                                    <?=
                                                    $form->field($model['ptn'], 'phanloaiChecked[' . $cl->id_cl . ']')->checkboxList(ArrayHelper::map($cl->phanLoais, 'id_pl', 'ten_pl'), [
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
                                                <?= $form->field($model['ptn'],'ghichu_chungloai')->textarea(['label' => false])->label('')?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                                <div class="tab-pane" id="tab4">
                                    <div class="col-lg-12">

                                        <?= $form->field($model['ptn'], 'tieuchuanChecked')->checkboxList(ArrayHelper::map($model['dmtieuchuan'], 'id_tc', 'ten_tc'), [
                                            'itemOptions' => ['unchecked' => null],
                                            'item' => function ($index, $label, $name, $checked, $value) {
                                                ($checked == 1) ? $c = 'checked' : $c = '';
                                                return "<label class='col-md-6'><input type='checkbox' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";                                    },
                                        ])->label('Các phương pháp thử chủ yếu') ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="control-label">Nhân sự PTN</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <?= $form->field($model['ptn'], 'tien_si')->input('number')->label('Tiến sĩ') ?>
                                    </div>
                                    <div class="col-lg-3">
                                        <?= $form->field($model['ptn'], 'thac_si')->input('number')->label('Thạc sĩ') ?>
                                    </div>
                                    <div class="col-lg-3">
                                        <?= $form->field($model['ptn'], 'cu_nhan')->input('number')->label('Kỹ sư/Cử nhân') ?>
                                    </div>
                                    <div class="col-lg-3">
                                        <?= $form->field($model['ptn'], 'ky_thuat')->input('number')->label('kỹ thuật viên') ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <?= $form->field($model['ptn'], 'dien_tich')->input('text', ['onkeypress' => "return event.charCode>= 46 && event.charCode <= 57"])->label('Diện tích hữu dụng của PTN, m<sup>2</sup> (nếu có được):') ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <?= $form->field($model['ptn'], 'gia_tri_uoc_tinh')->input('text')->label('Giá trị ước tính thiết bị thử nghiệm hiện nay , VNĐ, USD (nếu có)') ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <?= $form->field($model['ptn'], 'chatluongChecked')->checkboxList(ArrayHelper::map($model['dmchatluong'], 'id_cncl', 'tieu_chuan'), [
                                            'itemOptions' => ['unchecked' => null],
                                            'item' => function ($index, $label, $name, $checked, $value) {
                                                ($checked == 1) ? $c = 'checked' : $c = '';
                                                return "<label class='col-md-12'><input type='checkbox' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";                                    },
                                        ])->label('PTN được Công nhận và/hoặc được Chỉ định') ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <?= $form->field($model['ptn'], 'ghichu_chatluong')->textarea(['id' => 'chatluongKhac'])->label(false) ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <?= $form->field($model['ptn'], 'hoivienChecked')->checkboxList(ArrayHelper::map($model['dmhoivien'], 'id_tcht', 'ten_tc'), [
                                            'itemOptions' => ['unchecked' => null],
                                            'item' => function ($index, $label, $name, $checked, $value) {
                                                ($checked == 1) ? $c = 'checked' : $c = '';
                                                return "<label class='col-md-12'><input type='checkbox' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";                                    },
                                        ])->label('PTN là hội viên của') ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <?= $form->field($model['ptn'], 'dtpv_id')->radioList(ArrayHelper::map($model['dmdoituong'], 'id_dtpv', 'ten_dtpv'), [
                                            'itemOptions' => ['unchecked' => null],
                                            'item' => function ($index, $label, $name, $checked, $value) {
                                                ($checked == 1) ? $c = 'checked' : $c = '';
                                                return "<label class='col-md-12'><input type='checkbox' $c {$checked} name='{$name}' value='{$value}' tabindex='3'> " . ($index + 1) . ". {$label}</label>";                                    },
                                        ])->label('Đối tượng phục vụ của PTN') ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <?= $form->field($model['ptn'], 'dinh_huong')->textarea()->label('Hướng phát triển trong thời gian tới (khoảng 5 năm, nếu có)') ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <?= $form->field($model['ptn'], 'xac_nhan')->checkbox(['class' => 'icheck'], false)->label('Đưa các thông tin trên đây của PTN vào danh mục') ?>
                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions" style="text-align: center">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="javascript:;" class="btn default button-previous">
                                        <i class="fa fa-angle-left"></i> Quay lại </a>
                                    <a href="javascript:;" class="btn btn-outline green button-next"> Tiếp tục
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    <button type="button"  class="btn green button-submit" onclick="submit('<?=Yii::$app->urlManager->createUrl('/user/phongthinghiem/create')?>')"> Đăng ký
                                        <i class="fa fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php ActiveForm::end()?>
                <div style="clear: both"></div>

            </div>
        </div>
    </div>
</div>


<div style="clear: both"></div>

<script>
    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        $('.btnNext').click(function () {
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
        });
        $('.btnPrevious').click(function () {
            $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        });
    });


    function addRow(id_table) {

        var table = document.getElementById(id_table);
        var count = table.rows.length;
        var row = table.insertRow(count);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);
        var cell10 = row.insertCell(9);
        cell1.innerHTML = "<input type='checkbox' name='chk'>";
        cell2.innerHTML = (count);
        cell3.innerHTML = "<input type='text' style='text-align: right' class='form-control' name='thietbi[" + (count - 1) + "][ten_thietbi]'>";
        cell4.innerHTML = "<input type='text' style='text-align: right' class='form-control' name='thietbi[" + (count - 1) + "][so_hieu]'>";
        cell5.innerHTML = "<input type='number' style='text-align: right' class='form-control' name='thietbi[" + (count - 1) + "][nam_sx]'>";
        cell6.innerHTML = "<input type='text' style='text-align: right' class='form-control' name='thietbi[" + (count - 1) + "][hang_sx]'>";
        cell7.innerHTML = "<input type='text' style='text-align: right' class='form-control' name='thietbi[" + (count - 1) + "][nuoc_sx]'>";
        cell8.innerHTML = "<textarea class='form-control' name='thietbi[" + (count - 1) + "][dactinh_kythuat]'></textarea>";
        cell9.innerHTML = "<input type='number' style='text-align: right' class='form-control' value='0' name='thietbi[" + (count - 1) + "][so_luong]'>";
        cell10.innerHTML = "<input type='text' style='text-align: right' class='form-control' name='thietbi[" + (count - 1) + "][ghi_chu]'>";
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    }


    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    if (rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }


            }
        } catch (e) {
            alert(e);
        }
    }


</script>
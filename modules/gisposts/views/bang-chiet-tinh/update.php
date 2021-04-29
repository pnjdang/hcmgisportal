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
?>

<?php $form = ActiveForm::begin()?>

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
    <?php foreach ($model['quyetdinh'] as $i => $quyetdinh): ?>
        <div class="col-lg-12 form-group div-quyetdinh no-padding-side"
             id="div<?= $quyetdinh->id_quyetdinh ?>" style="display: none">
            <div class="col-lg-3">
                <?= $form->field($model['bangchiettinh'], 'gia_chuan')->dropDownList([
                    $quyetdinh->nha_cap1 => 'Nhà cấp 1: ' . number_format($quyetdinh->nha_cap1, 0, ',', '.') . ' đồng',
                    $quyetdinh->nha_cap2 => 'Nhà cấp 2: ' . number_format($quyetdinh->nha_cap2, 0, ',', '.') . ' đồng',
                    $quyetdinh->nha_cap3 => 'Nhà cấp 3: ' . number_format($quyetdinh->nha_cap3, 0, ',', '.') . ' đồng',
                    $quyetdinh->nha_cap4 => 'Nhà cấp 4: ' . number_format($quyetdinh->nha_cap4, 0, ',', '.') . ' đồng',
                ], [
                    'prompt' => 'Chọn cấp nhà', 'id' => 'gia_chuan' . ($i + 1)
                ])->label('Đơn giá') ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model['bangchiettinh'], 'heso_k2')->dropDownList([
                    $quyetdinh->kv_trungtamnoithanh => 'Trung tâm nội thành: ' . number_format($quyetdinh->kv_trungtamnoithanh, 2, ',', '.'),
                    $quyetdinh->kv_noithanh => 'Nội thành: ' . number_format($quyetdinh->kv_noithanh, 2, ',', '.'),
                    $quyetdinh->kv_ngoaithanh => 'Ngoại thành: ' . number_format($quyetdinh->kv_ngoaithanh, 2, ',', '.'),
                ], [
                    'prompt' => 'Chọn khu vực', 'id' => 'k2' . ($i + 1)
                ])->label('Hệ số K1') ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model['bangchiettinh'], 'heso_k3')->dropDownList([
                    $quyetdinh->tang_1 => 'Tầng 1: ' . number_format($quyetdinh->tang_1, 2, ',', '.'),
                    $quyetdinh->tang_2 => 'Tầng 2: ' . number_format($quyetdinh->tang_2, 2, ',', '.'),
                    $quyetdinh->tang_3 => 'Tầng 3: ' . number_format($quyetdinh->tang_3, 2, ',', '.'),
                    $quyetdinh->tang_4 => 'Tầng 4: ' . number_format($quyetdinh->tang_4, 2, ',', '.'),
                    $quyetdinh->tang_5 => 'Tầng 5: ' . number_format($quyetdinh->tang_5, 2, ',', '.'),
                    $quyetdinh->tang_6 => 'Tầng 6 trở lên: ' . number_format($quyetdinh->tang_6, 2, ',', '.'),
                ], [
                    'prompt' => 'Chọn tầng cao', 'id' => 'k3' . ($i + 1)
                ])->label('Hệ số K2') ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model['bangchiettinh'], 'heso_k4')->dropDownList([
                    $quyetdinh->dk_tot => 'Điều kiện tốt: ' . number_format($quyetdinh->dk_tot, 2, ',', '.'),
                    $quyetdinh->dk_trungbinh => 'Điều kiện trung bình: ' . number_format($quyetdinh->dk_trungbinh, 2, ',', '.'),
                    $quyetdinh->dk_kem => 'Điều kiện kém: ' . number_format($quyetdinh->dk_kem, 2, ',', '.'),
                ], [
                    'prompt' => 'Chọn điều kiện hạ tầng', 'id' => 'k4' . ($i + 1)
                ])->label('Hệ số K3') ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model['bangchiettinh'], 'thoigianbotri_id')->dropDownList(ArrayHelper::map($model['thoigianbotri'], 'id_thoigianbotri', 'mota_thoigian'), ['id' => 'thoigianbotri', 'prompt' => 'Chọn thời gian bố trí'])->label('Thời gian bố trí sử dụng') ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model['bangchiettinh'], 'heso_tlcb')->input('number', ['step' => '.01'])->label('Hệ số tăng lương cơ bản') ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model['bangchiettinh'],'miengiam_id')
                    ->dropDownList(ArrayHelper::map($model['miengiam'],'id_miengiam','text_short'),['prompt' => 'Chọn mức giảm','id' => 'muc_giam',])->label('Giảm giá')?>
            </div>
        </div>
    <?php endforeach ?>
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

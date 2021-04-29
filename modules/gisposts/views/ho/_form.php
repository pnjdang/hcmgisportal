<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/13/2021
 * Time: 3:11 PM
 */
use kartik\form\ActiveForm;
use yii\widgets\MaskedInput;

?>

<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-lg-6">
        <?= $form->field($model['ho'], 'so_luu_kho')->input('text')->label('Số lưu kho') ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model['ho'], 'cap_nha')->input('text')->label('Cấp nhà') ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?= $form->field($model['ho'], 'vi_tri')->input('text')->label('Vị trí') ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model['ho'], 'dien_tich_su_dung')->widget(MaskedInput::className(), [
            'clientOptions' => [
                'alias' => 'decimal',
                'groupSeparator' => ',',
                'autoGroup' => true
            ],
        ])->label('Diện tích sử dụng') ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?= $form->field($model['ho'], 'ghi_chu')->textarea()->label('Ghi chú') ?>
    </div>
</div>
<div class="row">

    <div class="col-lg-2">
        <?= $form->field($model['ho'], 'da_ban')->checkbox(['class' => 'form-control'], false)->label('Đã bán') ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model['ho'], 'ngay_ban')->widget(MaskedInput::class,[
            'clientOptions' => ['alias' =>  'dd/mm/yyyy']
        ])->label('Ngày bán') ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model['ho'], 'ghichu_ban')->textarea()->label('Ghi chú bán căn') ?>
    </div>
</div>
<div class="row">

    <div class="col-lg-2">
        <?= $form->field($model['ho'], 'chuyen_giao')->checkbox(['class' => 'form-control'], false)->label('Chuyển giao') ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model['ho'], 'ngay_chuyengiao')->widget(MaskedInput::class,[
            'clientOptions' => ['alias' =>  'dd/mm/yyyy']
        ])->label('Ngày chuyển giao') ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model['ho'], 'ghichu_chuyengiao')->textarea()->label('Ghi chú chuyển giao') ?>
    </div>

</div>
<?php ActiveForm::end() ?>

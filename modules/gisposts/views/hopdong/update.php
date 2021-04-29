<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 12/30/2016
 * Time: 4:34 PM
 */

use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

?>
<?php $form = ActiveForm::begin() ?>
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label uppercase">Thông tin người thuê</label>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model['hopdong'], 'so_hop_dong')->input('text')->label('Số hợp đồng') ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model['hopdong'], 'don_vi')->input('text')->label('Đơn vị') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model['hopdong'], 'nguoi_thue')->input('text')->label('Ông (bà)') ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model['hopdong'], 'cmnd')->input('text')->label('CMND/Số thẻ quân nhân') ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model['hopdong'], 'ngay_cap')->widget(MaskedInput::class, [
                'clientOptions' => ['alias' => 'dd/mm/yyyy']
            ])->label('Ngày cấp') ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model['hopdong'], 'noi_cap')->input('text')->label('Nơi cấp') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model['hopdong'], 'thuong_tru')->input('text')->label('Thường trú') ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model['hopdong'], 'dia_chi_lien_he')->input('text')->label('Địa chỉ liên hệ') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model['hopdong'], 'dienthoai')->input('text')->label('Điện thoại') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label uppercase">Tính giá thuê</label>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model['hopdong'], 'giathue')->widget(MaskedInput::class, [
                'value' => $model['hopdong']->gia_thue,
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'removeMaskOnSubmit' => true,
                    'autoGroup' => true
                ],
            ])->label('Giá thuê') ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model['hopdong'], 'giagiam')->widget(MaskedInput::class, [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'removeMaskOnSubmit' => true,
                    'autoGroup' => true
                ],
            ])->label('Giá giảm') ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model['hopdong'], 'giaphaitra')->widget(MaskedInput::class, [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'removeMaskOnSubmit' => true,
                    'autoGroup' => true
                ],
            ])->label('Giá phải trả') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label uppercase">Thông tin hợp đồng</label>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model['hopdong'], 'thoi_han_thue')
                ->dropDownList(ArrayHelper::map($model['thoihan'], 'so_thang', 'ghichu_thoihan'))
                ->label('Thời hạn thuê <a class="btn btn-xs btn-success custom-element-load-ajax-div" data-toggle="modal" data-target="#ajaxModal" data-target-div="#ajaxModalContent" data-url="' . Yii::$app->urlManager->createUrl('danhmuc/thoihan/createthoihan') . '"><i class="fa fa-plus"></i></a>') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model['hopdong'], 'ngay_ki')->widget(MaskedInput::class, [
                'clientOptions' => ['alias' => 'dd/mm/yyyy']
            ])->label('Ngày ký hợp đồng') ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model['hopdong'], 'ngay_bat_dau')->widget(MaskedInput::class, [
                'clientOptions' => ['alias' => 'dd/mm/yyyy']
            ])->label('Ngày bắt đầu hiệu lực') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model['hopdong'], 'ghi_chu')->textarea()->label('Ghi chú') ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
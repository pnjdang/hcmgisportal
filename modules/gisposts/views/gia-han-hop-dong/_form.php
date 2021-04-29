<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/19/2021
 * Time: 3:48 PM
 */

use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

?>

<?php $form = ActiveForm::begin() ?>

<div class="row">
    <div class="col-lg-12">
        <?= $form->field($model['giahan'], 'nguoi_gia_han')->input('text')->label('Người gia hạn') ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?= $form->field($model['giahan'], 'ngay_gia_han')->widget(MaskedInput::class,[
            'clientOptions' => ['alias' =>  'dd/mm/yyyy']
        ])->label('Ngày gia hạn') ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?= $form->field($model['giahan'], 'thoi_han_thue')
            ->dropDownList(ArrayHelper::map($model['thoihan'], 'so_thang', 'ghichu_thoihan'))
            ->label('Thời hạn thuê <a class="btn btn-xs btn-success custom-element-load-ajax-div" data-toggle="modal" data-target="#ajaxModal" data-target-div="#ajaxModalContent" data-url="' . Yii::$app->urlManager->createUrl('danhmuc/thoihan/createthoihan') . '"><i class="fa fa-plus"></i></a>') ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model['giahan'], 'giathue')->widget(MaskedInput::class, [
            'clientOptions' => [
                'alias' => 'decimal',
                'groupSeparator' => ',',
                'removeMaskOnSubmit' => true,
                'autoGroup' => true
            ],
        ])->label('Giá thuê') ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model['giahan'], 'giagiam')->widget(MaskedInput::class, [
            'clientOptions' => [
                'alias' => 'decimal',
                'groupSeparator' => ',',
                'removeMaskOnSubmit' => true,
                'autoGroup' => true
            ],
        ])->label('Giá giảm') ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model['giahan'], 'giaphaitra')->widget(MaskedInput::class, [
            'clientOptions' => [
                'alias' => 'decimal',
                'groupSeparator' => ',',
                'removeMaskOnSubmit' => true,
                'autoGroup' => true
            ],
        ])->label('Giá phải trả') ?>
    </div>
</div>

<?php if(!Yii::$app->request->isAjax):?>
    <button type="submit" class="btn btn-success">Lưu</button>
<?php endif;?>
<?php ActiveForm::end() ?>

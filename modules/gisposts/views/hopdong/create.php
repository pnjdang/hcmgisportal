<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/8/2021
 * Time: 4:14 PM
 */

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use app\modules\DCrud\DCrudAsset;
use yii\widgets\Pjax;
use yii\widgets\MaskedInput;

DCrudAsset::register($this);

$requestedAction = Yii::$app->requestedAction;
$this->title = $const['actions'][$requestedAction->id]['label'];
$this->params['breadcrumbs'][] = ['label' => $const['actions']['index']['label'] . ' ' . $const['title'], 'url' => [$const['actions']['index']['url']]];
$this->params['breadcrumbs'][] = $model['can']->fulldiachi;
?>

<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet box blue-steel">
            <div class="portlet-title">
                <div class="caption">
                    <span>Thêm mới hợp đồng hộ thuê nhà</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="uppercase" style="text-align: center">
                            <b>Hợp đồng thuê nhà ở thuộc sở hữu nhà nước</b><br>
                            <?= $model['can']->so_nha . ' ' . $model['can']->ten_duong . ' ' . $model['can']->phuong->tenphuong ?>
                        </h3>
                    </div>
                </div>
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
                        <?= $form->field($model['hopdong'], 'ngay_cap')->widget(MaskedInput::class,[
                            'clientOptions' => ['alias' =>  'dd/mm/yyyy']
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
                        <?= $form->field($model['hopdong'],'giathue')->widget(MaskedInput::class,[
                            'clientOptions' => [
                                'alias' =>  'decimal',
                                'groupSeparator' => ',',
                                'removeMaskOnSubmit' => true,
                                'autoGroup' => true
                            ],
                        ])->label('Giá thuê')?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model['hopdong'],'giagiam')->widget(MaskedInput::class,[
                            'clientOptions' => [
                                'alias' =>  'decimal',
                                'groupSeparator' => ',',
                                'removeMaskOnSubmit' => true,
                                'autoGroup' => true
                            ],
                        ])->label('Giá giảm')?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model['hopdong'],'giaphaitra')->widget(MaskedInput::class,[
                            'clientOptions' => [
                                'alias' =>  'decimal',
                                'groupSeparator' => ',',
                                'removeMaskOnSubmit' => true,
                                'autoGroup' => true
                            ],
                        ])->label('Giá phải trả')?>
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
                        <?= $form->field($model['hopdong'], 'ngay_ki')->widget(MaskedInput::class,[
                            'clientOptions' => ['alias' =>  'dd/mm/yyyy']
                        ])->label('Ngày ký hợp đồng') ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model['hopdong'], 'ngay_bat_dau')->widget(MaskedInput::class,[
                            'clientOptions' => ['alias' =>  'dd/mm/yyyy']
                        ])->label('Ngày bắt đầu hiệu lực') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($model['hopdong'], 'ghi_chu')->textarea()->label('Ghi chú') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-sm btn-success pull-left"
                                type="submit">Thêm mới
                        </button>
                        <a href="<?= Yii::$app->urlManager->createUrl('hopdong/index') ?>"
                           class="btn btn-sm btn-default pull-right">
                            Quay lại
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end() ?>


<?php Modal::begin([
    "id" => "ajaxCrudModal",
    'size' => Modal::SIZE_LARGE,
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>

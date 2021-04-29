<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\danhmuc\capnha\Capnha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="capnha-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model['can'],'so_nha')->input('text')->label('Số nhà')?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model['can'],'ten_duong')->input('text')->label('Tên đường')?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model['can'], 'ma_phuong')->dropDownList(ArrayHelper::map($model['ranh_phuong'], 'maphuong', 'tenphuong'),['prompt' => 'Chọn phường ...'])->label('Phường') ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model['can'], 'id_loainha')->dropDownList(ArrayHelper::map($model['dm_loainha'], 'id_loainha', 'ten_loainha'),['prompt' => 'Chọn loại nhà ...'])->label('Loại nhà') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model['can'],'so_to_bd')->input('text')->label('Số tờ bản đồ')?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model['can'],'so_thua')->input('text')->label('Số thửa đất')?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model['can'],'dien_tich_khuon_vien')->input('text')->label('Diện tích khuôn viên')?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model['can'],'dieukien_bannha99')->dropDownList([-1 => 'Không bán', 0 => 'Chưa đủ điều kiện', 1 => 'Đủ điều kiện'],['prompt' => 'Chọn tình trạng'])->label('Điều kiện bán nhà (NĐ 99)')?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model['can'],'ghichu_can')->textarea()->label('Ghi chú căn')?>
        </div>
    </div>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model['can']->isNewRecord ? 'Create' : 'Update', ['class' => $model['can']->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

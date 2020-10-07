<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Donvi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="donvi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model['donvi'], 'ten_donvi')->input('text')->label('Tên đơn vị') ?>
    <?= $form->field($model['donvi'], 'nguoidungdau')->input('text')->label('Người đứng đầu') ?>
    <?= $form->field($model['donvi'], 'dia_chi')->input('text')->label('Địa chỉ') ?>
    <?= $form->field($model['donvi'], 'nhomdonvi_id')->dropDownList(ArrayHelper::map($model['nhomdonvi'],'id_nhomdonvi','ten_nhomdonvi'),['prompt' => 'Chọn nhóm đơn vị'])->label('Nhóm đơn vị') ?>
    <?= $form->field($model['donvi'], 'dien_thoai')->input('text')->label('Điện thoại') ?>
    <?= $form->field($model['donvi'], 'fax')->input('text')->label('Fax') ?>
    <?= $form->field($model['donvi'], 'website')->input('text')->label('Website') ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model['donvi']->isNewRecord ? 'Create' : 'Update', ['class' => $model['donvi']->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

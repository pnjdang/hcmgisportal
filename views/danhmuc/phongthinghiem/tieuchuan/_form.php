<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TieuChuan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tieu-chuan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ten_tc')->textInput(['maxlength' => true])->label('Tên tiêu chuẩn') ?>

    <?= $form->field($model, 'ghi_chu')->textInput(['maxlength' => true])->label('Ghi chú') ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

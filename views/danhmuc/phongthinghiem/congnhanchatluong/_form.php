<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CongnhanChatluong */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="congnhan-chatluong-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tieu_chuan')->textInput(['maxlength' => true])->label('Công nhận tiêu chuẩn') ?>

    <?= $form->field($model, 'ghi_chu')->textInput(['maxlength' => true])->label('Ghi chú') ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

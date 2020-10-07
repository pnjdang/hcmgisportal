<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TochucHoptac */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tochuc-hoptac-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ten_tc')->textInput(['maxlength' => true])->label('Tên tổ chức/hiệp hội') ?>

    <?= $form->field($model, 'ghi_chu')->textInput(['maxlength' => true])->label('Ghi chú') ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tạo mói' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LinhvucThunghiem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="linhvuc-thunghiem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ten_lv')->textInput(['maxlength' => true])->label('Tên lĩnh vực thử nghiệm') ?>

    <?= $form->field($model, 'ghi_chu')->textInput(['maxlength' => true])->label('Ghi chú') ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

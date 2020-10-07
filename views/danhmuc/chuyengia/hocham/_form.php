<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HocHam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hoc-ham-form">

    <?php $form = ActiveForm::begin(); ?>

 

    <?= $form->field($model, 'ten_hh')->textInput(['maxlength' => true])->label('Tên học hàm') ?>

    <?= $form->field($model, 'ghi_chu')->textInput(['maxlength' => true])->label('Ghi chú') ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

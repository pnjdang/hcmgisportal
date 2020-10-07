<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\danhmuc\phongthinghiem\chungloai\PhanLoai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phan-loai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_cl')->dropDownList(ArrayHelper::map($chungloai, 'id_cl', 'ten_cl'), ['prompt' => 'Chọn chủng loại'])->label('Tên chủng loại', ['class' => 'font-weight-bold']) ?>

    <?= $form->field($model, 'ten_pl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ghi_chu')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

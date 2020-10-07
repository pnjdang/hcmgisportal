<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\LinhvucnghiencuuCap2 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="linhvucnghiencuu-cap2-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model['linhvuccap2'], 'ten_cap2')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model['linhvuccap2'], 'id_cap1')->dropDownList(ArrayHelper::map($model['linhvuccap1'],'id_cap1','ten_cap1'))->label('Lĩnh vực nghiên cứu cấp 1')?>
    <?= $form->field($model['linhvuccap2'], 'ma_cap2')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model['linhvuccap2'], 'ghichu_cap2')->textInput(['maxlength' => true]) ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model['linhvuccap2']->isNewRecord ? 'Create' : 'Update', ['class' => $model['linhvuccap2']->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

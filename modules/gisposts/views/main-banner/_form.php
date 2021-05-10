<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\gisposts\models\media\MainBanner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file_name')->textInput() ?>

    <?= $form->field($model, 'file_caption')->textInput() ?>

    <?= $form->field($model,'banner_status')->dropDownList([true => 'Showed',false => 'Hidden'],['prompt' => 'Select status'])?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

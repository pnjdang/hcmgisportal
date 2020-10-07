<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\LinhvucnghiencuuCap3 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="linhvucnghiencuu-cap3-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model['linhvuccap3'], 'ten_cap3')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model['linhvuccap3'], 'id_cap2')->widget(Select2::classname(), [
        'data' => $model['linhvuccap2'],
        'options' => ['placeholder' => '',],
        'pluginOptions' => [
            'allowClear' => true,
            'language' => [
                'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
            'templateSelection' => new \yii\web\JsExpression('function(chunhiem) { return chunhiem.text; }'),
            'templateResult' => new \yii\web\JsExpression('function(chunhiem) { return chunhiem.text; }'),
        ],
    ])->label('Lĩnh vực nghiên cứu cấp 2'); ?>
    <?= $form->field($model['linhvuccap3'], 'ma_cap3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model['linhvuccap3'], 'ghichu_cap3')->textInput(['maxlength' => true]) ?>



  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model['linhvuccap3']->isNewRecord ? 'Create' : 'Update', ['class' => $model['linhvuccap3']->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model app\models\GisPosts */
/* @var $form yii\widgets\ActiveForm */
?>

 
<div class="gis-posts-form">
    <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-9">
    <?php $form = ActiveForm::begin(); ?>
    <?php $items = ArrayHelper::map(app\models\GisPosts::find()->orderBy('post_type')->asArray()->groupBy('post_type')->all(), 'post_type', 'post_type');?>        
    <?= $form->field($model, 'post_title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'post_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'post_content')->widget(TinyMce::className(), [
    'options' => ['rows' => 35],
    'language' => 'vi',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>

    <?= $form->field($model, 'post_content_filtered')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'post_img')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-3 col-sm-3 col-xs-3">
            
    <?= $form->field($model, 'post_date')->textInput() ?>
        
    <?= $form->field($model, 'post_type')->dropDownList($items,['size' => 8]) ?>
    
    <div class="input-group">
        <input type="text" id="gisposts-post_type-add" class="form-control" name="GisPosts[post_type-add]" maxlength="20" placeholder="Thêm mới danh mục?">
<div class="input-group-btn">
    <button type="button" class="btn btn-default" onclick="myFunctionAdd()"><i class="fa fa-plus"></i></button>
</div>

<div class="help-block"></div>
</div>
            
            
    <?= $form->field($model, 'post_status')->dropdownList([1 => 'Publish',0 => 'Close']) ?>

    <?= $form->field($model, 'ping_status')->dropdownList([1 => 'Có',0 => 'Không']) ?>
            
        </div>
    </div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script>
function myFunctionAdd() {
  var x = document.getElementById("gisposts-post_type");
  var option = document.createElement("option");
  option.text = document.getElementById("gisposts-post_type-add").value;
  option.value = document.getElementById("gisposts-post_type-add").value;
  x.add(option);
}
</script>
<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 5/5/2021
 * Time: 12:27 AM
 */

use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
    ]
])?>

<?= $form->field($model,'file_name')->input('text')?>

<?= $form->field($model,'file_caption')->input('text')?>

<?= $form->field($model,'file_status')->dropDownList([true => 'Showed',false => 'Hidden'],['prompt' => 'Select status'])?>

<?= $form->field($model, 'file')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
])?>

<?php if(!Yii::$app->request->isAjax):?>
    <?= \yii\helpers\Html::submitButton('Upload',['class' => 'btn btn-primary'])?>
<?php endif;?>

<?php ActiveForm::end()?>


<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 10/4/2017
 * Time: 4:02 PM
 */
use kartik\form\ActiveForm;

?>

<div class="col-lg-12">
    <div class="portlet box blue-steel">
        <div class="portlet-title">
            <div class="caption">
                <span class="">Read excel</span>
            </div>
        </div>
        <div class="portlet-body">
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
            ])?>
            <?= $form->field($model,'file')->widget(\kartik\file\FileInput::className(),[

            ])?>
            <button type="submit" class="btn btn-primary">Import</button>
            <?php ActiveForm::end()?>
        </div>
    </div>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ThietBi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thiet-bi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ten_tb')->textInput() ?>

    <?= $form->field($model, 'hang_sx')->textInput() ?>

    <?= $form->field($model, 'dac_tinh')->textInput() ?>

    <?= $form->field($model, 'tinh_trang')->textInput() ?>

    <?= $form->field($model, 'ghi_chu')->textInput() ?>



    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

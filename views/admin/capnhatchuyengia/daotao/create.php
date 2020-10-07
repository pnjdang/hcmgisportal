<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ['pdk'] app\models\VChuyengia */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Thêm mới quá trình đào tạo</h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="col-sm-12">
        <h3>Chuyên gia: <?= $model['chuyengia']->ho_ten?></h3>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['daotao'], 'nam_totnghiep')->input('number')->label('Năm tốt nghiệp') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model['daotao'], 'trinhdo_daotao')->input('text')->label('Trình độ đào tạo') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model['daotao'], 'chuyennganh_daotao')->input('text')->label('Chuyên ngành đào tạo') ?>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model['daotao'], 'noi_daotao')->input('text')->label('Nơi đào tạo') ?>
    </div>

    <div style="clear:both;"></div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success pull-left">Thêm mới</button>
    <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
</div>
<?php ActiveForm::end() ?>


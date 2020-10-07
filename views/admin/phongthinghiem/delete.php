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
    <h4 class="modal-title">Xóa thông tin phòng thí nghiệm</h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="col-sm-12">
        <h4>Bạn chắc chắn muốn xóa thông tin Phòng thí nghiệm: <?= $model['phongthinghiem']->ten_tv?>?</h4>
    </div>


    <div style="clear:both;"></div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-danger pull-left">Xóa</button>
    <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
</div>
<?php ActiveForm::end() ?>


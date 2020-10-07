<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/3/2017
 * Time: 2:00 PM
 */
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin([
]) ?>


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Khôi phục tài khoản</h4>
</div>
<div class="modal-body">
    <h4>Bạn chắc chắn khôi phục lại tài khoản?</h4>
</div>
<div class="modal-footer">
    <?= Html::input('submit', null, 'Khôi phục', ['class' => 'btn btn-info pull-left']) ?>
    <?= Html::button('Đóng', ['class' => 'btn btn-default pull-right', 'data-dismiss' => 'modal']) ?>
</div>

<?php ActiveForm::end() ?>

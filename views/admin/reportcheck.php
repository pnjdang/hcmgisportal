<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/27/2017
 * Time: 9:57 PM
 */
use kartik\form\ActiveForm;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="modal-title"><h4>Kiểm tra thông tin</h4></div>
</div>
<?php $form = ActiveForm::begin()?>
<div class="modal-body">
    <h4>Đã kiểm tra thông tin báo cáo!</h4>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
    <button type="submit" class="btn btn-success pull-left">Đã kiểm tra</button>
</div>
<?php ActiveForm::end()?>
<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/15/2017
 * Time: 8:19 AM
 */
use kartik\form\ActiveForm;

?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Phản hồi liên hệ</h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="col-sm-12">
        <table class="table table-bordered table-responsive">
            <tr>
                <th>Họ tên</th>
                <td><?= $model['lienhe']->ho_ten ?></td>
                <th>Email</th>
                <td><?= $model['lienhe']->email ?></td>
            </tr>
            <tr>
                <th>Điện thoại</th>
                <td><?= $model['lienhe']->dien_thoai ?></td>
                <th>Thời gian gửi</th>
                <td><?= ($model['lienhe']->created_at != null) ? date('d-m-Y H:i:s', strtotime($model['lienhe']->created_at)) : '' ?></td>
            </tr>
            <tr>
                <th colspan="4">Nội dung liên hệ</th>
            </tr>
            <tr>
                <td colspan="4"><?= $model['lienhe']->noi_dung ?></td>
            </tr>
        </table>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model['lienhe'], 'noi_dung_reply')->textarea()->label('Nội dung phản hồi') ?>
    </div>

    <div style="clear:both;"></div>
</div>
<div class="modal-footer">
    <button class="btn btn-success pull-left" type="submit">Phản hồi</button>
    <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
</div>
<?php ActiveForm::end() ?>


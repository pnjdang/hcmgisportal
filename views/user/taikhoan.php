<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/1/2017
 * Time: 2:25 PM
 */
use kartik\form\ActiveForm;

?>

<?php $doimatkhau = Yii::$app->session->getFlash('doimatkhau') ?>
<?php if (isset($doimatkhau)): ?>
    <div class="portlet box green" id="notice">
        <div class="portlet-title">
            <div class="caption"><span class="fa fa-check-circle-o"></span> Đổi mật khẩu thành công!</div>
        </div>
    </div>
<?php endif; ?>
<?php $capnhat = Yii::$app->session->getFlash('capnhatthongtin') ?>
<?php if (isset($capnhat)): ?>
    <div class="portlet box green" id="notice">
        <div class="portlet-title">
            <div class="caption"><span class="fa fa-check-circle-o"></span> Cập nhật thông tin thành công!</div>
        </div>
    </div>
<?php endif; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#notice').delay(3000).fadeOut();
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet box">
            <div class="portlet-title bg-primary">
                <div class="caption">
                    <span>Thông tin</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'capnhatthongtin'
                ]) ?>
                <div class="col-lg-12 form-group">
                    <?= $form->field($model['taikhoan'], 'ho_ten')->input('text')->label('Họ tên') ?>
                </div>
                <div class="col-lg-12 form-group">
                    <?= $form->field($model['taikhoan'], 'dia_chi')->input('text')->label('Địa chỉ') ?>
                </div>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['taikhoan'], 'email')->input('email')->label('Email') ?>
                </div>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['taikhoan'], 'dien_thoai')->input('text')->label('Điện thoại') ?>
                </div>

                <div class="col-lg-12 form-group" style="text-align: center">
                    <button class="btn btn-success" type="submit">Cập nhật</button>
                </div>
                <div style="clear: both"></div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="portlet box">
            <div class="portlet-title bg-primary">
                <div class="caption">
                    <span>Mật khẩu</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'doi-mat-khau',
                    'action' => Yii::$app->homeUrl.'user/doimatkhau',
                ]) ?>
                <div class="col-lg-12 form-group">
                    <?= $form->field($model['doimatkhau'], 'password')->input('password')->label('Mật khẩu cũ') ?>
                </div>
                <div class="col-lg-12 form-group">
                    <?= $form->field($model['doimatkhau'], 'newpassword')->input('password')->label('Mật khẩu mới') ?>
                </div>
                <div class="col-lg-12 form-group">
                    <?= $form->field($model['doimatkhau'], 'confirm')->input('password')->label('Nhập lại mật khẩu mới') ?>
                </div>
                <div class="col-lg-12 form-group" style="text-align: center">
                    <button class="btn btn-success" type="submit">Cập nhật</button>
                </div>
                <div style="clear: both"></div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>

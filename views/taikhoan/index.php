<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 6/7/2017
 * Time: 5:09 PM
 */
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\captcha\Captcha;

?>


<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="<?= Yii::$app->homeUrl ?>">Trang chủ</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Thông tin cá nhân</span>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<?php $update = Yii::$app->session->getFlash('update') ?>
<?php if (isset($update)): ?>
    <div class="portlet box green" id="notice">
        <div class="portlet-title">
            <div class="caption"><span class="fa fa-check-circle-o"></span> Cập nhật thành công!</div>
        </div>
    </div>
<?php endif; ?>
<?php $error = Yii::$app->session->getFlash('pass_error') ?>
<?php if (isset($error)): ?>
    <div class="portlet box red" id="notice">
        <div class="portlet-title">
            <div class="caption"><span class="fa fa-times-circle-o"></span> Đổi mật khẩu không thành công!</div>
        </div>
    </div>
<?php endif; ?>
<?php $success = Yii::$app->session->getFlash('pass_success') ?>
<?php if (isset($success)): ?>
    <div class="portlet box green" id="notice">
        <div class="portlet-title">
            <div class="caption"><span class="fa fa-check-circle-o"></span> Đổi mật khẩu thành công!</div>
        </div>
    </div>
<?php endif; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#notice').delay(3000).fadeOut();
    });
</script>
<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet bordered">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?= Yii::$app->user->identity->duong_dan?>" class="img-responsive" alt=""></div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?= $model['taikhoan']->ho_ten ?> </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->

            </div>
            <!-- END PORTLET MAIN -->

        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Tài khoản</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#thongtincanhan" data-toggle="tab">Thông tin cá nhân</a>
                                </li>
                                <li>
                                    <a href="#anhdaidien" data-toggle="tab">Ảnh đại diện</a>
                                </li>
                                <li>
                                    <a href="#doimatkhau" data-toggle="tab">Đổi mật khẩu</a>
                                </li>

                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="thongtincanhan">
                                    <?php $form = ActiveForm::begin([
                                        'action' => Yii::$app->homeUrl . 'taikhoan/update'
                                    ]) ?>
                                    <div class="form-group">
                                        <?= $form->field($model['taikhoan'], 'ho_ten')->input('text')->label('Họ tên') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model['taikhoan'], 'dia_chi')->input('text')->label('Địa chỉ') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model['taikhoan'], 'dien_thoai')->input('text')->label('Điện thoại') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model['taikhoan'], 'email')->input('email')->label('Email') ?>
                                    </div>
                                    <div class="margin-top-10">
                                        <button type="submit" class="btn btn-warning"> Cập nhật</button>
                                    </div>
                                    <?php ActiveForm::end() ?>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="anhdaidien">
                                    <p> Thay đổi ảnh đại diện. </p>

                                    <?php $form = ActiveForm::begin([
                                        'options' => ['enctype' => 'multipart/form-data'],
                                        'action' => Yii::$app->homeUrl . 'taikhoan/upload'
                                    ]) ?>
                                        <div class="form-group">
                                            <?= $form->field($model['anhdaidien'],'anhdaidien')->widget(FileInput::className(),[
                                                'options' => ['accept' => 'image/*'],
                                                'pluginOptions' => [
                                                    'showUpload' => false,
                                                    'browseLabel' => 'Chọn ảnh',
                                                    'removeLabel' => 'Xóa ảnh',
                                                    'uploadLabel' => 'Lưu ảnh',
                                                    'mainClass' => 'input-group-lg'
                                                ]
                                            ])->label('Ảnh đại diện')?>
                                        </div>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn btn-warning">Lưu ảnh</button>
                                        </div>
                                    <?php ActiveForm::end() ?>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="doimatkhau">
                                    <?php $form = ActiveForm::begin([
                                        'action' => Yii::$app->homeUrl . 'taikhoan/changepass'
                                    ]) ?>
                                    <div class="form-group">
                                        <?= $form->field($model['doimatkhau'], 'password')->input('password')->label('Mật khẩu cũ') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model['doimatkhau'], 'newpassword')->input('password')->label('Mật khẩu mới') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model['doimatkhau'], 'confirm')->input('password')->label('Xác nhận mật khẩu mới') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model['doimatkhau'], 'captcha')->widget(Captcha::className()) ?>
                                    </div>
                                    <div class="form-group">
                                        <?= \yii\helpers\Html::submitButton('Đổi mật khẩu', ['class' => 'btn btn-warning']) ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
<script>
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    } //add a suffix

    // Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    })
</script>
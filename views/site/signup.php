<?php

use kartik\form\ActiveForm;
?>


<div class="page-content-inner" style="padding-top: 20px">
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-blue-sharp bold uppercase"><i class="fa fa-sign-in font-blue-sharp"></i> Đăng ký</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-lg-6 col-lg-offset-3">
                        <?php $form = ActiveForm::begin() ?>

                        <div class="form-group">
                            <?= $form->field($model, 'ten_dang_nhap')->input('text')->label('Tên đăng nhập',['class' => 'font-blue-steel uppercase control-label']) ?>
                            <?php $error_username = Yii::$app->session->getFlash('tendangnhap'); ?>
                            <?php if (isset($error_username)): ?>
                                <div class="alert alert-danger" style="padding-top: 0;padding-bottom: 0">
                                    <h6 class="font-red-flamingo">
                                        <span class="fa fa-exclamation-triangle"></span>
                                        <i>Tên đăng nhập đã tồn tại!</i>
                                    </h6>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'password')->input('password')->label('Mật khẩu',['class' => 'font-blue-steel uppercase control-label']) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'retypepassword')->input('password')->label('Nhập lại mật khẩu',['class' => 'font-blue-steel uppercase control-label']) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'hoten')->input('text')->label('Họ tên',['class' => 'font-blue-steel uppercase control-label']) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'email')->input('email')->label('Email',['class' => 'font-blue-steel uppercase control-label']) ?>
                            <?php $error_email = Yii::$app->session->getFlash('email'); ?>
                            <?php if (isset($error_email)): ?>
                                <div class="alert alert-danger" style="padding-top: 0;padding-bottom: 0">
                                    <h6 class="font-red-flamingo">
                                        <span class="fa fa-exclamation-triangle"></span>
                                        <i>Email đã được sử dụng!</i>
                                    </h6>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'dienthoai')->input('text')->label('Điện thoại',['class' => 'font-blue-steel uppercase control-label']) ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" style="width: 100%;color: white" class="btn btn-md bg-blue-sharp uppercase">Đăng ký</button>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
</div>


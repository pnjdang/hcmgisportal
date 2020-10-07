<?php

use kartik\form\ActiveForm;
?>


<div class="page-content-inner" style="padding-top: 20px">
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-blue-sharp bold uppercase"><i class="fa fa-sign-in font-blue-sharp"></i> Quên mật khẩu</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-lg-6 col-lg-offset-3">
                        <?php $form = ActiveForm::begin() ?>
                        <div class="form-group">
                            <?= $form->field($model, 'ten_dang_nhap')->input('text')->label('Tên đăng nhập',['class' => 'font-blue-steel uppercase control-label']) ?>
                        </div>

                        <div class="form-group">
                            <?= $form->field($model, 'email')->input('email')->label('Email',['class' => 'font-blue-steel uppercase control-label']) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::className())->label('Captcha',['class' => 'font-blue-steel uppercase control-label']) ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" style="width: 100%;color: white" class="btn btn-md bg-blue-sharp uppercase">Gửi yêu cầu cấp lại mật khẩu</button>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
</div>


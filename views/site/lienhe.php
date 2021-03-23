<?php

/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 3:07 PM
 */
//use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>
<!-- Lien he -->
<section class="contact_section">
    <div class="container-fluid">
        <div class="row" style="position: relative;">
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding:0;position: absolute;top: 28px;z-index: 1;width: 30%;right: 2%;">
             <?php $success = Yii::$app->session->getFlash('success') ?>
                <?php if (isset($success)): ?>
                <div class="alert alert-success alert-dismissible" role="alert" id="notice">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Chúc mừng!</strong> Gửi liên hệ thành công!
</div>
                <?php endif; ?>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#notice').delay(5000).fadeOut();
                    });
                </script>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8" style="padding:0;">
                <div class="full">
                    <iframe style="position: relative; overflow: hidden;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.403178811543!2d106.68529481479355!3d10.780400692318867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f2fdd6d057b%3A0xe678cde78e0fc0ad!2zMjQ0IMSQaeG7h24gQmnDqm4gUGjhu6csIFBoxrDhu51uZyA3LCBRdeG6rW4gMywgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1602149707257!5m2!1svi!2s" width="100%" height="748" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4" style="padding:0;">
                <div class="full">
                    <div class="contact_form white_heading_border">
                        <div class="contact_form_inner">
                            <div class="full_heading white_fonts heading_main heading_style_1">
                                <h2>Trung tâm Ứng dụng Hệ thống Thông tin Địa lý Thành phố Hồ Chí Minh</h2>
                            </div>
                            <p><b>Địa chỉ:</b> 244 Điện Biên Phủ, Phường Võ Thị Sáu, Quận 3, Thành phố Hồ Chí Minh<br>
                                <b>Điện thoại:</b> (028) 3932 0963 – Fax: (028) 3932 0963<br>
                                <b>Email:</b> contact@hcmgis.vn – <b>Website:</b> https://hcmgis.vn<br>
                                <b>Giờ làm việc:</b> Thứ 2 đến thứ 6 (7h30 - 17h00)
                            </p>

                            <div class="form_contact lien-he-form">
                                <!-- form -->
                                <?php $form = ActiveForm::begin(); ?>
                                    <fieldset>
                                        <div class="field">
                                            <!--<input type="text" name="name" placeholder="Tên của bạn" required="">-->
                                            <?= $form->field($model, 'ho_ten')->textInput(['maxlength' => true,'placeholder' => 'Tên của bạn'])->label(false) ?>
                                        </div>
                                        <div class="field">
                                            <!--<input type="text" name="name" placeholder="Số điện thoại" required="">-->
                                            <?= $form->field($model, 'dien_thoai')->textInput(['maxlength' => true,'placeholder' => 'Điện thoại'])->label(false) ?>
                                        </div>
                                        <div class="field">
                                            <!--<input type="email" name="email" placeholder="Email" required="">-->
                                            <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder' => 'Email'])->label(false) ?>
                                        </div>
                                        <div class="field">
                                            <!--<textarea name="messager" placeholder="Nội dung" required=""></textarea>-->
                                            <?= $form->field($model, 'noi_dung')->textarea(['rows' => 3,'placeholder' => 'Nội dung'])->label(false) ?>
                                        </div>
                                        <div class="field">
                                            <?php if (!Yii::$app->request->isAjax){ ?>
                                            <div class="form-group">
                                                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Gửi') : Yii::t('app', 'Cập nhật'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                            </div>
                                            <?php } ?>
                                            <!--<button class="field_bt">GỬI</button>-->
                                        </div>
                                    </fieldset>
                                <?php ActiveForm::end(); ?>
                                <!-- end form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end Lien he -->


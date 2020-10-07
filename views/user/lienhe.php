<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 3:07 PM
 */
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;

?>
<style>

    .c-content-contact-1 > .row .c-body {
        position: relative;
        z-index: 100;
        background: #fff;
        margin: 40px 40px 40px 0;
        padding: 60px 40px;
    }

    .c-content-contact-1-gmap {
        display: block;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        position: absolute;
        width: 100%;
    }

    .c-content-contact-1 > .row .c-body {
        position: relative;
        z-index: 100;
        background: #fff;
        margin: 40px 40px 40px 0;
        padding: 60px 40px;
    }

    .c-content-contact-1 > .row .c-body > .c-section > .c-content-label {
        display: inline;
        padding: 3px 7px;
        color: #fff;
    }

    .c-content-contact-1 {
        width: 100%;
        position: relative;
        margin-bottom: 70px;
    }

    .c-content-contact-1 > .row .c-body > .c-section {
        margin-bottom: 15px;
        text-align: right;
    }

    .gm-style {
        font: 400 11px Roboto, Arial, sans-serif;
        text-decoration: none;
    }

    .c-content-feedback-1 > .row > div > .c-container {
        background-size: auto;
        padding: 30px;
        margin: 0 0 30px;
    }
</style>

<!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="c-content-feedback-1 c-option-1">
        <div class="row portlet light">
            <div class="col-md-6" style="padding-top: 65px">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d489.92569681868537!2d106.68721337597012!3d10.780216756755513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x12f19494bc96ca5!2zU-G7nyBLaG9hIEjhu41jICYgQ8O0bmcgTmdo4buHIFRwLiBIY20!5e0!3m2!1svi!2s!4v1501578531776"
                        width="550" height="390" frameborder="0" style="border:3px solid #dfdfdf"
                        allowfullscreen></iframe>
            </div>
            <div class="col-md-6">
                <div class="c-contact">
                    <div class="c-content-title-1">
                        <h3 class="uppercase">Liên hệ</h3>
                        <div class="c-line-left bg-dark">uuuu</div>
                    </div>
                    <?php $form = ActiveForm::begin() ?>
                    <div class="form-group">
                        <?= $form->field($lien_he, 'ho_ten')->input('text', ['class' => 'form-control input-md', 'placeholder' => "Họ tên", 'required' => 'true'])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <!--                            <input type="text" placeholder="Email" class="form-control input-md"> </div>-->
                        <?= $form->field($lien_he, 'email')->input('email', ['class' => 'form-control input-md', 'placeholder' => "Email"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($lien_he, 'dien_thoai')->input('text', ['class' => 'form-control input-md', 'placeholder' => "Điện thoại"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($lien_he, 'noi_dung')->textarea(['class' => 'form-control input-md', 'rows' => 8, 'placeholder' => "Nội dung"])->label(false) ?>
                    </div>
                    <button type="submit" class="btn grey">Gửi tin nhắn</button>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

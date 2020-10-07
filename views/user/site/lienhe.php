<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 3:07 PM
 */
//use kartik\form\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

?>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<div class="page-content-inner" style="padding-top: 20px">

    <div class="row">
        <div class="col-lg-12">
            <?php $success = Yii::$app->session->getFlash('success') ?>
            <?php if (isset($success)): ?>
                <div class="portlet box green" id="notice">
                    <div class="portlet-title">
                        <div class="caption"><span class="fa fa-check-circle-o"></span> Gửi liên hệ thành công!</div>
                    </div>
                </div>
            <?php endif; ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#notice').delay(3000).fadeOut();
                });
            </script>
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-blue-sharp bold uppercase"><i class="fa fa-envelope font-blue-sharp"></i> Liên hệ</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-lg-6">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d489.92569681868537!2d106.68721337597012!3d10.780216756755513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x12f19494bc96ca5!2zU-G7nyBLaG9hIEjhu41jICYgQ8O0bmcgTmdo4buHIFRwLiBIY20!5e0!3m2!1svi!2s!4v1501578531776"
                            width="100%" height="448" frameborder="0" style="border:3px solid #dfdfdf"
                            allowfullscreen></iframe>
                    </div>
                    <div class="col-lg-6">
                        <div class="c-contact">
                            <div class="c-content-title-1">


                            </div>
                            <?php $form = ActiveForm::begin([

                                    'options' =>
                                        [
                                            'enctype' => 'multipart/form-data',
                                            'class' => '',
                                            "data-toggle"=>"validator"
                                        ],
                                    ]) ?>
                            <div class="form-group">
                                <?= $form->field($lien_he, 'ho_ten')->input('text', ['class' => 'form-control input-md', 'required' => 'true'])->label('Họ tên *') ?>
                            </div>
                            <div class="form-group">
                                <!--                            <input type="text" placeholder="Email" class="form-control input-md"> </div>-->
                                <?= $form->field($lien_he, 'email')->input('email', ['class' => 'form-control input-md', 'required' => 'email'])->label('Email *') ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($lien_he, 'dien_thoai')->input('text', ['class' => 'form-control input-md', 'required' => 'tel'])->label('Điện thoại *') ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($lien_he, 'noi_dung')->textarea(['class' => 'form-control input-md', 'rows' => 8, 'required' => 'true','data-minlength'=>'6'])->label('Nội dung *') ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Gửi</button>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                    <div style="clear: both"></div>


                </div>
            </div>
        </div>
    </div>
</div>
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
<!-- Slider -->
<!--<section>
    <div class="container">
        <div class="row">
             Left Column 
            <div class="col-xs-12 col-sm-12 col-md-4 text-right"> 
                <div class="margin-right-50">
                    <i class="icon-sli-paper-plane text-primary text-size-40 margin-bottom-20"></i>
                    <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Responsive Carousel</h3>
                    <p>Hendrerit in vulputate duis autem vel eum iriure dolor in velit esse molestie consequat, illum nulla facilisis</p>
                </div>

                <div class="line"> 
                    <hr class="break background-primary break-small right margin-top-bottom-40">
                </div>

                <div class="margin-right-50">
                    <i class="icon-sli-bulb text-primary text-size-40 margin-bottom-20"></i>
                    <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Tabs with URL Hash</h3>
                    <p>Hendrerit in vulputate duis autem vel eum iriure dolor in velit esse molestie consequat, dolore nulla facilisis</p>
                </div> 
            </div>

             Middle Column (carousel)
            <div class="col-xs-12 col-sm-12 col-md-4">                                                                                        
                <div class="carousel-default owl-carousel carousel-hide-arrows margin-m-top-bottom-50">                                                                                              
                    <div class="item">                                                                                                                                                                                                     
                        <img src="<?= Yii::$app->homeUrl ?>images/responsive-01.png"/>                                                                                                                                                              
                    </div>              
                    <div class="item">                                                                                                                                                                                                                 
                        <img src="<?= Yii::$app->homeUrl ?>images/responsive-02.png"/>                                                                                                                                                                                                                                                                                                                                                                                     
                    </div>              
                    <div class="item">                                                                                                                                                                                                     
                        <img src="<?= Yii::$app->homeUrl ?>images/responsive-03.png"/>                                                                                                                                                            
                    </div>              
                    <div class="item">
                        <img src="<?= Yii::$app->homeUrl ?>images/responsive-04.png"/>                                                                                                                                                            
                    </div>                                                                                                                                      
                </div>
            </div> 

             Right Column 
            <div class="col-xs-12 col-sm-12 col-md-4"> 
                <div class="margin-left-50">
                    <i class="icon-sli-heart text-primary text-size-40 margin-bottom-20"></i>
                    <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Unlimited Color Variants</h3>
                    <p>Hendrerit in vulputate duis autem vel eum iriure dolor in molestie consequat, vel illum dolore nulla facilisis</p>
                </div>

                <div class="line"> 
                    <hr class="break background-primary break-small margin-top-bottom-40">
                </div>

                <div class="margin-left-50">
                    <i class="icon-sli-layers text-primary text-size-40 margin-bottom-20"></i>
                    <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Responsive Navigation</h3>
                    <p>Hendrerit in vulputate duis autem vel eum iriure dolor in velit esse molestie vel illum dolore nulla facilisis</p>
                </div> 
            </div> 
        </div>                                                                                              
    </div>
</section>-->
<!-- end slider -->

<!-- Lien he -->
<section class="contact_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8" style="padding:0;">
                <div class="full">
                    <iframe style="position: relative; overflow: hidden;" src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d3919.4062005766523!2d106.6854360513013!3d10.780168692281286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e0!4m0!4m5!1s0x31752e6a8be347d7%3A0xb6547ba14d6dcb6!2zMjczIMSQaeG7h24gQmnDqm4gUGjhu6csIFBoxrDhu51uZyA3LCBRdeG6rW4gMywgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!3m2!1d10.780168699999999!2d106.68763009999999!5e0!3m2!1svi!2s!4v1592285512449!5m2!1svi!2s" width="100%" height="748" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4" style="padding:0;">
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
                <div class="full">
                    <div class="contact_form white_heading_border">
                        <div class="contact_form_inner">
                            <div class="full_heading white_fonts heading_main heading_style_1">
                                <h2>Trung tâm Ứng dụng Hệ thống Thông tin Địa lý Thành phố Hồ Chí Minh</h2>
                            </div>
                            <p><b>Địa chỉ:</b> 244 Điện Biên Phủ, Phường 7, Quận 3, Thành phố Hồ Chí Minh<br>
                                <b>Điện thoại:</b> (028) 3932 0963 – Fax: (028) 3932 0963<br>
                                <b>Email:</b> contact@hcmgis.vn – <b>Website:</b> https://hcmgis.vn<br>
                                <b>Giờ làm việc:</b> Thứ 2 đến thứ 6 (7h30 - 17h00)
                            </p>

                            <div class="form_contact">
                                <!-- form -->
                                <form action="index.html">
                                    <fieldset>
                                        <div class="field">
                                            <input type="text" name="name" placeholder="Tên của bạn" required="">
                                        </div>
                                        <div class="field">
                                            <input type="text" name="name" placeholder="Số điện thoại" required="">
                                        </div>
                                        <div class="field">
                                            <input type="email" name="email" placeholder="Email" required="">
                                        </div>
                                        <div class="field">
                                            <textarea name="messager" placeholder="Nội dung" required=""></textarea>
                                        </div>
                                        <div class="field">
                                            <button class="field_bt">GỬI</button>
                                        </div>
                                    </fieldset>
                                </form>
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


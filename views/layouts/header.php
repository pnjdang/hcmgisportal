<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/22/2017
 * Time: 10:27 AM
 */
?>
<header class="header header_style1">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-lg-12">
                   <div class="logo"><a href="<?= Yii::$app->homeUrl?>"><img src="<?= Yii::$app->homeUrl?>images/logo.png" alt="#" /></a></div>
                  <div class="main_menu float-right">
                      <div class="menu" style="text-transform: uppercase">
                        <ul class="clearfix">
                           <li class=""><a href="<?= Yii::$app->homeUrl?>">Trang chủ</a></li>
                           <li class=""><a href="<?= Yii::$app->urlManager->createUrl(['gioi-thieu'])?>">Giới thiệu</a></li>
                           <li class=""><a href="<?= Yii::$app->urlManager->createUrl(['san-pham'])?>">Sản phẩm</a></li>
                           <li class=""><a href="<?= Yii::$app->urlManager->createUrl(['tin-tuc'])?>">Tin tức</a></li>
                           <li class=""><a href="<?= Yii::$app->urlManager->createUrl(['tu-lieu'])?>">Tư liệu</a></li>
                           <li class=""><a href="<?= Yii::$app->urlManager->createUrl(['lien-he'])?>">Liên hệ</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
	  <script>
	  $(document).ready(function() {
    "use strict";
    $('.menu > ul > li:has( > ul)').addClass('menu-dropdown-icon');
    $('.menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');
    $(".menu > ul").before("<a href=\"#\" class=\"menu-mobile\">&nbsp;</a>");
    $(".menu > ul > li").hover(function(e) {
        if ($(window).width() > 991) {
            $(this).children("ul").stop(true, false).fadeToggle(150);
            e.preventDefault();
        }
    });
    $(".menu > ul > li").on('click', function() {
        if ($(window).width() <= 991) {
            $(this).children("ul").fadeToggle(150);
        }
    });
    $(".menu-mobile").on('click', function(e) {
        $(".menu > ul").toggleClass('show-on-mobile');
        e.preventDefault();
    });
});
$(window).resize(function() {
    $(".menu > ul > li").children("ul").hide();
    $(".menu > ul").removeClass('show-on-mobile');
});
	  </script>

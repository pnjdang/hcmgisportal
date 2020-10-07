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
               <div class="col-md-9 col-lg-12">
                   <div class="logo"><a href="<?= Yii::$app->urlManager->createUrl('site/index')?>"><img src="<?= Yii::$app->homeUrl?>images/logo.png" alt="#" /></a></div>
                  <div class="main_menu float-right">
                     <div class="menu">
                        <ul class="clearfix">
                           <li class="active"><a href="<?= Yii::$app->urlManager->createUrl('site/index')?>">Home</a></li>
                           <li><a href="<?= Yii::$app->urlManager->createUrl('site/gioithieu')?>">Giới thiệu</a></li>
                           <li><a href="<?= Yii::$app->urlManager->createUrl('site/sanpham')?>">Sản phẩm</a></li>
                           <li><a href="<?= Yii::$app->urlManager->createUrl('site/tintuc')?>">Tin tức</a></li>
                           <li><a href="<?= Yii::$app->urlManager->createUrl('site/tulieu')?>">Tư liệu</a></li>
                           <li><a href="<?= Yii::$app->urlManager->createUrl('site/lienhe')?>">Liên hệ</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <!--<div class="col-md-3 col-lg-2">
                  <div class="right_bt"><a class="bt_main" href="index.html">Get Support</a> </div>
               </div>-->
            </div>
         </div>
      </header>

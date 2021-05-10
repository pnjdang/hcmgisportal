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
               <!--<div class="col-md-3 col-lg-2">
                  <div class="right_bt"><a class="bt_main" href="index.html">Get Support</a> </div>
               </div>-->
            </div>
         </div>
      </header>

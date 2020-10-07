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

<!-- Tài liệu -->
<section class="layout_padding">
    <div class="container">
        <div class="row">
               <div class="full">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="full text_align_center">
                           <div class="heading_main center_head_border heading_style_1">
                              <h2>Tài liệu</h2>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        <div class="row">
            <?php if ($model['tailieu'] != null): ?>
            <?php foreach ($model['tailieu'] as $i => $sanpham): ?>
            <div class="box25">
                <a href="<?= Yii::$app->urlManager->createUrl('site/noidung') . "?id=" . $sanpham['ID']?>" class="image fit" style="cursor: pointer; outline: 0px;">
                    <img src="<?= $sanpham['post_img'] != null ? $sanpham['post_img'] : Yii::$app->homeUrl.'images/HCMGIS_demo.jpg'?>" alt="">
                    <div class="inner">
                        <h3><?= ($sanpham['post_title'] != null) ? $sanpham['post_title'] : '' ?></h3>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
            
        </div>
    </div>
</section>
<!-- end Tài liệu -->

<!-- Hình ảnh -->
<section class="layout_padding">
    <div class="container">
        <div class="row">
               <div class="full">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="full text_align_center">
                           <div class="heading_main center_head_border heading_style_1">
                              <h2>Hình ảnh</h2>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        <div class="row">
            <?php if ($model['hinhanh'] != null): ?>
            <?php foreach ($model['hinhanh'] as $i => $sanpham): ?>
            <div class="box25">
                <a href="<?= Yii::$app->urlManager->createUrl('site/noidung') . "?id=" . $sanpham['ID']?>" class="image fit" style="cursor: pointer; outline: 0px;">
                    <img src="<?= $sanpham['post_img'] != null ? $sanpham['post_img'] : Yii::$app->homeUrl.'images/HCMGIS_demo.jpg'?>" alt="">
                    <div class="inner">
                        <h3><?= ($sanpham['post_title'] != null) ? $sanpham['post_title'] : '' ?></h3>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
            
        </div>
    </div>
</section>
<!-- end Hình ảnh -->
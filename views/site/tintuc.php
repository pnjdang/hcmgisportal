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

<section class="layout_padding">
    <div class="container">
        <div class="row">
               <div class="full">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="full text_align_center">
                           <div class="heading_main center_head_border heading_style_1">
                              <h2>TIN TỨC</h2>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        <div class="row">
            <div class="full">
                <?php if ($model != null): ?>
            <?php foreach ($model as $i => $baiviet): ?>
                <div class="blog_post">
                    <div class="blog_post_img"> <a href="<?= Yii::$app->urlManager->createUrl('site/noidung') . "?id=" . $baiviet['ID']?>" style="cursor: pointer; outline: 0px;"><img src="<?= $baiviet['post_img'] != null ? $baiviet['post_img'] : Yii::$app->homeUrl.'images/HCMGIS_demo.jpg'?>" alt="#"></a> </div>
                           <div class="blog_post_cont">
                               <p class="title"><a href="<?= Yii::$app->urlManager->createUrl('site/noidung') . "?id=" . $baiviet['ID']?>" style="cursor: pointer; outline: 0px;"><?= ($baiviet['post_title'] != null) ? $baiviet['post_title'] : '' ?></a></p> 
                              <p class="date"><?= ($baiviet['post_modified'] != null) ? $baiviet['post_modified'] : '' ?></p>
                              <div class="post_head"><?= ($baiviet['post_content_filtered'] != null) ? $baiviet['post_content_filtered'] : '' ?></div>
                           </div>
                        </div>
                <?php endforeach; ?>
        <?php endif; ?>
                     </div>
        </div>
    </div>
</section>
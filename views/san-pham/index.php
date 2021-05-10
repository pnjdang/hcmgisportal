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
<!-- Nen tang HCMGIS -->
<section class="layout_padding">
    <div class="container">
        <div class="row">
            <div class="full">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="full text_align_center">
                            <div class="heading_main center_head_border heading_style_1">
                                <h2>Nền tảng dịch vụ HCMGIS</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if ($model['hcmgis'] != null): ?>
                <?php foreach ($model['hcmgis'] as $i => $hcmgis): ?>
                    <div class="box30">
                        <a href="<?= Yii::$app->urlManager->createUrl(['san-pham/'.$hcmgis->post_name])?>" class="image fit" style="cursor: pointer; outline: 0px;">
                            <img src="<?= ($hcmgis->post_img == null || !file_exists($hcmgis->post_img)) ? Yii::$app->homeUrl . 'uploads/app/images/HCMGIS_demo.jpg' : $hcmgis->post_img?>" alt="">
                            <div class="inner">
                                <h3><?= ($hcmgis->post_title != null) ? $hcmgis->post_title : '' ?></h3>
                                <div class="post_head"><?= ($hcmgis->post_content_filtered != null) ? $hcmgis->post_content_filtered : '' ?></div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>
<!-- end Nen tang HCMGIS -->

<!-- ung dung gis -->
<section class="layout_padding">
    <div class="container">
        <div class="row">
            <div class="full">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="full text_align_center">
                            <div class="heading_main center_head_border heading_style_1">
                                <h2>Ứng dụng GIS cho Sở ngành, quận huyện</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if ($model['sanpham'] != null): ?>
                <?php foreach ($model['sanpham'] as $i => $sanpham): ?>
                    <div class="box25">
                        <a href="<?= Yii::$app->urlManager->createUrl('site/noidung') . "?id=" . $sanpham['id']?>" class="image fit" style="cursor: pointer; outline: 0px;">
                            <img src="<?= ($sanpham->post_img == null || !file_exists($sanpham->post_img)) ? Yii::$app->homeUrl . 'uploads/app/images/HCMGIS_demo.jpg' : $sanpham->post_img?>" alt="">
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
<!-- end ung dung gis -->

<!-- cong cu, tien ich -->
<section class="layout_padding">
    <div class="container">
        <div class="row">
            <div class="full">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="full text_align_center">
                            <div class="heading_main center_head_border heading_style_1">
                                <h2>Công cụ – Tiện ích</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if ($model['tool'] != null): ?>
                <?php foreach ($model['tool'] as $i => $sanpham): ?>
                    <div class="box25">
                        <a href="<?= Yii::$app->urlManager->createUrl('site/noidung') . "?id=" . $sanpham['id']?>" class="image fit" style="cursor: pointer; outline: 0px;">
                            <img src="<?= ($sanpham->post_img == null || !file_exists($sanpham->post_img)) ? Yii::$app->homeUrl . 'uploads/app/images/HCMGIS_demo.jpg' : $sanpham->post_img?>" alt="">
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
<!-- end cong cu, tien ich -->
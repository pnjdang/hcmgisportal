<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 5/4/2021
 * Time: 10:51 AM
 */

use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
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
            <?php if ($posts['doc'] != null): ?>
                <?php foreach ($posts['doc'] as $i => $baiviet): ?>
                    <?php
                    if(is_link($baiviet->post_img)){
                        $image = $baiviet->post_img;
                    } elseif(!file_exists($baiviet->post_img)){
                        $image = Yii::$app->homeUrl . 'uploads/app/images/HCMGIS_demo.jpg';
                    } else {
                        $image = Yii::$app->homeUrl . 'uploads/app/images/HCMGIS_demo.jpg';
                    }
                    ?>
                    <div class="box25">
                        <a href="<?= Yii::$app->urlManager->createUrl(['tu-lieu/'. $baiviet->post_name])?>" class="image fit" style="cursor: pointer; outline: 0px;">
                            <img src="<?= $image?>" alt="">
                            <div class="inner">
                                <h3><?= ($baiviet['post_title'] != null) ? $baiviet['post_title'] : '' ?></h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

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
            <?php if ($posts['pic'] != null): ?>
                <?php foreach ($posts['pic'] as $i => $baiviet): ?>
                    <?php
                    if(is_link($baiviet->post_img)){
                        $image = $baiviet->post_img;
                    } elseif(!file_exists($baiviet->post_img)){
                        $image = Yii::$app->homeUrl . 'uploads/app/images/HCMGIS_demo.jpg';
                    } else {
                        $image = Yii::$app->homeUrl . 'uploads/app/images/HCMGIS_demo.jpg';
                    }
                    ?>
                    <div class="box25">
                        <a href="<?= Yii::$app->urlManager->createUrl(['tu-lieu/'. $baiviet->post_name]) ?>" class="image fit" style="cursor: pointer; outline: 0px;">
                            <img src="<?= $image?>" alt="">
                            <div class="inner">
                                <h3><?= ($baiviet['post_title'] != null) ? $baiviet['post_title'] : '' ?></h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>

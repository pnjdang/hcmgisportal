<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 5/4/2021
 * Time: 10:51 AM
 */

use yii\bootstrap4\LinkPager;
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
                                <h2>TIN TỨC</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="full">
                <?php foreach ($posts as $i => $baiviet): ?>
                    <?php
                    if(is_link($baiviet->post_img)){
                        $image = $baiviet->post_img;
                    } elseif(!file_exists($baiviet->post_img)){
                        $image = Yii::$app->homeUrl . 'uploads/app/images/HCMGIS_demo.jpg';
                    } else {
                        $image = Yii::$app->homeUrl . $baiviet->post_img;
                    }
                    ?>
                    <div class="blog_post">
                        <div class="blog_post_img"><a
                                    href="<?= Yii::$app->urlManager->createUrl(['tin-tuc/'. $baiviet->post_name]) ?>"
                                    style="cursor: pointer; outline: 0px;"><img
                                        src="<?= $image ?>"
                                        alt="#"></a></div>
                        <div class="blog_post_cont">
                            <p class="title"><a
                                        href="<?= Yii::$app->urlManager->createUrl(['tin-tuc/'. $baiviet->post_name]) ?>"
                                        style="cursor: pointer; outline: 0px;"><?= ($baiviet->post_title != null) ? $baiviet->post_title : '' ?></a>
                            </p>
                            <p class="date"><i class="fa fa-calendar"></i> <?= date('D d-m-Y', strtotime($baiviet->post_date)) ?></p>
                            <div class="post_head"><?= ($baiviet->post_content_filtered != null) ? $baiviet->post_content_filtered : '' ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?= LinkPager::widget([
                    'pagination' => $pagination,
//                    'linkOptions' => ['href' => 'tin-tuc111111','class' => 'page-link']
                ]); ?>
            </div>
        </div>

    </div>
</section>

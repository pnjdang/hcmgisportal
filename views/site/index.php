<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 2:16 PM
 */
?>
<section class="layout_padding">
    <div class="container">
        <?php if($model['banner'] == null || !file_exists($model['banner']->file_path)):?>
        <?php else:?>
        <div class="row">
            <div class="col-sm-12">
                <div class="full text_align_center">
                    <div class="full">
                        <img src="<?= $model['banner']->file_path?>" alt="#"
                             style="max-width: -webkit-fill-available;margin-bottom: 40px;">
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
        <div class="row">
            <div class="col-sm-12">
                <div class="full text_align_center">
                    <div class="heading_main center_head_border heading_style_1">
                        <h2>NỀN TẢNG DỊCH VỤ HCMGIS</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="full team_blog">
                    <div class="team_member_img"><a href="https://portal.hcmgis.vn/" target="_blank"><img
                                    src="<?= Yii::$app->homeUrl ?>images/portalhcmgis_thumb-copy.png" alt="#"></a></div>
                    <div class="team_imform">
                        <p class="team_mem_name"><a href="https://portal.hcmgis.vn/" target="_blank">HCMGIS PORTAL</a>
                        </p>
                        <p>Nền tảng tích hợp và chia sẻ dữ liệu HCMGIS.</p>
                        <p><a href="<?= Yii::$app->homeUrl ?>san-pham/hcmgis-portal" target="_blank">Xem thêm…</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="full team_blog">
                    <div class="team_member_img"><a href="https://maps.hcmgis.vn/" target="_blank"><img
                                    src="<?= Yii::$app->homeUrl ?>images/maphcmgis_thumb.png" alt="#"></a></div>
                    <div class="team_imform">
                        <p class="team_mem_name"><a href="https://maps.hcmgis.vn/" target="_blank">HCMGIS MAPS</a></p>
                        <p>Nền tảng bản đồ HCMGIS.</p>
                        <p><a href="<?= Yii::$app->homeUrl ?>san-pham/hcmgis-map" target="_blank">Xem thêm…</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="full team_blog">
                    <div class="team_member_img"><a href="https://geosurvey.hcmgis.vn/" target="_blank"><img
                                    src="<?= Yii::$app->homeUrl ?>images/banner_tourmap-2.jpg" alt="#"></a></div>
                    <div class="team_imform">
                        <p class="team_mem_name"><a href="https://geosurvey.hcmgis.vn/" target="_blank">HCMGIS
                                GEOSURVEY</a></p>
                        <p>Nền tảng thu thập dữ liệu thực địa.</p>
                        <p><a href="<?= Yii::$app->homeUrl ?>san-pham/hcmgis-geosurvey" target="_blank">Xem thêm…</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="full team_blog">
                    <div class="team_member_img"><a href="http://georeference.hcmgis.vn/" target="_blank"><img
                                    src="<?= Yii::$app->homeUrl ?>images/georefercence-300x159.png" alt="#"></a></div>
                    <div class="team_imform">
                        <p class="team_mem_name"><a href="http://georeference.hcmgis.vn/" target="_blank">HCMGIS
                                GEOREFERENCE</a></p>
                        <p>Nền tảng đăng ký toạ độ và chia sẻ ảnh.</p>
                        <p><a href="<?= Yii::$app->homeUrl ?>san-pham/hcmgis-georeference" target="_blank">Xem thêm…</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="full team_blog">
                    <div class="team_member_img"><a href="https://opendata.hcmgis.vn/" target="_blank"><img
                                    src="<?= Yii::$app->homeUrl ?>images/banner_HCMGIS_Opendata.jpg" alt="#"></a></div>
                    <div class="team_imform">
                        <p class="team_mem_name"><a href="https://opendata.hcmgis.vn/" target="_blank">HCMGIS
                                OPENDATA</a></p>
                        <p>Nền tảng chia sẻ dữ liệu mở.</p>
                        <p><a href="<?= Yii::$app->homeUrl ?>san-pham/hcmgis-opendata" target="_blank">Xem thêm….</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="full team_blog">
                    <div class="team_member_img"><a href="https://storymaps.hcmgis.vn/" target="_blank"><img
                                    src="<?= Yii::$app->homeUrl ?>images/storymap.png" alt="#"></a></div>
                    <div class="team_imform">
                        <p class="team_mem_name"><a href="https://storymaps.hcmgis.vn/" target="_blank">HCMGIS
                                STORYMAPS</a></p>
                        <p>Nền tảng kể chuyện bằng bản đồ.</p>
                        <p><a href="<?= Yii::$app->homeUrl ?>san-pham/hcmgis-storymaps" target="_blank">Xem thêm…</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="full team_blog">
                    <div class="team_member_img"><a href="https://geotag.hcmgis.vn/" target="_blank"><img
                                    src="<?= Yii::$app->homeUrl ?>images/geotag_thumb.jpg" alt="#"></a></div>
                    <div class="team_imform">
                        <p class="team_mem_name"><a href="https://geotag.hcmgis.vn/" target="_blank">HCMGIS GEOTAG</a>
                        </p>
                        <p>Nền tảng gắn thẻ địa lý và chia sẻ ảnh.</p>
                        <p><a href="<?= Yii::$app->homeUrl ?>san-pham/hcmgis-geotag" target="_blank">Xem thêm…</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="full team_blog">
                    <div class="team_member_img"><a href="https://geoevents.hcmgis.vn/" target="_blank"><img
                                    src="<?= Yii::$app->homeUrl ?>images/geoevents.jpg" alt="#"></a></div>
                    <div class="team_imform">
                        <p class="team_mem_name"><a href="https://geoevents.hcmgis.vn/" target="_blank">HCMGIS
                                GEOEVENTS</a></p>
                        <p>Nền tảng chia sẻ thông tin sự kiện.</p>
                        <p><a href="<?= Yii::$app->homeUrl ?>san-pham/hcmgis-geoevents" target="_blank">Xem thêm…</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="full team_blog">
                    <div class="team_member_img"><a href="http://geostats.hcmgis.vn/" target="_blank"><img
                                    src="<?= Yii::$app->homeUrl ?>images/geostats_thumb.jpg" alt="#"></a>
                    </div>
                    <div class="team_imform">
                        <p class="team_mem_name"><a href="http://geostats.hcmgis.vn/" target="_blank">HCMGIS
                                GEOSTATS</a></p>
                        <p>Nền tảng thống kê không gian.</p>
                        <p><a href="<?= Yii::$app->homeUrl ?>san-pham/hcmgis-geostats" target="_blank">Xem thêm…</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="full team_blog">
                    <div class="team_member_img"><a href="http://pointcloud.hcmgis.vn/" target="_blank"><img
                                    src="<?= Yii::$app->homeUrl ?>images/pointcloud_thumb.jpg" alt="#"></a>
                    </div>
                    <div class="team_imform">
                        <p class="team_mem_name"><a href="http://pointcloud.hcmgis.vn/" target="_blank">HCMGIS
                                POINTCLOUD</a></p>
                        <p>Nền tảng chia sẻ dữ liệu đám mây điểm.</p>
                        <p><a href="<?= Yii::$app->homeUrl ?>?#" target="_blank">Xem thêm…</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
<!-- section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="full text_align_center">
                    <div class="heading_main center_head_border heading_style_1">
                        <h2>ỨNG DỤNG GIS CHO SỞ NGÀNH, QUẬN HUYỆN</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin_bottom_30">
            <!-- featured image -->
            <div class="col-md-12 wow fadeInRight" data-wow-delay="0.5" data-wow-duration="1s"
                 style="visibility: visible; animation-duration: 1s; animation-name: fadeInRight;">
                <div class="full">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="carousel-default owl-carousel carousel-hide-arrows margin-m-top-bottom-50">
                            <div class="item">
                                <img src="<?= Yii::$app->homeUrl ?>images/1.jpg"/>
                            </div>
                            <div class="item">
                                <img src="<?= Yii::$app->homeUrl ?>images/2.jpg"/>
                            </div>
                            <div class="item">
                                <img src="<?= Yii::$app->homeUrl ?>images/3.jpg"/>
                            </div>
                            <div class="item">
                                <img src="<?= Yii::$app->homeUrl ?>images/4.jpg"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end featured image -->
        </div>
    </div>
</section>
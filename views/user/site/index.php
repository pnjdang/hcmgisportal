<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 2:16 PM
 */
?>
<style>
    .clickable {
        width: 100%;
        height: 100%;
        /*Important:*/
        position: relative;
    }

    .link-spanner {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;

        /* edit: fixes overlap error in IE7/8,
           make sure you have an empty gif
        background-image: url('empty.gif');*/
    }
</style>
<div class="page-content-inner" style="padding-top: 20px">

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-bottom-10">
            <div class="dashboard-stat white clickable" style="margin-bottom: 0px">
                <a href="<?= Yii::$app->urlManager->createUrl('phong-thi-nghiem') ?>">
                    <span class="link-spanner"></span>
                </a>

                <div class="visual">
                    <i class="fa fa-flask fa-icon-medium font-green-sharp"></i>
                </div>
                <div class="details">
                    <div class="number widget-thumb-body-stat font-green-sharp" data-counter="counterup"
                         data-value="<?= $ptn ?>"><a class="uppercase bold font-green-sharp"
                                                     href="<?= Yii::$app->urlManager->createUrl('phong-thi-nghiem') ?>"><?= $ptn ?></a>
                    </div>
                    <div class="desc">
                        <a class="uppercase bold font-green-sharp"
                           href="<?= Yii::$app->urlManager->createUrl('phong-thi-nghiem') ?>">Phòng thí
                            nghiệm</a>


                    </div>

                </div>

            </div>
            <div><a class="btn btn-sm btn-success bg-green-sharp" style="width: 100%;font-size: larger"
                    href="<?= Yii::$app->urlManager->createUrl('user/phongthinghiem/create') ?>">Đăng ký
                    phòng thí nghiệm</a></div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="dashboard-stat white clickable" style="margin-bottom: 0px">
                <a href="<?= Yii::$app->urlManager->createUrl('chuyen-gia') ?>">
                    <span class="link-spanner"></span>
                </a>

                <div class="visual">
                    <i class="fa fa-group fa-icon-medium font-red-haze"></i>
                </div>
                <div class="details">
                    <div class="number widget-thumb-body-stat font-red-haze" data-counter="counterup"
                         data-value="<?= $chuyengia ?>"><a class="uppercase bold font-red-haze"
                                                           href="<?= Yii::$app->urlManager->createUrl('chuyen-gia') ?>"><?= $chuyengia ?></a>
                    </div>
                    <div class="desc"><a class="uppercase bold font-red-haze"
                                         href="<?= Yii::$app->urlManager->createUrl('chuyen-gia') ?>">Chuyên gia</a>
                    </div>
                </div>
            </div>
            <div><a class="btn btn-sm btn-danger bg-red-haze" style="width: 100%;font-size: larger"
                    href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/create') ?>">Đăng ký
                    chuyên gia</a></div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="dashboard-stat white clickable" style="margin-bottom: 0px">
                <a href="#?">
                    <span class="link-spanner"></span>
                </a>

                <div class="visual">
                    <i class="fa fa-database fa-icon-medium font-yellow-haze"></i>
                </div>
                <div class="details">
                    <div class="number widget-thumb-body-stat font-yellow-haze" data-counter="counterup"
                         data-value="0"><a class="uppercase bold font-yellow-haze"
                                                           href="#?">0</a>
                    </div>
                    <div class="desc"><a class="uppercase bold font-yellow-haze"
                                         href="#?">Tổ chức</br>KHCN</a>
                    </div>
                </div>
            </div>
            <div><a class="btn btn-sm btn-warning bg-yellow-haze" style="width: 100%;font-size: larger"
                    href="#?">Đăng ký tổ chức</a></div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="dashboard-stat white clickable" style="margin-bottom: 0px">
                <a href="#?">
                    <span class="link-spanner"></span>
                </a>

                <div class="visual">
                    <i class="fa fa-cogs fa-icon-medium font-purple-plum"></i>
                </div>
                <div class="details">
                    <div class="number widget-thumb-body-stat font-purple-plum" data-counter="counterup"
                         data-value="0"><a class="uppercase bold font-purple-plum"
                                                           href="#?">0</a>
                    </div>
                    <div class="desc"><a class="uppercase bold font-purple-plum"
                                         href="#?">Doanh nghiệp</br>KHCN</a>
                    </div>
                </div>
            </div>
            <div><a class="btn btn-sm btn-danger bg-purple-plum" style="width: 100%;font-size: larger; border-color: #8775a7"
                    href="#?">Đăng ký
                    Doanh nghiệp</a></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div>
                <div class="portlet light">

                    <div class="portlet-body">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="row" style="padding-bottom: 20px">
                                    <div class="col-md-12">
                                        <img src="<?= Yii::$app->homeUrl ?>resources\img\banner-tiem-luc-khoa-hoc.jpg"
                                             class="img-responsive"/>
                                    </div>
                                </div>


                                <p class="text-justify"> Trang thông tin điện tử Tiềm lực khoa học và công nghệ thành
                                    phố Hồ Chí Minh là sản phẩm thuộc Chương trình nghiên cứu khoa học - phát triển công
                                    nghệ và nâng cao tiềm lực khoa học và công nghệ thành phố Hồ Chí Minh giai đoạn 2016
                                    - 2020 (ban hành theo Quyết định số 2953/QĐ-UBND ngày 07 tháng 6 năm 2016 của Ủy ban
                                    nhân dân Thành phố). Trang thông tin điện tử Tiềm lực khoa học và công nghệ thành
                                    phố Hồ Chí Minh được Sở Khoa học và Công nghệ xây dựng và phát triển nhằm phục vụ 02
                                    mục tiêu chính:
                                </p>
                                <p class="text-justify">
                                1. Nâng cao năng lực quản lý nhà nước về nguồn lực thông tin khoa học và công nghệ
                                    trên địa bàn thành phố. Hệ thống thông tin tiềm lực và hoạt động khoa học và công
                                    nghệ đồng bộ, chính xác sẽ là cơ sở hỗ trợ Thành phố định hướng chiến lược phát
                                    triển khoa học và công nghệ bám sát với xu hướng công nghệ trong và ngoài nước, đồng
                                    thời là cơ sở cho Thành phố trong quá trình ra quyết định đầu tư cho phát triển khoa
                                    học và công nghệ.
                                </p>
                                <p class="text-justify">
                                2. Hình thành mối liên kết về nguồn lực thông tin khoa học và công nghệ giữa cơ quan
                                    quản lý nhà nước về khoa học và công nghệ, các tổ chức khoa học và công nghệ và
                                    doanh nghiệp, tạo môi trường hợp tác thuận lợi giữa các tổ chức, cá nhân, doanh
                                    nghiệp tham gia hoạt động khoa học và công nghệ trên địa bàn thành phố Hồ Chí Minh.
                                </p>
                            </div>
                            <div class="col-md-4">
                                <div class="well" style="background-color: #4dbdfc">
                                    <address>244 Điện Biên Phủ, Phường 7, Quận 3, Thành phố Hồ Chí Minh
                                        <br>Điện thoại: 84-28-39327831
                                        <br>Fax: 84-28-39325584
                                        <br>Email: skhcn@tphcm.gov.vn
                                    </address>
                                </div>
                                <div class="col-md-12 banner-block-list">
                                    <div class="col-md-12 banner-block banner-phattriencn">
                                        <div class="icon"></div>
                                        <div class="heading">
                                            <a>NGHIÊN CỨU<br>KHOA HỌC VÀ CÔNG NGHỆ</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 banner-block banner-phattriencn">
                                        <div class="icon"></div>
                                        <div class="heading">
                                            <a>SÀN GIAO DỊCH<br>KHOA HỌC VÀ CÔNG NGHỆ</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 banner-block banner-doimoisangtao" onclick="window.location.href=&quot;https://doimoisangtao.vn&quot;">
                                        <div class="icon"></div>
                                        <div class="heading">
                                            <a target="_blank" href="https://doimoisangtao.vn">ĐỔI MỚI SÁNG TẠO<br>VÀ KHỞI NGHIỆP</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 banner-block banner-phattriencn">
                                        <div class="icon"></div>
                                        <div class="heading">
                                            <a>ĐÀO TẠO<br>TRỰC TUYẾN</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 banner-block banner-dichvucong" onclick="window.location.href='https://dvc-dost.hochiminhcity.gov.vn/whome'">
                                        <div class="icon"></div>
                                        <div class="heading">
                                            <a target="_blank" href="https://dvc-dost.hochiminhcity.gov.vn/whome">DỊCH VỤ CÔNG <br>TRỰC TUYẾN</a>
                                        </div>
                                    </div>
                                    <div class="banner-services-horlist">
                                        <div class="block">
                                            <img src="http://sokhcn.hcmgis.vn/static/demo/images/banner_biendao.jpg">
                                        </div>
                                        <div class="block">
                                            <img src="http://sokhcn.hcmgis.vn/static/demo/images/xange5.jpg">
                                        </div>
                                    </div>
                                    <div class="banner-services-horlist">
                                        <div class="col-md-12 video-widget">
                                            <div class="col-md-12 video-show">
                                                <iframe src="http://www.youtube.com/embed/BLLVqGZviBY" frameborder="0" id="video-show-frame" width="100%"></iframe>
                                            </div>
                                            <div class="col-md-12 video-listing">

                                                <div class="col-md-12 video-thumb">
                                                    <div class="title"><a onclick="videowidget_showVideoToFrame(&quot;http://www.youtube.com/embed/BLLVqGZviBY?autoplay=1&quot;)">40 năm Sở KH&amp;CN Thành phố Hồ Chí Minh_Phấn đấu vì thành phố đổi mới sáng tạo và khởi nghiệp</a></div>
                                                </div>

                                                <div class="col-md-12 video-thumb">
                                                    <div class="title"><a onclick="videowidget_showVideoToFrame(&quot;http://www.youtube.com/embed/zqJYxEExfJQ?autoplay=1&quot;)">Khoa học &amp; Công nghệ - Động lực phát triển nhanh và bền vững - Phần 1</a></div>
                                                </div>

                                                <div class="col-md-12 video-thumb">
                                                    <div class="title"><a onclick="videowidget_showVideoToFrame(&quot;http://www.youtube.com/embed/jIl2RydDh30?autoplay=1&quot;)">Khoa học &amp; Công nghệ - Động lực phát triển nhanh và bền vững - Phần 3</a></div>
                                                </div>

                                                <div class="col-md-12 video-thumb">
                                                    <div class="title"><a onclick="videowidget_showVideoToFrame(&quot;http://www.youtube.com/embed/Vnl7qYAPivI?autoplay=1&quot;)">Phim tư liệu: Viện Khoa học &amp; Công nghệ tính toán với sự phát triển năng động của TPHCM - Phần 1</a></div>
                                                </div>

                                                <div class="col-md-12 video-thumb">
                                                    <div class="title"><a onclick="videowidget_showVideoToFrame(&quot;http://www.youtube.com/embed/T1bOeK0Rbe0?autoplay=1&quot;)">Phim tư liệu: Viện Khoa học &amp; Công nghệ tính toán với sự phát triển năng động của TPHCM - Phần 2</a></div>
                                                </div>

                                            </div>
                                        </div>

                                        <script>
                                            var _frame_video = document.getElementById('video-show-frame');
                                            function videowidget_showVideoToFrame(href) {
                                                _frame_video.setAttribute('src', href);
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

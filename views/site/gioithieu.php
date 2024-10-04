<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 2:16 PM
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>
<!-- qua trinh hinh thanh -->
<section id="banner_parallax" class="slide_banner1">
    <div class="container">
        <div class="row" style="position: relative">
            <div class="col-md-8">
                <div class="full">
                    <div class="slide_cont">
                        <h2>QUÁ TRÌNH HÌNH THÀNH VÀ PHÁT TRIỂN</h2>
                        <p>Trung tâm Ứng dụng Hệ thống Thông tin Địa lý TP.HCM (HCMGIS) là đơn vị sự nghiệp trực thuộc
                            Sở Khoa học và Công nghệ TP.HCM được thành lập theo Quyết định số 134/2004/QĐ-UB ngày 14
                            tháng 5 năm 2004 của Ủy ban nhân dân Thành phố và Quyết định số 216/QĐ-UBND ngày 17 tháng 01
                            năm 2008 về việc bổ sung nhiệm vụ cho Trung tâm. Năm 2010, HCMGIS chuyển qua hoạt động theo
                            Nghị định 115 của Chính phủ về tự chủ, tự chịu trách nhiệm của tổ chức khoa học và công nghệ
                            công lập.</p>
                        <div class="full slide_bt"><a class="white_bt bt_main"
                                                      href="<?= Yii::$app->homeUrl ?>san-pham/profile-gioi-thieu-trung-tam-hcmgis">Profile giới
                                thiệu Trung tâm HCMGIS</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="full">
                    <div class="slide_pc_img wow fadeInRight" data-wow-delay="1s" data-wow-duration="2s"><img
                                src="<?= Yii::$app->homeUrl ?>images/hcmgis_flyer.png" alt="#"/></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end qua trinh hinh thanh -->

<!-- Chuc nang -->
<section class="layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="full text_align_center">
                    <div class="heading_main center_head_border heading_style_1">
                        <h2>CHỨC NĂNG</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row step_section">
            <div class="offset-xl-1 col-xl-10 col-md-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="step_blog arrow_right_step">
                            <div class="step_inner">
                                <i class="fa fa-search"></i><br>
                                <p>Nghiên cứu</p>
                            </div>
                            <p>Nghiên cứu, triển khai các ứng dụng công nghệ thông tin địa lý; điều phối các hoạt động
                                của hệ thống thông tin địa lý Thành phố</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="step_blog">
                            <div class="step_inner">
                                <i class="fa fa-group"></i><br>
                                <p>Tập hợp</p>
                            </div>
                            <p>Tập hợp các cán bộ khoa học kỹ thuật, nhà quản lý có khả năng và kinh nghiệm trong xây
                                dựng các giải pháp, chính sách, đào tạo nhằm giúp các đơn vị, cơ quan, tổ chức Nhà nước
                                sử dụng hiệu quả các ứng dụng của hệ thống thông tin địa lý, góp phần phát triển kinh tế
                                xã hội</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="step_blog">
                            <div class="step_inner">
                                <i class="fa fa-comment"></i><br>
                                <p>Tham mưu</p>
                            </div>
                            <p>Tham mưu cho lãnh đạo Sở KH&CN TP.HCM, UBND TP.HCM các vấn đề liên quan đến ứng dụng hệ
                                thống thông tin địa lý trong quản lý Nhà nước</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="step_blog">
                            <div class="step_inner">
                                <i class="fa fa-graduation-cap"></i><br>
                                <p>Đào tạo</p>
                            </div>
                            <p>Đào tạo, tuyên truyền, tư vấn về hệ thống thông tin địa lý</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end Chuc nang -->

<!-- Nhiem vu -->
<section class="layout_padding layer_style">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="full text_align_center">
                    <div class="heading_main center_head_border heading_style_1">
                        <h2>NHIỆM VỤ</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row app-features">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="features-left">
                    <li>
                        <i class="fa fa-comments-o"></i>
                        <div class="fl-inner step_section">
                            <p>Giúp Sở KH&CN TP.HCM tham mưu cho UBND TP.HCM về chiến lược, kế hoạch xây dựng, vận hành
                                và phát triển hệ thống thông tin địa lý phục vụ công tác quản lý Nhà nước</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-search"></i>
                        <div class="fl-inner step_section">
                            <p>Nghiên cứu và phát triển các dự án ứng dụng viễn thám và định vị toàn cầu phục vụ phát
                                triển đô thị và các lĩnh vực có nhu cầu của Thành phố </p>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-database"></i>
                        <div class="fl-inner step_section">
                            <br>
                            <p>Xây dựng cơ sở dữ liệu thông tin địa lý cho Thành phố Hồ Chí Minh</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="features-right">
                    <li>
                        <i class="fa fa-map-o"></i>
                        <div class="fl-inner step_section">
                            <p>Nghiên cứu, đề xuất các phân hệ đưa vào ứng dụng hệ thống thông tin địa lý trong quản lý
                                Nhà nước và phát triển công cụ thông tin địa lý trong quản lý<br>&NegativeMediumSpace;
                            </p>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-universal-access"></i>
                        <div class="fr-inner step_section">
                            <p>Cung cấp dịch vụ thông tin địa lý các tổ chức, cá nhân có nhu cầu theo đúng quy định của
                                Nhà nước<br>&NegativeMediumSpace;</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-pie-chart"></i>
                        <div class="fr-inner step_section">
                            <br>
                            <p>Tư vấn quản lý các dự án khoa học công nghệ liên quan đến hệ thống thông tin địa lý</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 wow fadeInRight" data-wow-delay="0.5" data-wow-duration="1s"
                 style="visibility: visible; animation-duration: 1s; animation-name: fadeInRight;">
                <div class="full">
                    <div class="center" style="margin-top: 40px">
                        <img src="<?= yii::$app->homeUrl ?>images/application_screen1.png" alt="#">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end nhiem vu -->

<!-- linh vu hoat dong -->
<section class="layout_padding gradiant_bg cross_layout">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="full text_align_center white_fonts">
                    <div class="heading_main center_head_border heading_style_1">
                        <h2>LĨNH VỰC HOẠT ĐỘNG</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row step_section">
            <div class="offset-xl-1 col-xl-10 col-md-12">
                <div class="row white_fonts">
                    <p><b>Nghiên cứu:</b> Nghiên cứu các công nghệ GIS và Viễn thám tiên tiến trên thế giới để ứng dụng
                        vào thực tế tại Việt Nam.</p>
                    <p><b>Xây dựng và chuyển giao ứng dụng:</b> Xây dựng và chuyển giao ứng dụng GIS cho các sở ngành,
                        quận huyện tại TP.HCM và các tỉnh thành trong cả nước.</p>
                    <p><b>Xây dựng và tích hợp cơ sở dữ liệu GIS:</b> Xây dựng cơ sở dữ liệu GIS cho TP.HCM và các tỉnh
                        thành, tích hợp cơ sở dữ liệu GIS từ nhiều nguồn khác nhau.</p>
                    <p><b>Đào tạo, chuyển giao công nghệ:</b> Thực hiện đào tạo, chuyển giao sử dụng các phần mềm, giải
                        pháp GIS cho cán bộ các sở ngành, quận huyện trong việc ứng dụng GIS vào hoạt động tác nghiệp
                        thường ngày.</p>
                    <p><b>Tư vấn, quản lý dự án:</b> Tư vấn lập dự án, thiết kế thi công, đấu thầu, giám sát thi công,
                        quản lý dự án ứng dụng CNTT, GIS cho các cơ quan, tổ chức và cá nhân có nhu cầu.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end linh vu hoat dong -->

<!-- ban lanh dao -->
<section class="layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="full text_align_center">
                    <div class="heading_main center_head_border heading_style_1">
                        <h2>BAN LÃNH ĐẠO</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="full team_blog">
                    <div class="team_imform">
                        <p class="team_mem_name">Phạm Quốc Phương</p>
                        <p style="text-transform: uppercase;">Giám đốc Trung tâm</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="full team_blog">
                    <div class="team_imform">
                        <p class="team_mem_name">Phạm Đức Thịnh</p>
                        <p style="text-transform: uppercase;">Phó Giám đốc</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-4 col-lg-3">
                <div class="full team_blog">
                    <div class="team_imform">
                        <p class="team_mem_name">Phạm Việt Ngữ</p>
                        <p style="text-transform: uppercase;">Phó trưởng Phòng Tư vấn Dịch vụ</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-4 col-lg-3">
                <div class="full team_blog">
                    <div class="team_imform">
                        <p class="team_mem_name">Huỳnh Minh Đức</p>
                        <p style="text-transform: uppercase;">Phó trưởng Phòng Phát triển Công nghệ</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-4 col-lg-3">
                <div class="full team_blog">
                    <div class="team_imform">
                        <p class="team_mem_name">Hà Thị Thu Huệ</p>
                        <p style="text-transform: uppercase;">Trưởng Phòng Hành chính - Kế toán</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-4 col-lg-3">
                <div class="full team_blog">
                    <div class="team_imform">
                        <p class="team_mem_name">Khưu Minh Cảnh</p>
                        <p style="text-transform: uppercase;">Phó Trưởng Phòng Cơ sở Dữ liệu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end ban lanh dao -->

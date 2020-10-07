<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 2:16 PM
 */
?>


<ul class="page-breadcrumb breadcrumb">
    <li>
        <a>Trang chủ</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Giới thiệu</span>
    </li>
</ul>
<div class="page-content-inner">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-10">
            <div class="dashboard-stat white">
                <div class="visual">
                    <i class="fa fa-flask fa-icon-medium font-green-sharp"></i>
                </div>
                <div class="details">
                    <div class="number widget-thumb-body-stat font-green-sharp" data-counter="counterup"
                         data-value="<?= $ptn ?>"><?= $ptn ?></div>
                    <div class="desc"> Phòng thí nghiệm</div>
                </div>
                <a class="more" href="phongthinghiem"> Chi tiết
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="dashboard-stat white">
                <div class="visual">
                    <i class="fa fa-group fa-icon-medium font-red-haze"></i>
                </div>
                <div class="details">
                    <div class="number widget-thumb-body-stat font-red-haze" data-counter="counterup"
                         data-value="<?= $chuyengia ?>"> <?= $chuyengia ?> </div>
                    <div class="desc"> Chuyên gia</div>
                </div>
                <a class="more" href="chuyengia"> Chi tiết
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div>
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-info-circle font-blue-sharp"></i>
                            <span class="caption-subject font-blue-sharp bold uppercase"> Giới thiệu</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" style="padding-bottom: 20px">
                            <div class="col-md-12">
                                <h3>SỞ KHOA HỌC VÀ CÔNG NGHỆ THÀNH PHỐ HỒ CHÍ MINH</h3>
                                <img src="<?= Yii::$app->urlManager->createUrl('resources/img/so_khcn.jpg') ?>"
                                     class="img-responsive"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-justify"> Cổng thông tin tiềm lực khoa học công nghệ được xây dựng nhằm
                                    tạo lập một mạng lưới kết nối các tổ chức, cá nhân hoạt động khoa học và công nghệ
                                    trên địa bàn Thành phố Hồ Chí Minh. </p>

                                <p class="text-justify"> Ngoài ra, việc xây dựng cơ sở dữ liệu tiềm lực khoa học và công
                                    nghệ là điều cần thiết để đánh giá hiện trạng tiềm lực khoa học và công nghệ của
                                    Thành phố. Từ đó xây dựng quy hoạch, chính sách hỗ trợ các tổ chức và cá nhân hoạt
                                    động KH&CN, thúc đẩy phát triển tiềm lực của các tổ chức KH&CN, phòng thí nghiệm
                                    trên địa bàn Thành phố. </p>
                            </div>
                            <div class="col-md-4">
                                <div class="well bg-after-blue">
                                    <address>244 Điện Biên Phủ, Phường 7, Quận 3, Thành phố Hồ Chí Minh
                                        <br>Điện thoại: 84-28-39327831
                                        <br>Fax: 84-28-39325584
                                        <br>Email: skhcn@tphcm.gov.vn
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

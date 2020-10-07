<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/22/2017
 * Time: 10:24 AM
 */


?>
<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'user/site/index') ? 'active' : ''?>">
            <a href="<?= Yii::$app->urlManager->createUrl('user/site/index') ?>" class="nav-link nav-toggle">
                <i class="fa fa-home"></i>
                <span class="title">Trang chủ</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'tong-quan') ? 'active' : ''?>">
            <a href="<?= Yii::$app->urlManager->createUrl('tong-quan')?>" class="nav-link nav-toggle">
                <i class="fa fa-dashboard"></i>
                <span class="title">Tổng quan</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="heading">
            <h3 class="uppercase">Quản lý</h3>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link nav-toggle">
                <i class="fa fa-list"></i>
                <span class="title">Danh sách đăng ký</span>
                <span id="arrow" class="arrow"></span>
            </a>
            <ul class="sub-menu" id="dangky">
                <li id="dangky" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danh-sach-dang-ky-chuyen-gia') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danh-sach-dang-ky-chuyen-gia')?>" class="nav-link ">
                        <span class="title">Chuyên gia</span>
                    </a>
                </li>
                <li id="dangky" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danh-sach-dang-ky-phong-thi-nghiem') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danh-sach-dang-ky-phong-thi-nghiem')?>" class="nav-link ">
                        <span class="title">Phòng thí nghiệm</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link nav-toggle">
                <i class="fa fa-user-circle-o"></i>
                <span class="title">Chuyên gia</span>
                <span id="arrow" class="arrow"></span>
            </a>
            <ul class="sub-menu" id="chuyengia">
                <li id="chuyengia" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danh-sach-chuyen-gia-tong-hop') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danh-sach-chuyen-gia-tong-hop')?>" class="nav-link nav-toggle">
                        <i class="fa fa-list"></i>
                        <span class="title">Tổng hợp</span>
                    </a>
                </li>
                <li id="chuyengia" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danh-sach-chuyen-gia-theo-linh-vuc') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danh-sach-chuyen-gia-theo-linh-vuc')?>" class="nav-link nav-toggle">
                        <i class="fa fa-list"></i>
                        <span class="title">Theo lĩnh vực</span>
                    </a>
                </li>
                <li id="chuyengia" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danh-sach-chuyen-gia-theo-chuyen-nganh') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danh-sach-chuyen-gia-theo-chuyen-nganh')?>" class="nav-link nav-toggle">
                        <i class="fa fa-list"></i>
                        <span class="title">Theo chuyên ngành</span>
                    </a>
                </li>
                <li id="chuyengia" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'them-moi-chuyen-gia') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('them-moi-chuyen-gia')?>" class="nav-link nav-toggle">
                        <i class="fa fa-plus"></i>
                        <span class="title">Thêm mới</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link nav-toggle">
                <i class="fa fa-flask"></i>
                <span class="title">Phòng thí nghiệm</span>
                <span id="arrow" class="arrow"></span>
            </a>
            <ul class="sub-menu" id="phongthinghiem">
                <li id="phongthinghiem" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danh-sach-phong-thi-nghiem-tong-hop') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danh-sach-phong-thi-nghiem-tong-hop')?>" class="nav-link nav-toggle">
                        <i class="fa fa-list"></i>
                        <span class="title">Tổng hợp</span>
                    </a>
                </li>
                <li id="phongthinghiem" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danh-sach-phong-thi-nghiem-theo-linh-vuc') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danh-sach-phong-thi-nghiem-theo-linh-vuc')?>" class="nav-link nav-toggle">
                        <i class="fa fa-list"></i>
                        <span class="title">Theo lĩnh vực</span>
                    </a>
                </li>
                <li id="phongthinghiem" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'dschuyengia') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('admin/phongthinghiem/create')?>" class="nav-link nav-toggle">
                        <i class="fa fa-plus"></i>
                        <span class="title">Thêm mới</span>
                    </a>
                </li>


            </ul>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link nav-toggle">
                <i class="fa fa-list"></i>
                <span class="title">Danh mục</span>
                <span id="arrow" class="arrow"></span>
            </a>
            <ul class="sub-menu" id="danhmuc">

                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/chuyengia/donvi') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/chuyengia/donvi')?>" class="nav-link ">
                        <span class="title">Đơn vị công tác</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/chuyengia/nhomdonvi') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/chuyengia/nhomdonvi')?>" class="nav-link ">
                        <span class="title">Nhóm đơn vị</span>
                    </a>
                </li>

                 <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/chuyengia/hocham') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/chuyengia/hocham')?>" class="nav-link ">
                        <span class="title">Học hàm</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/chuyengia/hocvi') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/chuyengia/hocvi')?>" class="nav-link ">
                        <span class="title">Học vị</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/phongthinghiem/linhvucthunghiem') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/phongthinghiem/linhvucthunghiem')?>" class="nav-link ">
                        <span class="title">Lĩnh vực thử nghiệm</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'linhvucquanly') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->homeUrl?>linhvucquanly" class="nav-link ">
                        <span class="title">Lĩnh vực</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/chuyengia/linhvucnghiencuucap1') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/chuyengia/linhvucnghiencuucap1')?>" class="nav-link ">
                        <span class="title">Lĩnh vực nghiên cứu cấp 1</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/chuyengia/linhvucnghiencuucap2') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/chuyengia/linhvucnghiencuucap2')?>" class="nav-link ">
                        <span class="title">Lĩnh vực nghiên cứu cấp 2</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/chuyengia/linhvucnghiencuucap3') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/chuyengia/linhvucnghiencuucap3')?>" class="nav-link ">
                        <span class="title">Lĩnh vực nghiên cứu cấp 3</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/chuyengia/loaicongtrinhnghiencuu') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/chuyengia/loaicongtrinhnghiencuu')?>" class="nav-link ">
                        <span class="title">Loại công trình</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/phongthinghiem/chungloai') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/phongthinghiem/chungloai')?>" class="nav-link ">
                        <span class="title">Chủng loại vật liệu & sản phẩm</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/phongthinghiem/phanloai') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/phongthinghiem/phanloai')?>" class="nav-link ">
                        <span class="title">Phân loại vật liệu & sản phẩm</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/phongthinghiem/tieuchuan') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/phongthinghiem/tieuchuan')?>" class="nav-link ">
                        <span class="title">Phương pháp tiêu chuẩn</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/phongthinghiem/congnhanchatluong') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/phongthinghiem/congnhanchatluong')?>" class="nav-link ">
                        <span class="title">Tiêu chuẩn chất lượng</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/phongthinghiem/tochuchoptac') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/phongthinghiem/tochuchoptac')?>" class="nav-link ">
                        <span class="title">Tổ chức/Hội viên</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/phongthinghiem/doituongphucvu') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/phongthinghiem/doituongphucvu')?>" class="nav-link ">
                        <span class="title">Đối tượng phục vụ</span>
                    </a>
                </li>
                <li id="danhmuc" class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'danhmuc/phongthinghiem/thietbi') ? 'active' : ''?>">
                    <a href="<?= Yii::$app->urlManager->createUrl('danhmuc/phongthinghiem/thietbi')?>" class="nav-link ">
                        <span class="title">Thiết bị thử nghiệm</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="heading">
            <h3 class="uppercase">Tài khoản</h3>
        </li>
        <li class="nav-item  ">
            <a href="<?= Yii::$app->homeUrl?>taikhoan/quanlytaikhoan" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">Quản lý tài khoản</span>
            </a>
        </li>

    </ul>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
<!--<script>
    $(document).ready(function() {
        var dangky = $('li#dangky');
        var danhmuc = $('li#danhmuc');
        var chuyengia = $('li#chuyengia');
        var phongthinghiem = $('li#phongthinghiem');
        if (danhmuc.hasClass('active')) {
            danhmuc.parent('#danhmuc').css("display", "block");
            danhmuc.parent('#danhmuc').parent().addClass('open');
            danhmuc.parent('#danhmuc').parent().children('a').children('#arrow').addClass('open');
        } else {
            danhmuc.parent('#danhmuc').css("display", "none");
        }
        if (dangky.hasClass('active')) {
            dangky.parent('#dangky').css("display", "block");
            dangky.parent('#dangky').parent().addClass('open');
            dangky.parent('#dangky').parent().children('a').children('#arrow').addClass('open');
        } else {
            dangky.parent('#dangky').css("display", "none");
        }
        if (chuyengia.hasClass('active')) {
            chuyengia.parent('#chuyengia').css("display", "block");
            chuyengia.parent('#chuyengia').parent().addClass('open');
            chuyengia.parent('#chuyengia').parent().children('a').children('#arrow').addClass('open');
        } else {
            chuyengia.parent('#chuyengia').css("display", "none");
        }
        if (phongthinghiem.hasClass('active')) {
            phongthinghiem.parent('#phongthinghiem').css("display", "block");
            phongthinghiem.parent('#phongthinghiem').parent().addClass('open');
            phongthinghiem.parent('#phongthinghiem').parent().children('a').children('#arrow').addClass('open');
        } else {
            phongthinghiem.parent('#phongthinghiem').css("display", "none");
        }

    });
</script>-->
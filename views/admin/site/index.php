<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<!-- BEGIN PAGE HEAD-->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Tổng quan
        </h1>
    </div>
    <!-- END PAGE TITLE -->

</div>
<!-- END PAGE HEAD-->

<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="7800"><?= $ptn ?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->urlManager->createUrl('danh-sach-phong-thi-nghiem-tong-hop') ?>">Phòng thí nghiệm</a></small>
                </div>
                <div class="icon">
                    <i class="fa fa-flask"></i>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-red-haze">
                        <span data-counter="counterup" data-value="1349"><?= 1 ?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index') ?>">Chuyên
                            gia</a></small>
                </div>
                <div class="icon">
                    <i class="fa fa-user-circle-o"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="567"><?= 1 ?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->urlManager->createUrl('admin/dangky/phongthinghiem') ?>">Phiếu đăng
                            ký phòng thí nghiệm</a></small>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-purple-soft">
                        <span data-counter="counterup" data-value="276"><?= 1 ?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->urlManager->createUrl('admin/dangky/chuyengia') ?>">Phiếu đăng ký
                            chuyên gia</a></small>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
            </div>

        </div>
    </div>
</div>
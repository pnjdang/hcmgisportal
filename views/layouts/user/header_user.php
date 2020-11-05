

<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/22/2017
 * Time: 10:27 AM
 */
?>
<!-- BEGIN HEADER TOP -->
<div class="page-header-top">
    <div class="container">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?= Yii::$app->urlManager->createUrl('') ?>">
                <img src="<?= Yii::$app->urlManager->createUrl('images/logo.png') ?>" alt="logo" class="logo-default" style="max-width: 100%;
    max-height: 100%;">
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <div class="hor-menu" style="float: right">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown-menu-right">
                    <?php if (Yii::$app->user->isGuest): ?>
                        <a href="<?= Yii::$app->urlManager->createUrl('site/login') ?>">
                            Đăng nhập
                        </a>
                    <?php else: ?>
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <span class="username username-hide-on-mobile" style="color: #ffffff">Xin chào <b><?= Yii::$app->user->identity->ho_ten ?></b> !</span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                        </a>
                        <ul class="dropdown-menu" style="min-width: 260px;z-index: 1111">

                            <?php if (Yii::$app->user->identity->id_loaitk == 3): ?>
                                <li>
                                    <a href="<?= Yii::$app->urlManager->createUrl('thong-tin-ca-nhan') ?>">
                                        <i class="fa fa-user"></i> Thông tin cá nhân </a>
                                </li>
                            <?php endif?>
                            <li class="divider"></li>
                            <li>
                                <a href="<?= Yii::$app->homeUrl ?>site/logout">
                                    <i class="fa fa-sign-out"></i> Đăng xuất </a>
                            </li>

                        </ul>
                    <?php endif ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        
    </div>
</div>
<!-- END HEADER TOP -->


<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/22/2017
 * Time: 10:27 AM
 */
?>
<div class="page-header-inner ">
    <div class="page-logo">
        <a href="<?= Yii::$app->homeUrl?>">
            <img src="<?= Yii::$app->homeUrl?>images/logo.png" alt="logo"
                 class="logo-default logo-responsive"/> </a>
        <div class="menu-mobile">
        </div>
    </div>
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
       data-target=".navbar-collapse"> </a>

    <div class="page-top">
<!--        <form class="search-form" action="search" method="GET">
            <div class="input-group">
                <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="fa fa-search"></i>
                                </a>
                            </span>
            </div>
        </form>-->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
               
              
                <li class="separator hide"></li>
                <li class="dropdown dropdown-user dropdown-dark">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span class="username username-hide-on-mobile"><?= (!Yii::$app->user->isGuest) ? Yii::$app->user->identity->tendangnhap : ''?></span>
                        <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                        <img alt="" class="img-circle"
                             src="<?= Yii::$app->homeUrl.((!Yii::$app->user->isGuest) ? 'resources/images/photo.jpg' : '')?>"/>
                         </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl('auth/site/thong-tin-ca-nhan') ?>">
                                <i class="fa fa-user"></i> Thông tin cá nhân </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl(['auth/dang-xuat'])?>">
                                <i class="fa fa-sign-out"></i> Đăng xuất </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>

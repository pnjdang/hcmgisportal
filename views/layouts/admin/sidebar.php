<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/22/2017
 * Time: 10:24 AM
 */

//$userDataType = Yii::$app->user->identity->auth_datatype;


//\app\services\DebugService::dumpdie(Yii::$app->getHomeUrl());
//\app\services\DebugService::dumpdie($controller->module);

?>


<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="nav-item">
            <a href="<?= Yii::$app->homeUrl ?>" class="nav-link nav-toggle">
                <i class="fa fa-home"></i>
                <span class="title">Trang chủ</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="heading">
            <h3 class="uppercase">Quản lý</h3>
        </li>
        <li class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'admin/gis-posts/index') ? 'active' : ''?>">
            <a href="<?= Yii::$app->urlManager->createUrl('admin/gis-posts/index')?>" class="nav-link nav-toggle">
                <i class="fa fa-list"></i>
                <span class="title">Bài viết</span>
            </a>
        </li>
        <li class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'admin/lien-he/index') ? 'active' : ''?>">
            <a href="<?= Yii::$app->urlManager->createUrl('admin/lien-he/index')?>" class="nav-link nav-toggle">
                <i class="fa fa-list"></i>
                <span class="title">Liên Hệ</span>
            </a>
        </li>
        <li class="nav-item <?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'media/index') ? 'active' : ''?>">
            <a href="<?= Yii::$app->urlManager->createUrl('media/index')?>" class="nav-link nav-toggle">
                <i class="fa fa-list"></i>
                <span class="title">Upload</span>
            </a>
        </li>
        <li class="heading">
            <h3 class="uppercase">Tài khoản</h3>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>

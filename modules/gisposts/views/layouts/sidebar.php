<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/22/2017
 * Time: 10:24 AM
 */

$params = Yii::$app->params;

$controller = Yii::$app->requestedAction->controller->id;
?>
<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="nav-item <?= $controller == 'site' ? 'active' : ''?>">
            <a href="<?= Yii::$app->urlManager->createUrl(['cms/site/index']) ?>" class="nav-link nav-toggle">
                <i class="fa fa-home"></i>
                <span class="title">Trang chủ</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item <?= $controller == 'posts' ? 'active' : ''?>">
            <a href="<?= Yii::$app->urlManager->createUrl(['cms/posts/index']) ?>" class="nav-link nav-toggle">
                <i class="fa fa-list-alt"></i>
                <span class="title">Bài viết</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item <?= $controller == 'products' ? 'active' : ''?>">
            <a href="<?= Yii::$app->urlManager->createUrl(['cms/products/index']) ?>" class="nav-link nav-toggle">
                <i class="fa fa-file-text"></i>
                <span class="title">Sản phẩm</span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item <?= $controller == 'media' ? 'active' : ''?>">
            <a href="<?= Yii::$app->urlManager->createUrl(['cms/media/index']) ?>" class="nav-link nav-toggle">
                <i class="fa fa-picture-o"></i>
                <span class="title">Media</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item <?= $controller == 'media' ? 'active' : ''?>">
            <a href="<?= Yii::$app->urlManager->createUrl(['cms/main-banner/index']) ?>" class="nav-link nav-toggle">
                <i class="fa fa-star"></i>
                <span class="title">Banner</span>
                <span class="selected"></span>
            </a>
        </li>

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-list"></i>
                <span class="title">Danh mục</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl(['cms/post-type/index']) ?>" class="nav-link nav-toggle">
                        <span class="title">Loại bài viết</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl(['cms/file-type/index']) ?>" class="nav-link nav-toggle">
                        <span class="title">Loại file</span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
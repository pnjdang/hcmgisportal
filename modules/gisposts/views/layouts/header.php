<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/22/2017
 * Time: 10:27 AM
 */
use app\modules\gisposts\assets\GispostsAsset;
use app\modules\gisposts\assets\PortfolioAsset;

$assetBundles = $this->assetBundles;

if(isset($assetBundles[GispostsAsset::class])){
    $assetBaseUrl = $this->assetBundles[GispostsAsset::class]->baseUrl;
}

if(isset($assetBundles[PortfolioAsset::class])){
    $assetBaseUrl = $this->assetBundles[PortfolioAsset::class]->baseUrl;
}

?>
<div class="page-header-inner ">
    <div class="page-logo">
        <a href="<?= Yii::$app->homeUrl?>">
            <img src="<?= $assetBaseUrl ?>/images/logo.png" alt="logo" width="180px"
                 class="logo-default"/> </a>
        <div class="menu-toggler sidebar-toggler">
        </div>
    </div>
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
       data-target=".navbar-collapse"> </a>
    <div class="page-top">
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
               
              
                <li class="separator hide"></li>
                <li class="dropdown dropdown-user dropdown-dark">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span class="username username-hide-on-mobile"><?= (!Yii::$app->user->isGuest) ? 'Xin chào <b>'.Yii::$app->user->identity->ten_dang_nhap.'</b>!' : ''?></span>
                        <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl('admin/tai-khoan') ?>">
                                <i class="fa fa-user"></i> Thông tin cá nhân </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl('cms/site/logout')?>">
                                <i class="fa fa-sign-out"></i> Đăng xuất </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>

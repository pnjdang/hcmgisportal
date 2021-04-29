<?php
/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use \app\modules\gisposts\assets\GispostsAsset;

GispostsAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>HCMGIS.VN - Nền tảng dịch vụ HCMGIS</title>
    <?php $this->head() ?>
</head>
<body id="default_theme" class="home_page1" style="overflow: visible;">
<?php $this->beginBody() ?>

<header class="header header_style1">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-lg-12">
                <div class="logo"><a href="<?= Yii::$app->urlManager->createUrl('site/index')?>"><img src="<?= Yii::$app->homeUrl?>images/logo.png" alt="#" /></a></div>
                <div class="main_menu float-right">
                    <div class="menu" style="text-transform: uppercase">
                        <ul class="clearfix">
                            <li class="<?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'site/index') ? 'active' : ''?>"><a href="<?= Yii::$app->urlManager->createUrl('site/index')?>">Trang chủ</a></li>
                            <li class="<?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'site/gioithieu') ? 'active' : ''?>"><a href="<?= Yii::$app->urlManager->createUrl('site/gioithieu')?>">Giới thiệu</a></li>
                            <li class="<?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'site/sanpham') ? 'active' : ''?>"><a href="<?= Yii::$app->urlManager->createUrl('site/sanpham')?>">Sản phẩm</a></li>
                            <li class="<?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'site/tintuc') ? 'active' : ''?>"><a href="<?= Yii::$app->urlManager->createUrl('site/tintuc')?>">Tin tức</a></li>
                            <li class="<?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'site/tulieu') ? 'active' : ''?>"><a href="<?= Yii::$app->urlManager->createUrl('site/tulieu')?>">Tư liệu</a></li>
                            <li class="<?= \app\services\UtilityService::checkPathInfo(Yii::$app->request->pathInfo,'site/lienhe') ? 'active' : ''?>"><a href="<?= Yii::$app->urlManager->createUrl('site/lienhe')?>">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-3 col-lg-2">
               <div class="right_bt"><a class="bt_main" href="index.html">Get Support</a> </div>
            </div>-->
        </div>
    </div>
</header>

<div class="container">
    <div class="content">
        <?=
        Breadcrumbs::widget([
            'tag' => 'ol',
            'homeLink' => [
                'label' => Yii::t('yii', 'Trang chủ'),
                'url' => Yii::$app->urlManager->createUrl('cms/site/index'),
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>",
            'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>",
            'options' => [
                'class' => 'breadcrumb',
            ]
        ])
        ?>
        <?= $content ?>
    </div>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/22/2017
 * Time: 10:15 AM
 */
?>

<footer class="footer_style_2">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 margin_bottom_30">
                    <div class="full width_9" style="margin-bottom:25px;"> <a href="#?"><img class="img-responsive" width="250" src="<?= Yii::$app->homeUrl?>images/logo-bot.png" alt="#"></a> </div>
                    <div class="full width_9">
                        <p>Center for Applied GIS of Ho Chi Minh City (HCMGIS) focuses on consulting, developing, training and transferring GIS solutions and applications in urban management, natural resources and environment, and economic-cultural-social development.</p>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 margin_bottom_30">
                    <div class="full">
                        <div class="footer_blog_2">
                            <h3>Social</h3>
                        </div>
                    </div>
                    <div class="full">
                        <ul class="footer-links">
                            <li><a href="https://www.facebook.com/hcmgis/" target="_blank"><i class="fa fa-facebook"></i></a> <a href="https://www.linkedin.com/company/hcmgis/" target="_blank"><i class="fa fa-linkedin"></i></a> <a href="https://www.facebook.com/hcmgis/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- footer bottom -->
    <div class="footer_bottom">
        <p>© <script>document.write(new Date().getFullYear());</script> <strong>HCMGIS</strong></p>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

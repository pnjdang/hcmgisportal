<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot/resources';
    public $baseUrl = '@web/resources';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
//        'css/global/font-awesome.min.css',
//        'css/simple-line-icons.min.css',
       'css/global/bootstrap.min.css',
//        'css/global/icheck.css',
//        'css/global/components.min.css',
//        'css/profile.min.css',
//        'css/light.min.css',
//        'css/magnific-popup.css',
        'owl-carousel/owl.carousel.css',
        'owl-carousel/owl.theme.css',
        'css/style.css',
        'css/responsive.css',
        'css/colors.css',
        'css/animate.css',
        //'css/iLightBox.min.css',
//        'css/lightcase.css'
    ];
    public $js = [
        'js/global/jquery.min.js',
        'js/global/bootstrap.min.js',
        'owl-carousel/owl.carousel.js',
        'js/template-scripts.js',
        //'js/popper.min.js',
        'js/wow.js',
       //'js/custom.js',
        'js/pdf.min.js',
//        'js/global/jquery.ilightbox.js',
//        'js/global/jquery.slimscroll.min.js',
//        'js/global/jquery.blockui.min.js',
//        'js/global/bootstrap-switch.min.js',
//        'js/global/icheck.min.js',
//        'js/global/form-icheck.min.js',
//        'js/global/app.min.js',
//        'js/profile.min.js',
//        'js/layout.min.js',
//        'js/demo.min.js',
//        'js/quick-sidebar.min.js',
        //  'js/leaflet/prunecluster.js',
        // 'js/leaflet/jquery.geocomplete.js',
//        'js/bootbox.min.js',
//        'js/ui-function.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

}

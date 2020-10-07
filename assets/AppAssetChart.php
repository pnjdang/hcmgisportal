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
class AppAssetChart extends AssetBundle
{

    public $basePath = '@webroot/resources';
    public $baseUrl = '@web/resources';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        'css/global/font-awesome.min.css',
        'css/simple-line-icons.min.css',
        'css/global/bootstrap.min.css',

        'css/global/components.min.css',
        'css/profile.min.css',
        'css/layout.css',

        'css/light.min.css',

        'css/magnific-popup.css',
    ];
    public $js = [
        'js/global/jquery.min.js',
        'js/global/bootstrap.min.js',
        'js/global/js.cookie.min.js',
        'js/global/bootstrap-hover-dropdown.js',
        'js/global/jquery.slimscroll.min.js',
        'js/global/jquery.blockui.min.js',
        'js/global/bootstrap-switch.min.js',
        'js/morris.min.js',
        'js/amcharts/amcharts/amcharts.js',
        'js/amcharts/amcharts/serial.js',
        'js/amcharts/amcharts/pie.js',
        'js/amcharts/amcharts/themes/light.js',
        'js/jquery.sparkline.min.js',
        'js/global/app.min.js',
        'js/profile.min.js',
        'js/dashboard.min.js',
        'js/layout.min.js',
        'js/demo.min.js',
        'js/quick-sidebar.min.js',
        'js/bootbox.min.js',
        'js/ui-function.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

}

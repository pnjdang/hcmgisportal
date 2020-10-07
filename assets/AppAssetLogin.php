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
class AppAssetLogin extends AssetBundle {

    public $basePath = '@webroot/resources';
    public $baseUrl = '@web/resources';
    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD];
    public $css = [
        'css/font-awesome.min.css',
        'css/simple-line-icons.min.css',
        'css/login.min.css',
//        'css/bootstrap-switch.min.css',
//        'css/leaflet.css',
//        'css/leaflet-measure.css',
//        'css/MarkerCluster.css',
        'css/components.min.css',
        'css/layout.css',
        'css/bootstrap.min.css',
//        'css/datatables.min.css',
//        'css/datatables.bootstrap.css',
        'css/light.min.css',

        'css/magnific-popup.css',
    ];
    public $js = [
        'js/core/jquery.min.js',
        'js/core/bootstrap.min.js',
        'js/core/js.cookie.min.js',
        'js/core/bootstrap-hover-dropdown.js',
        'js/core/jquery.slimscroll.min.js',
        'js/core/jquery.blockui.min.js',
        'js/core/bootstrap-switch.min.js',
        'js/login/jquery.validate.min.js',
        'js/login/additional-methods.min.js',
        'js/login/select2.full.min.js',
        'js/app.min.js',
        'js/login/login.min.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

}

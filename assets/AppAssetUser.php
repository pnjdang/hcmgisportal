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
class AppAssetUser extends AssetBundle {

    public $basePath = '@webroot/resources';
    public $baseUrl = '@web/resources';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        'css/global/font-awesome.min.css',
        'css/global/simple-line-icons.min.css',
        'css/global/bootstrap.min.css',
        'css/global/bootstrap-switch.min.css',
        'css/global/icheck.css',
        'css/global/components.min.css',
        'css/global/plugins.min.css',
        'css/user/layout.min.css',
        'css/user/default.min.css',
        'css/user/custom.min.css',
//        'css/user/search.min.css',
        'css/leaflet.css',
        //  'css/MarkerCluster.css',
        //   'css/leaflet-gplaces-autocomplete.css',
        'css/prunecluster.css',
        'css/bando.css',
    ];
    public $js = [
        'js/global/jquery.min.js',
        'js/global/bootstrap.min.js',
        'js/global/js.cookie.min.js',
        'js/global/bootstrap-hover-dropdown.js',
        'js/global/jquery.slimscroll.min.js',
        'js/global/jquery.blockui.min.js',
        'js/global/bootstrap-switch.min.js',
        'js/global/icheck.min.js',
        'js/global/form-icheck.min.js',
        'js/global/app.min.js',
        'js/profile.min.js',
//        'js/dashboard.min.js',
        'js/select2.full.min.js',
        'js/jquery.validate.min.js',
        'js/additional-methods.min.js',

        'js/jquery.bootstrap.wizard.min.js',

        'js/form-wizard.js',
        'js/user/layout.min.js',
        'js/demo.min.js',
        'js/quick-sidebar.min.js',
        'js/bootbox.min.js',
        'js/ui-function.js',
        'js/FileSaver.js',
        'js/jquery.wordexport.js',
        'js/leaflet/leaflet.js',
        // 'js/leaflet/leaflet.markercluster.js',
        //  'js/leaflet/esri-leaflet.js',

        'js/leaflet/prunecluster.js',
        'js/leaflet/jquery.geocomplete.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

}

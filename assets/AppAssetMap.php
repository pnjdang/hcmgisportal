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
class AppAssetMap extends AssetBundle {

    public $basePath = '@webroot/resources';
    public $baseUrl = '@web/resources';
    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD];
    public $css = [
        'css/font-awesome.min.css',
        'css/simple-line-icons.min.css',
//
//        'css/bootstrap-switch.min.css',
        'css/leaflet.css',
        'css/leaflet-measure.css',
        'css/MarkerCluster.css',
        'css/bootstrap.min.css',
        'css/global/icheck.css',
        'css/global/components.min.css',
        'css/layout.css',
        'css/leaflet-gplaces-autocomplete.css',
//        'css/datatables.min.css',
//        'css/datatables.bootstrap.css',
        'css/light.min.css',
        'css/leaflet-search.css',
        // 'css/leaflet-search.mobile.css',
        'css/magnific-popup.css',
    ];
    public $js = [
        'js/core/jquery.min.js',
        'js/core/bootstrap.min.js',
//        'js/core/js.cookie.min.js',
//        'js/core/bootstrap-hover-dropdown.js',
//        'js/core/jquery.slimscroll.min.js',
//        'js/core/jquery.blockui.min.js',
//        'js/core/bootstrap-switch.min.js',
        'js/morris.min.js',
//        'js/raphael-min.js',
        'js/leaflet/leaflet.js',
        'js/leaflet-measure.js',
        'js/leaflet/leaflet-raw-dem.min.js',
        'js/leaflet/leaflet.markercluster.js',
        'js/leaflet/esri-leaflet.js',
        'js/map.js',
        'js/global/icheck.min.js',
        'js/global/form-icheck.min.js',
        'js/app.min.js',
        'js/dashboard.min.js',
        'js/layout.min.js',
//        'js/demo.min.js',
        'js/quick-sidebar.min.js',
//        'js/datatables/datatable.js',
//        'js/datatables/datatables.min.js',
//        'js/datatables/datatables.bootstrap.js',
//        'js/bootstrap-datepicker.min.js',
//        'js/datatables/table-datatables-buttons.min.js',
///     Tìm kiếm
        // 'js/leaflet/leaflet-search-geocoder.js',
        //   'https://maps.googleapis.com/maps/api/js?key=AIzaSyD1BxwOmiV9GjwjsLQdIZkwMYQYAQwMo1U&callback=initMap',
        // 'js/leaflet/leaflet-gplaces-autocomplete.js',
        'js/leaflet/leaflet-gplaces-autocomplete.js',
        'js/leaflet/googleapi.js',
        'js/leaflet/leaflet-search.js',
        'js/bootbox.min.js',
        'js/jquery.slimscroll.js',
        'js/ui-function.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

}

<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetAdmin extends AssetBundle
{
    public $basePath = '@webroot/resources/';
    public $baseUrl = '@web/resources/';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
//        'css/site.css',

        'core/css/bootstrap.min.css',
        'admin/css/light.min.css',
        'admin/css/layout.css',
        'core/css/font-awesome.min.css',
        //'admin/css/lightbox.min.css',
        'core/css/components-md.css',
        'custom/custom.css',
    ];
    public $js = [
        'core/js/jquery.min.js',
        'core/js/bootstrap.min.js',
        'core/js/js.cookie.min.js',
        'core/js/app.min.js',
        //'admin/js/lightbox-plus-jquery.min.js',
        //'js/tinymce.min.js',

//        'core/js/jquery.slimscroll.min.js',
        'admin/js/layout.js',
        'admin/js/quick-sidebar.js',
        'core/js/ui-function.js',

    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}

<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\gisposts\assets;

use yii\web\AssetBundle;

class GispostsAsset extends AssetBundle
{
//    public $basePath = '@webroot/resources/';
//    public $baseUrl = '@web/resources/';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $sourcePath = '@app/modules/gisposts/assets';

    public $css = [
        'css/font-awesome.min.css',
        'css/bootstrap.min.css',
        'css/components.min.css',
        'css/light.min.css',
//        'css/magnific-popup.css',
//        'css/style.css',
//        'css/responsive.css',
//        'css/colors.css',
        'css/default.css',
        'css/layout.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/app.js',
        'js/layout.js',
//        'js/demo.js',
        'js/quick-sidebar.js',
//        'js/FileSaver.js',
//        'js/jquery.wordexport.js',
//        'js/util-function.js',
//        'js/ui-function.js'
    ];
//    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//    ];
}

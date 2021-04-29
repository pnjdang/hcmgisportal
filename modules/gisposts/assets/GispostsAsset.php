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
    public $basePath = '@webroot/resources/';
    public $baseUrl = '@web/resources/';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

//    public $sourcePath = '@app/module/gisposts/';

    public $css = [
        'css/font-awesome.css',
        'css/bootstrap.min.css',
        'css/components.min.css',
//        'css/magnific-popup.css',
//        'css/style.css',
        'css/responsive.css',
        'css/colors.css',
        'css/animate.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
//        'js/jquery.magnific-popup.min.js',
//        'js/FileSaver.js',
//        'js/jquery.wordexport.js',
//        'js/util-function.js',
        'js/ui-function.js'
    ];
//    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//    ];
}

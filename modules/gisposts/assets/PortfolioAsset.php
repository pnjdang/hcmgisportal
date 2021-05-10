<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\gisposts\assets;

use yii\web\AssetBundle;

class PortfolioAsset extends AssetBundle
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
//        'css/auth/bootstrap.min.css',
//        'css/auth/login.css',
//        'css/auth/utils.css',
        'css/default.css',
        'css/layout.css',
        'css/portfolio/cubeportfolio.css',
        'css/portfolio/portfolio.css',

    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/app.js',
        'js/layout.js',
        'js/jquery.cubeportfolio.min.js',
        'js/portfolio-1.min.js',
        'js/quick-sidebar.js',
        'js/utils.js',
    ];
}

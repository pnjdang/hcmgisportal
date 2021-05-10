<?php

require_once(__DIR__ . '/functions.php');
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'forceCopy' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => []
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => []
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'hcmgis',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\gisposts\models\auth\Taikhoan',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                [
                    'pattern' => 'tin-tuc/<page:\d+>',
                    'route' => 'tin-tuc/index',
                    'defaults' => ['page' => 1,],
                ],
                '<alias:lien-he|gioi-thieu>' => 'site/<alias>',
//                '<controller:[\w\d\-]+>/<action:[\w\d\-]+>' => '<controller>/<action>',
                'tin-tuc/<alias:[\w\d\-]+>' => 'tin-tuc/view',
                'tu-lieu/<alias:[\w\d\-]+>' => 'tu-lieu/view',
                'san-pham/<alias:[\w\d\-]+>' => 'san-pham/view',
                'san-pham' => 'san-pham/index',
//                '<controller:tin-tuc|phong-thi-nghiem|to-chuc-khcn|doanh-nghiep-khcn>/<alias:[\w\d\-]+>/<action:[\w\d\-]+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'cms' => [
            'class' => 'app\modules\gisposts\GisPosts',
            'defaultRoute' => 'site'
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    $config['modules']['gridview'] = [
        'class' => 'kartik\grid\Module',
    ];
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],
        'generators' => [
            'DCrud' => [
                'class' => 'app\modules\DCrud\generators\Generator',
//                'templates' => [
//                    'my' => '@app/myTemplates/crud/default',
//                ]
            ]
        ],
    ];
}

return $config;

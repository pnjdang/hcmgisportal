<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/8/2017
 * Time: 3:41 PM
 */
namespace app\controllers\base;

use app\services\UtilityService;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;

class AbstractAdminController extends Controller
{
    public function behaviors()
    {
        $this->layout = "@app/views/layouts/admin/main";
        
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
                            'login','logout', 'index','thongtincanhan','map','changepass','search','signup','test',
                        ], // add all actions to take guest to login page
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
}
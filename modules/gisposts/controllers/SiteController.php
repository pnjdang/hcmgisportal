<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/29/2021
 * Time: 11:46 PM
 */

namespace app\modules\gisposts\controllers;


use app\modules\gisposts\base\AbstractController;

class SiteController extends AbstractController
{
    public function actionIndex(){
        return $this->render('index');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/29/2021
 * Time: 11:46 PM
 */

namespace app\modules\gisposts\controllers;


use app\modules\gisposts\base\AbstractController;
use app\modules\gisposts\models\auth\LoginForm;
use app\services\DebugService;
use Yii;

class AuthController extends AbstractController
{
    public function actionLogin(){
        $this->layout = "@app/modules/gisposts/views/layouts/login";
        $request = \Yii::$app->request;
        $model = new LoginForm();

        if($model->load($request->post()) && $model->login()){
            return $this->redirect(Yii::$app->urlManager->createUrl('cms/site/index'));
        }
        return $this->render('login',[
            'model' => $model
        ]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->redirect(Yii::$app->urlManager->createUrl('cms/auth/login'));
    }
}
<?php

namespace app\controllers;

use app\models\ForgetpassForm;
use app\modules\gisposts\models\LienHe;
use app\models\SignupForm;
use app\modules\gisposts\models\media\MainBanner;
use app\modules\gisposts\models\posts\GisPosts;
use app\services\DebugService;
use app\services\UtilityService;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\base\BaseObject;
use yii\web\User;

//use app\services\UtilsService;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model['banner'] = MainBanner::find()->where(['banner_status' => true])->orderBy('uploaded_at desc')->one();
        return $this->render('index',[
            'model' => $model
        ]);
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function actionLienHe()
    {
        date_default_timezone_set('Asia/Ho_chi_minh');
        $request = Yii::$app->request;
        $model = new LienHe();
        $model->created_at = date("Y-m-d H:i:s");

        if ($request->isPost && $model->load($request->post()) && $model->save()) {
            UtilityService::alert('success');
            return $this->redirect($request->referrer);
        }

        return $this->render('lienhe', ['model' => $model]);
    }

    /**
     * Gioithieu about page.
     *
     * @return string
     */
    public function actionGioiThieu()
    {
        date_default_timezone_set('Asia/Ho_chi_minh');
        $request = Yii::$app->request;
        $model = new LienHe();
        $model->created_at = date("Y-m-d H:i:s");

        if ($request->isPost && $model->load($request->post()) && $model->save()) {
            UtilityService::alert('success');
            return $this->redirect($request->referrer);
        }

        return $this->render('gioithieu', ['model' => $model]);
    }
}

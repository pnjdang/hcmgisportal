<?php

namespace app\controllers;

use app\controllers\base\AbstractTlkhcnController;
use app\models\ChuyenGia;
use app\models\ChuyengiaCongtac;
use app\models\ChuyengiaCongtrinh;
use app\models\ChuyengiaDaotao;
use app\models\ChuyengiaDetai;
use app\models\ChuyengiaNgoaingu;
use app\models\DoituongPhucvu;
use app\models\DschuyengiaSearch;
use app\models\ForgetpassForm;
use app\models\LienHe;
use app\models\LinhvucThunghiem;
use app\models\PhongThiNghiem;
use app\models\PhongthinghiemSearch;
use app\models\SignupForm;
use app\models\TaiKhoan;
use app\models\TkChuyengia;
use app\models\TkPtnQuanhuyen;
use app\models\VChuyengia;
use app\models\GisPosts;
use app\services\DebugService;
use app\services\UtilityService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\base\BaseObject;
use yii\web\User;
//use app\services\UtilsService;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
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
        //$this->layout = "@app/views/layouts/user/main_user";
        return $this->render('index');
    }
    
    public function actionError()
    {
        return $this->render('error');
    }

    public function actionLienhe()
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
    public function actionGioithieu()
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
    
    /**
     * sanpham about page.
     *
     * @return string
     */
    public function actionSanpham()
    {
        $model['hcmgis'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type'=>'hcmgis'])->orderBy(['menu_order'=> SORT_ASC])->all();
        $model['sanpham'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type'=>'product'])->orderBy(['post_modified'=> SORT_DESC])->all();
        $model['tool'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type'=>'tool'])->orderBy(['post_modified'=> SORT_DESC])->all();
        //DebugService::dumpdie($model['hcmgis']);
        return $this->render('sanpham',['model' => $model]);
    }
    
    /**
     * Tulieu about page.
     *
     * @return string
     */
    public function actionTulieu()
    {
        $model['tailieu'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type'=>'doc'])->orderBy(['post_modified'=> SORT_DESC])->all();
        $model['hinhanh'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type'=>'pic'])->orderBy(['post_modified'=> SORT_DESC])->all();
        return $this->render('tulieu',['model' => $model]);
    }
    
    /**
     * Tintuc about page.
     *
     * @return string
     */
    public function actionTintuc()
    {
        $model['baiviet'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type' => 'post'])->orderBy(['post_date'=> SORT_DESC])->all();
       // DebugService::dumpdie($model['baiviet']);
        return $this->render('tintuc',['model' => $model['baiviet']]);
    }
    
    /**
     * Noidung about page.
     *
     * @return string
     */
    public function actionNoidung($id)
    {
        $request = Yii::$app->request;
        $model['baiviet'] = GisPosts::findOne($id);
        //DebugService::dumpdie($model['baiviet']);
        //dd($model['baiviet']);
        
    return $this->render('noidung',['model' => $model['baiviet']]);
    }
    
    

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = "@app/views/layouts/user/main_user";
        $request = Yii::$app->request;
        if (!Yii::$app->user->isGuest) {
            //DebugService::dumpdie(Yii::$app->user);
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($request->isPost) {
            $model->load($request->post());
            
            if (!$model->checkUsername()) {
                UtilityService::alert('error_username');
                return $this->redirect(Yii::$app->urlManager->createUrl('site/login'));
            } elseif (!$model->checkPassword()) {
                UtilityService::alert('error_password');
                return $this->redirect(Yii::$app->urlManager->createUrl('site/login'));
            } else {
                $model->login();
//                Yii::$app->user->login($model->getUser(), $model->rememberMe ? 3600 * 24 * 30 : 0);
                return $this->goBack();
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        DebugService::dumpdie(Yii::$app->user->isGuest);    
        return $this->redirect(Yii::$app->urlManager->createUrl('site/login'));
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    public function actionSignup()
    {
        $this->layout = "@app/views/layouts/user/main_user";
        $model = new SignupForm();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {

            if ($model->signup()) {
                UtilityService::alert('dangkythanhcong');
                return $this->redirect(Yii::$app->urlManager->createUrl('site/login'));
            } else {
                return $this->render('signup', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionForgetpass(){
        $this->layout = "@app/views/layouts/user/main_user";
        $model = new ForgetpassForm();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {

            if ($model->sendrequest()) {
                UtilityService::alert('dangkythanhcong');
                return $this->redirect(Yii::$app->urlManager->createUrl('site/login'));
            } else {
                return $this->render('signup', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('forgetpass',[
            'model' => $model,
        ]);

    }



}

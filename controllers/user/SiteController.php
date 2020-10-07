<?php

namespace app\controllers\user;

use app\controllers\base\AbstractTlkhcnController;
use app\controllers\base\AbstractUserController;
use app\models\chuyengia\ChuyenGia;
use app\models\DschuyengiaSearch;
use app\models\ForgetpassForm;
use app\models\LienHe;
use app\models\LinhvucThunghiem;
use app\models\phongthinghiem\PhongThiNghiem;
use app\models\PhongthinghiemSearch;
use app\models\SignupForm;
use app\models\TaiKhoan;
use app\models\TkChuyengia;
use app\models\TkPtnQuanhuyen;
use app\models\VChuyengia;
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
use app\services\UtilsService;

class SiteController extends AbstractUserController
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
        $this->layout = "@app/views/layouts/user/main_user";
        $chuyengia = ChuyenGia::find()->where(['status' => 1])->count();
        $ptn = PhongThiNghiem::find()->where(['status' => 1])->count();
        return $this->render('index', ['chuyengia' => $chuyengia, 'ptn' => $ptn]);
    }

    public function actionLienhe()
    {
        date_default_timezone_set('Asia/Ho_chi_minh');
        $this->layout = "@app/views/layouts/user/main_user";
        $request = Yii::$app->request;
        $lien_he = new LienHe();
        $lien_he->created_at = date("Y-m-d H:i:s");
        //$lien_he->created_by = $request->ho_ten;

        if ($request->isPost && $lien_he->load($request->post()) && $lien_he->save()) {
            UtilsService::pushMessage(UtilsService::$_M_SUCCESS, 'Gửi thông tin thành công!');
            UtilityService::alert('success');
            return $this->redirect($request->referrer);
        }

        return $this->render('lienhe', ['lien_he' => $lien_he]);

    }

    public function actionTongquan()
    {
        $this->layout = "@app/views/layouts/main_chart";
        $chuyengia = ChuyenGia::find()->count();
        $ptn = PhongThiNghiem::find()->count();
        $taikhoan = TaiKhoan::find()->where(['admin' => false])->count();
        $tkchuyengia = TkChuyengia::find()->select('ten_lvql,sl_chuyengia')->asArray()->orderBy('ten_lvql')->all();
        $tkptnqh = TkPtnQuanhuyen::find()->select('quan_huyen, sl_ptn')->asArray()->orderBy('quan_huyen')->all();


        return $this->render('tongquan', [
            'chuyengia' => $chuyengia,
            'ptn' => $ptn,
            'tkchuyengia' => $tkchuyengia,
            'tkptnqh' => $tkptnqh,
            'taikhoan' => $taikhoan,
        ]);
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
                Yii::$app->user->login($model->getUser(), $model->rememberMe ? 3600 * 24 * 30 : 0);
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays map page.
     *
     * @return string
     */
    public function actionMap()
    {
        $this->layout = "@app/views/layouts/layout_map";
        return $this->render('map');
    }

    public function actionSearch()
    {
        // DebugService::dumpdie(Yii::$app->request->post());
        $post = Yii::$app->request->post();
        // $chuyengia = " ho_ten like '%" . mb_strtoupper($post['ho_ten']) . "%'";
        if ($post['chon_lop'] == 1) {
            return $this->redirect(Yii::$app->homeUrl . 'site/map?key=1=1%20and%20ho_ten%20like%20%27%25' . mb_strtoupper($post['ho_ten']) . '%25%27');
        }
        if ($post['chon_lop'] == 0) {
            return $this->redirect(Yii::$app->homeUrl . 'site/map?key=1=1%20and%20ten_tv%20like%20%27%25' . mb_strtoupper($post['ho_ten']) . '%25%27or%20ten_ta%20like%20%27%25' . mb_strtoupper($post['ho_ten']) . '%25%27');
        }
    }

    public function actionTest()
    {
        for($i = 1; $i <= 568;$i++){
            $chuyengia_congtrinh = new ChuyengiaDetai();
            $chuyengia_congtrinh->id_chuyengiadetai = $i + 806;
            $chuyengia_congtrinh->vai_tro = 2;
            $chuyengia_congtrinh->save();
        }
//        return $this->render('test', ['model' => $model]);
    }



    public function actionSignup()
    {
        $this->layout = "@app/views/layouts/user/main_user";
        $model = new SignupForm();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {

            if ($model->signup()) {
                UtilityService::alert('dangkythanhcong');
                return $this->redirect(Yii::$app->urlManager->createUrl('dang-nhap'));
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
                return $this->redirect(Yii::$app->urlManager->createUrl('dang-nhap'));
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

    public function actionChinhsach(){
        $this->layout = "@app/views/layouts/user/main_user";
        return $this->render('chinhsach');
    }

}

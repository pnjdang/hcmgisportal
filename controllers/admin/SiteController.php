<?php

namespace app\controllers\admin;

use app\controllers\base\AbstractAdminController;
use app\models\chuyengia\ChuyenGia;
use app\models\danhmuc\chuyengia\nhomdonvi\Nhomdonvi;
use app\models\danhmuc\phongthinghiem\linhvucthunghiem\LinhvucThunghiem;
use app\models\LienHe;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap1\LinhvucnghiencuuCap1;
use app\models\ForgetpassForm;
use app\models\phongthinghiem\PhongThiNghiem;
use app\models\SearchLienhe;
use app\models\SignupForm;
use app\models\TaiKhoan;
use app\models\thongke\phongthinghiem\TkPtnLinhvuc;
use app\models\TkChuyengia;
use app\models\TkPtnQuanhuyen;
use app\models\VChuyengia;
use app\services\DbService;
use app\services\DebugService;
use app\services\UtilityService;
use Yii;
use app\models\LoginForm;
use app\models\ContactForm;
use app\services\UtilsService;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class SiteController extends AbstractAdminController
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
        $this->layout = "@app/views/layouts/main_chart";
        
        return $this->render('index', [
//            'chuyengia' => $chuyengia,
            'ptn' => 1,
        ]);
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

    public function actionInbox()
    {
        $searchModel = new SearchLienhe();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('inbox', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReply($id = null){
        $request = \Yii::$app->request;
        $model['lienhe'] = LienHe::findOne($id);

        if($request->isPost){
            $model['lienhe']->load($request->post());
            $model['lienhe']->save();
            return $this->redirect($request->referrer);
        }

        return $this->renderPartial('reply',[
            'model' => $model,
        ]);

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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Yii::$app->urlManager->createUrl('trang-chu'));
    }

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

}

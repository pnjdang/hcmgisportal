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

class AbstractUserController extends Controller
{
    public function behaviors()
    {
        $this->layout = "@app/views/layouts/user/main_user";

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','index','lienhe','view','viewptn','map','search','chinhsach','phongthinghiem-geojson','list-phongthinghiem','phongthinghiem-get'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
                            'login','logout', 'index','thongtincanhan','map','changepass','search','signup','test','danhsach','review','chinhsach',
                            'phongthinghiem-geojson','list-phongthinghiem','phongthinghiem-get',
                            //UserController
                            'userviewchuyengia','usercreatepdkchuyengia','userreportchuyengia','createpdkchuyengia','updatepdkchuyengia','userviewpdkchuyengia',
                            'userviewphongthinghiem','usercreatepdkphongthinghiem','userreportphongthinghiem','createpdkphongthinghiem','updatepdkphongthinghiem',
                            'userthietbi','usercreatethietbi','userlistthietbi','userdeletethietbi','userupdatethietbi',
                            'usersohuutritue','usercreatesohuutritue','userlistsohuutritue','userdeletesohuutritue','userupdatesohuutritue',
                            'previewphongthinghiem','nopphieudangkyptn','userviewpdkphongthinghiem','userupdatepdkphongthinghiem',
                            'searchthietbi','preview','viewpdk','congbo',
                            'userchuyengiaindex','userchuyengiatable',
                            'create','view','update','delete','copy','viewmap','upload','quanlytaikhoan','updatetaikhoan','restoretaikhoan','viewptn',
                            'updatepdk',
                            'userchuyengia','userphongthinghiem','trangchu','lienhe','ptnsearch','createchuyengia','createphongthinghiem','viewchuyengia','viewphongthinghiem','_table_cg',

                            //DangkyController
                            'phongthinghiem','chuyengia','reply',
                            'danhsachchuyengia','kiemduyetchuyengia','danhsachphongthinghiem','kiemduyetphongthinghiem',
                            'reportchuyengia','reportphongthinghiem','taikhoan','danhsachdangky',
                            'updatechuyengia','updatephongthinghiem','inbox',
                            'sohuutritue','createsohuutritue','updatesohuutritue','deletesohuutritue',
                            'thietbithunghiem','createthietbithunghiem','updatethietbithunghiem','deletethietbithunghiem',
                            'import','linhvuc','linhvucchitiet','chuyennganh','chuyennganhchitiet',
                            //chuyengia
                            'congtrinh','daotao','ngoaingu','congtac','detai','export','exportexcel',
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
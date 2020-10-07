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

class AbstractTlkhcnController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','index','lienhe','view','map','search'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
                            'login','logout', 'index','thongtincanhan','map','changepass','search','signup','test',
                            //AdminController
                            'tongquan','report','reportcheck',
                            'reportphongthinghiem','checkphongthinghiem',
                            'reportchuyengia','checkchuyengia',
                            //
                            //UserController
                            'userviewchuyengia','usercreatepdkchuyengia','userreportchuyengia','createpdkchuyengia','updatepdkchuyengia','userviewpdkchuyengia',
                            'userviewphongthinghiem','usercreatepdkphongthinghiem','userreportphongthinghiem','createpdkphongthinghiem','updatepdkphongthinghiem',
                            'userthietbi','usercreatethietbi','userlistthietbi','userdeletethietbi','userupdatethietbi',
                            'usersohuutritue','usercreatesohuutritue','userlistsohuutritue','userdeletesohuutritue','userupdatesohuutritue',
                            'previewphongthinghiem','nopphieudangkyptn','userviewpdkphongthinghiem','userupdatepdkphongthinghiem',
                            'searchthietbi','preview','viewpdk',
                            'userchuyengiaindex','userchuyengiatable',
                            'create','view','update','delete','copy','viewmap','upload','quanlytaikhoan','updatetaikhoan','restoretaikhoan',
                            'updatepdk','viewptn',
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
                            'congtrinh','daotao','ngoaingu','congtac','detai',
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
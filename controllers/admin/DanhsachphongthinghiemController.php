<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 11/22/2017
 * Time: 4:33 PM
 */

namespace app\controllers\admin;

use app\controllers\base\AbstractTlkhcnController;
use app\models\danhmuc\phongthinghiem\linhvucthunghiem\LinhvucThunghiem;
use app\models\phongthinghiem\PhongthinghiemLinhvuc;
use app\models\phongthinghiem\SearchPhongthinghiem;
use app\models\phongthinghiem\SearchPhongthinghiemLinhvuc;
use app\services\UtilityService;
use Yii;

class DanhsachphongthinghiemController extends AbstractTlkhcnController
{

    public function actionIndex(){
        $searchModel = new SearchPhongthinghiem();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLinhvuc(){

        $model['linhvucthunghiem'] = LinhvucThunghiem::find()->where(['status' => 1])->orderBy('ten_lv')->all();
        foreach($model['linhvucthunghiem'] as $i => $linhvucthunghiem){
            $model['soluong'][$i] = PhongthinghiemLinhvuc::find()->where(['lv_id' => $linhvucthunghiem->id_lv])->count();
        }
        return $this->render('linhvuc',[
            'model' => $model
        ]);
    }

    public function actionLinhvucchitiet($id = null){
        if (!UtilityService::paramValidate($id)) {
            return $this->redirect(\Yii::$app->urlManager->createUrl('admin/danhsachphongthinghiem/linhvuc'));
        }
        $model['linhvucthunghiem'] = LinhvucThunghiem::findOne($id);
        $searchModel = new SearchPhongthinghiemLinhvuc();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);


        return $this->render('linhvucchitiet', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model
        ]);
    }
}
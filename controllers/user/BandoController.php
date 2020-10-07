<?php

namespace app\controllers\user;

use app\controllers\base\AbstractUserController;
use app\services\MapService;
use app\services\SecurityService;
use yii\web\Controller;

/**
 * Description of BandoController
 *
 * @author TriLVH
 */
class BandoController extends AbstractUserController {

    public function actionIndex() {
        $this->layout = "@app/views/layouts/user/user_map";
        return $this->render("bando-tiemluc");
    }

    public function actionPhongthinghiemGeojson() {
     
        if (SecurityService::checkCurrentUserCanAccessPhongthinghiemGeojson()) {
            $list_Phongthinghiem = MapService::getListPhongthinghiemGeojson();
            return json_encode($list_Phongthinghiem);
        }
        return json_encode(['errors' => ['Thao tác không cho phép']]);
    }

    public function actionListPhongthinghiem() {
      
        $models = [];
        $q = \Yii::$app->request->get('q', null);
        if (SecurityService::checkCurrentUserCanAccessListPhongthinghiem()) {
            $models = MapService::getListPhongthinghiem($q);
        }
        return $this->renderPartial("_list-phongthinghiem", $models);
    }

    public function actionPhongthinghiemGet() {
       
        $slug = \Yii::$app->request->get('slug', null);
        if (SecurityService::checkCurrentUserCanAccessListPhongthinghiem()) {
            $model = MapService::getPhongthinghiem($slug);
        }
        return $this->renderPartial("_item-phongthinghiem", ["model" => $model]);
    }

}

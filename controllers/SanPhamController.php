<?php

namespace app\controllers;


//use app\services\UtilsService;

use app\modules\gisposts\models\posts\GisPosts;
use app\services\DebugService;
use yii\base\Controller;
use yii\data\Pagination;

class SanPhamController extends Controller
{
    public function actionIndex()
    {
        $model['hcmgis'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type' => 'hcmgis'])->orderBy(['menu_order' => SORT_ASC])->all();
        $model['sanpham'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type' => 'product'])->orderBy(['post_modified' => SORT_DESC])->all();
        $model['tool'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type' => 'tool'])->orderBy(['post_modified' => SORT_DESC])->all();
        //DebugService::dumpdie($model['hcmgis']);
        return $this->render('index', ['model' => $model]);
//
//        $query = GisPosts::find()->where(['post_status' => '1'])->where(['post_type' => 'hcmgis'])->orderBy(['post_date' => SORT_DESC]);
//        $count = $query->count();
//        $pagination = new Pagination(['totalCount' => $count,'pageSize' => 10]);
//        $posts = $query->offset($pagination->offset)
//            ->limit($pagination->limit)
//            ->all();
//        return $this->render('index',[
//            'posts' => $posts,
//            'pagination' => $pagination,
//        ]);
    }

    public function actionView(){
        $get = \Yii::$app->request->get();
        $model = GisPosts::findOne(['post_name' => $get['alias']]);
        if($model == null){
            return $this->render('notfound');
        }
        return $this->render('view',[
            'model' => $model
        ]);
    }
}

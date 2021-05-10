<?php

namespace app\controllers;


//use app\services\UtilsService;

use app\modules\gisposts\models\posts\GisPosts;
use app\services\DebugService;
use yii\base\Controller;
use yii\data\Pagination;

class TuLieuController extends Controller
{
    public function actionIndex()
    {
        $query['doc'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type' => 'doc'])->orderBy(['post_date' => SORT_DESC]);
        $count['doc'] = $query['doc']->count();
        $pagination['doc'] = new Pagination(['totalCount' => $count['doc']]);
        $posts['doc'] = $query['doc']->offset($pagination['doc']->offset)
            ->limit($pagination['doc']->limit)
            ->all();

        $query['pic'] = GisPosts::find()->where(['post_status' => '1'])->where(['post_type' => 'pic'])->orderBy(['post_date' => SORT_DESC]);
        $count['pic'] = $query['pic']->count();
        $pagination['pic'] = new Pagination(['totalCount' => $count['pic']]);
        $posts['pic'] = $query['pic']->offset($pagination['pic']->offset)
            ->limit($pagination['pic']->limit)
            ->all();


        return $this->render('index',[
            'posts' => $posts,
            'pagination' => $pagination,
        ]);
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

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\services;


use app\models\VPhongthinghiem;
use yii\data\Pagination;
use function mb_strtoupper;

/**
 * Description of PhongthinghiemService
 *
 * @author TriLVH
 */
class MapService {

    public static function getListPhongthinghiemGeojson() {
        $listPhongthinghiem = VPhongthinghiem::find();
        $listPhongthinghiem->where('geo_x is not null and geo_y is not null');
        return $listPhongthinghiem->select(['id_ptn as id', 'geo_x', 'geo_y'])->asArray()->all();
    }

    public static function getPhongthinghiem($slug) {
        $model = VPhongthinghiem::find()->where(['id_ptn' => $slug])->asArray()->one();
        return $model;
    }

    public static function getListPhongthinghiem($q = null) {
        $query = VPhongthinghiem::find();
        
        if ($q != null) {
            $q = mb_strtoupper($q, 'UTF-8');
            $query->orWhere(['like', 'upper(ten_ta)', $q]);
            $query->orWhere(['like', 'upper(ten_tv)', $q]);
            $query->orWhere(['like', 'upper(dia_chi)', $q]);
        }
       
        $countQuery = clone $query;
        $totalcount = $countQuery->count();
        $pages = new Pagination(['totalCount' => $totalcount]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return ['pages' => $pages, 'models' => $models, 'totalcount' => $totalcount];
    }

}

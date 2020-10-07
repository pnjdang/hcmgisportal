<?php

namespace app\services;


class SecurityService {
    public static function checkUserCanAccess($actioname, $userid) {
        return true;
    }
    
    public static function checkCurrentUserCanAccess($actioname) {
        return self::checkUserCanAccess($actioname);
    }
    
    public static function checkUserCanAccessPhongthinghiemGeojson($userid) {
        return true;
    }
    
    public static function checkCurrentUserCanAccessPhongthinghiemGeojson() {
        return self::checkUserCanAccessPhongthinghiemGeojson(\Yii::$app->user->id);
    }
    
    public static function checkCurrentUserCanAccessListPhongthinghiem() {
        return true;
    }
}
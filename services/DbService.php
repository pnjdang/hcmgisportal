<?php

namespace app\services;

use DateTime;
use Yii;

/**
 * All utils function for website
 * @author TriLVH
 */
class DbService {

    public static function cloneQuery($query){
        $new_query = clone $query;
        return $new_query;
    }
}

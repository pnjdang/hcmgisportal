<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 6/9/2020
 * Time: 8:55 AM
 */

namespace app\modules\gisposts;

/**
 * accounts module definition class
 */
class GisPosts extends \yii\base\Module
{
    public $controllerPrefix;
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->controllerPrefix = 'quan-ly-can';
        parent::init();

        // custom initialization code goes here
    }
}
<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "thiet_bi".
 *
 * @property integer $id_thietbithunghiem
 *
 * @property PhongthinghiemThietbi[] $phongthinghiemThietbis
 */
class Search extends Model
{

    public $id_thietbithunghiem;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'search';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_thietbithunghiem'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_thietbithunghiem' => 'Id Thietbithunghiem',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

}

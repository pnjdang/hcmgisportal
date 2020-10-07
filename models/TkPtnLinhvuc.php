<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tk_ptn_linhvuc".
 *
 * @property string $ten_lv
 * @property string $sl_ptn
 */
class TkPtnLinhvuc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tk_ptn_linhvuc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sl_ptn'], 'integer'],
            [['ten_lv'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ten_lv' => 'Ten Lv',
            'sl_ptn' => 'Sl Ptn',
        ];
    }
}

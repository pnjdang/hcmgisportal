<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tk_ptn_quanhuyen".
 *
 * @property string $sl_ptn
 * @property string $quan_huyen
 */
class TkPtnQuanhuyen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tk_ptn_quanhuyen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sl_ptn'], 'integer'],
            [['quan_huyen'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sl_ptn' => 'Sl Ptn',
            'quan_huyen' => 'Quan Huyen',
        ];
    }
}

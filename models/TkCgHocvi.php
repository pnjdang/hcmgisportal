<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tk_cg_hocvi".
 *
 * @property string $ghi_chu
 * @property string $sl_cg
 */
class TkCgHocvi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tk_cg_hocvi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sl_cg'], 'integer'],
            [['ghi_chu'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ghi_chu' => 'Ghi Chu',
            'sl_cg' => 'Sl Cg',
        ];
    }
}

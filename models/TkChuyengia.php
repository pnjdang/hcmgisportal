<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tk_chuyengia".
 *
 * @property string $sl_chuyengia
 * @property integer $id_lvql
 * @property string $ten_lvql
 */
class TkChuyengia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tk_chuyengia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sl_chuyengia', 'id_lvql'], 'integer'],
            [['ten_lvql'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sl_chuyengia' => 'Sl Chuyengia',
            'id_lvql' => 'Id Lvql',
            'ten_lvql' => 'Ten Lvql',
        ];
    }
}

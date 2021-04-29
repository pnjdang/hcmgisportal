<?php

namespace app\modules\quanly\models;

use Yii;

/**
 * This is the model class for table "v_duong".
 *
 * @property string $ten_duong
 */
class VDuong extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_duong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_duong'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ten_duong' => 'Ten Duong',
        ];
    }
}

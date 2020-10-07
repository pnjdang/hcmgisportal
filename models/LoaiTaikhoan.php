<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loai_taikhoan".
 *
 * @property integer $id_loaitk
 * @property string $ten_loaitk
 * @property string $ghi_chu
 */
class LoaiTaikhoan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loai_taikhoan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_loaitk'], 'string', 'max' => 100],
            [['ghi_chu'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_loaitk' => 'Id Loaitk',
            'ten_loaitk' => 'Ten Loaitk',
            'ghi_chu' => 'Ghi Chu',
        ];
    }
}

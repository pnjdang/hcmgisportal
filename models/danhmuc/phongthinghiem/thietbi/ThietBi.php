<?php

namespace app\models\danhmuc\phongthinghiem\thietbi;

use Yii;

/**
 * This is the model class for table "thiet_bi".
 *
 * @property integer $id_tb
 * @property string $hang_sx
 * @property string $dac_tinh
 * @property string $tinh_trang
 * @property string $ghi_chu
 * @property string $ten_tb
 *
 * @property PhongthinghiemThietbi[] $phongthinghiemThietbis
 */
class ThietBi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thiet_bi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hang_sx', 'dac_tinh', 'tinh_trang', 'ghi_chu', 'ten_tb'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tb' => 'Id Tb',
            'hang_sx' => 'Hãng/Model/Năm sản xuất',
            'dac_tinh' => 'Đặc tính kỹ thuật',
            'tinh_trang' => 'Tình trạng',
            'ghi_chu' => 'Ghi chú',
            'ten_tb' => 'Tên thiết bị',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemThietbis()
    {
        return $this->hasMany(PhongthinghiemThietbi::className(), ['id_tb' => 'id_tb']);
    }
}

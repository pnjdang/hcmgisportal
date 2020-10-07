<?php

namespace app\models\export\chuyengia;

use Yii;

/**
 * This is the model class for table "v_export_chuyengia".
 *
 * @property string $ho_ten
 * @property integer $nam_sinh
 * @property string $gioi_tinh
 * @property string $congviec_hiennay
 * @property string $chucvu_hientai
 * @property string $diachi_nharieng
 * @property string $dien_thoai
 * @property string $email
 * @property string $ten_hh
 * @property integer $nam_hocham
 * @property string $ten_hv
 * @property integer $nam_hocvi
 * @property string $ten_donvi
 * @property string $linhvuc
 * @property string $chuyennganh
 * @property string $rownum
 * @property string $ten_khongdau
 * @property integer $hocham_id
 * @property integer $hocvi_id
 * @property integer $donvi_id
 */
class VExportChuyengia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_export_chuyengia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ho_ten', 'gioi_tinh', 'congviec_hiennay', 'chucvu_hientai', 'diachi_nharieng', 'dien_thoai', 'email', 'ten_hh', 'ten_hv', 'ten_donvi', 'linhvuc', 'chuyennganh', 'ten_khongdau'], 'string'],
            [['nam_sinh', 'nam_hocham', 'nam_hocvi', 'rownum', 'hocham_id', 'hocvi_id', 'donvi_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ho_ten' => 'Ho Ten',
            'nam_sinh' => 'Nam Sinh',
            'gioi_tinh' => 'Gioi Tinh',
            'congviec_hiennay' => 'Congviec Hiennay',
            'chucvu_hientai' => 'Chucvu Hientai',
            'diachi_nharieng' => 'Diachi Nharieng',
            'dien_thoai' => 'Dien Thoai',
            'email' => 'Email',
            'ten_hh' => 'Ten Hh',
            'nam_hocham' => 'Nam Hocham',
            'ten_hv' => 'Ten Hv',
            'nam_hocvi' => 'Nam Hocvi',
            'ten_donvi' => 'Ten Donvi',
            'linhvuc' => 'Linhvuc',
            'chuyennganh' => 'Chuyennganh',
            'rownum' => 'Rownum',
            'ten_khongdau' => 'Ten Khongdau',
            'hocham_id' => 'Hocham ID',
            'hocvi_id' => 'Hocvi ID',
            'donvi_id' => 'Donvi ID',
        ];
    }
}

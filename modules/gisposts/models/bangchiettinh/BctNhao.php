<?php

namespace app\modules\quanly\models\bangchiettinh;

use Yii;

/**
 * This is the model class for table "bct_nhao".
 *
 * @property integer $id_bctnhao
 * @property integer $id_bct
 * @property integer $don_gia
 * @property string $dien_tich
 * @property string $k2
 * @property string $k3
 * @property string $k4
 * @property string $ghi_chu_bctnhao
 * @property string $cap_nha
 * @property integer $so_tien
 * @property string $tu_ngay
 * @property string $loai_nha
 * @property integer $so_tien_le
 */
class BctNhao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bct_nhao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bct', 'don_gia', 'so_tien', 'so_tien_le'], 'integer'],
            [['dien_tich', 'k2', 'k3', 'k4'], 'number'],
            [['tu_ngay'], 'safe'],
            [['ghi_chu_bctnhao'], 'string', 'max' => 500],
            [['cap_nha'], 'string', 'max' => 20],
            [['loai_nha'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bctnhao' => 'Id Bctnhao',
            'id_bct' => 'Id Bct',
            'don_gia' => 'Don Gia',
            'dien_tich' => 'Dien Tich',
            'k2' => 'K2',
            'k3' => 'K3',
            'k4' => 'K4',
            'ghi_chu_bctnhao' => 'Ghi Chu Bctnhao',
            'cap_nha' => 'Cap Nha',
            'so_tien' => 'So Tien',
            'tu_ngay' => 'Tu Ngay',
            'loai_nha' => 'Loai Nha',
            'so_tien_le' => 'So Tien Le',
        ];
    }
}

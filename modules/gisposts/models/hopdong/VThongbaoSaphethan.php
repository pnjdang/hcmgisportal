<?php

namespace app\modules\quanly\models\hopdong;

use Yii;

/**
 * This is the model class for table "v_thongbao_saphethan".
 *
 * @property int|null $id_hopdong
 * @property string|null $so_hop_dong
 * @property string|null $nguoi_thue
 * @property string|null $ngay_het_han
 * @property int|null $thoi_han_thue
 * @property string|null $fulldiachi
 * @property int|null $id_ho
 * @property int|null $id_can
 * @property string|null $ma_phuong
 * @property string|null $so_nha
 * @property string|null $ten_duong
 * @property int|null $stt
 */
class VThongbaoSaphethan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_thongbao_saphethan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_hopdong', 'thoi_han_thue', 'id_ho', 'id_can', 'stt'], 'default', 'value' => null],
            [['id_hopdong', 'thoi_han_thue', 'id_ho', 'id_can', 'stt'], 'integer'],
            [['ngay_het_han'], 'safe'],
            [['fulldiachi'], 'string'],
            [['so_hop_dong', 'nguoi_thue', 'so_nha', 'ten_duong'], 'string', 'max' => 100],
            [['ma_phuong'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_hopdong' => 'Id Hopdong',
            'so_hop_dong' => 'Số hợp đồng',
            'nguoi_thue' => 'Người thuê',
            'ngay_het_han' => 'Ngày hết hạn',
            'thoi_han_thue' => 'Thời hạn thuê',
            'fulldiachi' => 'Địa chỉ',
            'id_ho' => 'Id Ho',
            'id_can' => 'Id Can',
            'ma_phuong' => 'Ma Phuong',
            'so_nha' => 'So Nha',
            'ten_duong' => 'Ten Duong',
            'stt' => 'Stt',
        ];
    }

    public function afterFind(){
        $this->ngay_het_han = date('d/m/Y', strtotime($this->ngay_het_han));
    }
}

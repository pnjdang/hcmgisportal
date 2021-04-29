<?php

namespace app\modules\quanly\models\hopdong;

use Yii;

/**
 * This is the model class for table "v_hopdongkhongco".
 *
 * @property integer $id_ho
 * @property integer $id_can
 * @property integer $stt_ho
 * @property string $cap_nha
 * @property string $dien_tich_su_dung
 * @property string $hop_dong_hien_tai
 * @property string $thoi_han
 * @property string $vi_tri
 * @property string $so_nha
 * @property string $ten_duong
 * @property integer $id_loainha
 * @property string $dien_tich_khuon_vien
 * @property string $ma_phuong
 * @property string $tenphuong
 * @property string $tenquan
 * @property string $ten_loainha
 * @property integer $stt
 * @property integer $stt_can
 * @property integer $id_hopdong
 * @property string $so_hop_dong
 * @property string $ngay_hop_dong
 * @property string $nguoi_thue
 * @property integer $gia_thue
 * @property integer $gia_giam
 * @property string $ly_do_giam
 * @property integer $gia_phai_tra
 * @property integer $thoi_han_thue
 * @property string $ghi_chu
 * @property string $ngay_bat_dau
 * @property string $cmnd
 * @property string $thuong_tru
 * @property string $dia_chi_lien_he
 * @property string $dien_thoai
 * @property string $ngay_giao_nhan
 * @property string $ngay_ki
 * @property string $ngay_cap
 * @property string $noi_cap
 * @property string $geom
 * @property string $ngay_het_han
 * @property integer $ngung_thu
 * @property integer $trang_thai
 * @property integer $thanh_ly
 * @property integer $status
 * @property string $rownum
 */
class VHopdongkhongco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_hopdongkhongco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ho', 'id_can', 'stt_ho', 'id_loainha', 'stt', 'stt_can', 'id_hopdong', 'gia_thue', 'gia_giam', 'gia_phai_tra', 'thoi_han_thue', 'ngung_thu', 'trang_thai', 'thanh_ly', 'status', 'rownum'], 'integer'],
            [['dien_tich_su_dung', 'dien_tich_khuon_vien'], 'number'],
            [['ngay_hop_dong', 'ngay_bat_dau', 'ngay_giao_nhan', 'ngay_ki', 'ngay_cap', 'ngay_het_han'], 'safe'],
            [['geom'], 'string'],
            [['cap_nha', 'tenquan', 'cmnd', 'dien_thoai'], 'string', 'max' => 20],
            [['hop_dong_hien_tai', 'vi_tri', 'so_nha', 'ten_duong', 'so_hop_dong', 'nguoi_thue', 'noi_cap'], 'string', 'max' => 100],
            [['thoi_han'], 'string', 'max' => 10],
            [['ma_phuong', 'tenphuong'], 'string', 'max' => 50],
            [['ten_loainha', 'thuong_tru', 'dia_chi_lien_he'], 'string', 'max' => 200],
            [['ly_do_giam', 'ghi_chu'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ho' => 'Id Ho',
            'id_can' => 'Id Can',
            'stt_ho' => 'Stt Ho',
            'cap_nha' => 'Cap Nha',
            'dien_tich_su_dung' => 'Dien Tich Su Dung',
            'hop_dong_hien_tai' => 'Hop Dong Hien Tai',
            'thoi_han' => 'Thoi Han',
            'vi_tri' => 'Vi Tri',
            'so_nha' => 'So Nha',
            'ten_duong' => 'Ten Duong',
            'id_loainha' => 'Id Loainha',
            'dien_tich_khuon_vien' => 'Dien Tich Khuon Vien',
            'ma_phuong' => 'Ma Phuong',
            'tenphuong' => 'Tenphuong',
            'tenquan' => 'Tenquan',
            'ten_loainha' => 'Ten Loainha',
            'stt' => 'Stt',
            'stt_can' => 'Stt Can',
            'id_hopdong' => 'Id Hopdong',
            'so_hop_dong' => 'So Hop Dong',
            'ngay_hop_dong' => 'Ngay Hop Dong',
            'nguoi_thue' => 'Nguoi Thue',
            'gia_thue' => 'Gia Thue',
            'gia_giam' => 'Gia Giam',
            'ly_do_giam' => 'Ly Do Giam',
            'gia_phai_tra' => 'Gia Phai Tra',
            'thoi_han_thue' => 'Thoi Han Thue',
            'ghi_chu' => 'Ghi Chu',
            'ngay_bat_dau' => 'Ngay Bat Dau',
            'cmnd' => 'Cmnd',
            'thuong_tru' => 'Thuong Tru',
            'dia_chi_lien_he' => 'Dia Chi Lien He',
            'dien_thoai' => 'Dien Thoai',
            'ngay_giao_nhan' => 'Ngay Giao Nhan',
            'ngay_ki' => 'Ngay Ki',
            'ngay_cap' => 'Ngay Cap',
            'noi_cap' => 'Noi Cap',
            'geom' => 'Geom',
            'ngay_het_han' => 'Ngay Het Han',
            'ngung_thu' => 'Ngung Thu',
            'trang_thai' => 'Trang Thai',
            'thanh_ly' => 'Thanh Ly',
            'status' => 'Status',
            'rownum' => 'Rownum',
        ];
    }
}

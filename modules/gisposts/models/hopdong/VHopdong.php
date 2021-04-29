<?php

namespace app\modules\quanly\models\hopdong;

use Yii;

/**
 * This is the model class for table "v_hopdong".
 *
 * @property integer $id_hopdong
 * @property integer $id_ho
 * @property string $so_hop_dong
 * @property string $ngay_hop_dong
 * @property string $so_quyet_dinh
 * @property string $nguoi_thue
 * @property string $cmnd
 * @property string $ngay_cap
 * @property string $noi_cap
 * @property string $thuong_tru
 * @property string $dia_chi_lien_he
 * @property string $dien_thoai
 * @property integer $gia_thue
 * @property integer $gia_giam
 * @property string $ly_do_giam
 * @property integer $gia_phai_tra
 * @property integer $thoi_han_thanh_toan
 * @property integer $thoi_han_thue
 * @property string $ngay_bat_dau
 * @property string $ngay_ki
 * @property string $ngay_giao_nhan
 * @property string $ngay_het_han
 * @property string $ghi_chu
 * @property integer $ngung_thu
 * @property integer $thanh_ly
 * @property string $ngay_ngungthu
 * @property string $ngay_thanh_ly
 * @property integer $id_can
 * @property string $cap_nha
 * @property string $dien_tich_su_dung
 * @property string $vi_tri
 * @property integer $gia_nha
 * @property string $so_luu_kho
 * @property integer $trang_thai
 * @property string $so_nha
 * @property string $ten_duong
 * @property integer $id_loainha
 * @property string $dien_tich_khuon_vien
 * @property string $so_to_bd
 * @property string $so_thua
 * @property string $ma_phuong
 * @property string $tenphuong
 * @property string $tenquan
 * @property string $ten_loainha
 * @property integer $id_tnv
 * @property string $ten_tnv
 * @property integer $id_bct
 * @property integer $stt
 */
class VHopdong extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_hopdong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_hopdong', 'id_ho', 'gia_thue', 'gia_giam', 'gia_phai_tra', 'thoi_han_thanh_toan', 'thoi_han_thue', 'ngung_thu', 'thanh_ly', 'id_can', 'gia_nha', 'trang_thai', 'id_loainha', 'id_tnv', 'id_bct', 'stt','stt_can','rownum'], 'integer'],
            [['ngay_hop_dong', 'ngay_cap', 'ngay_bat_dau', 'ngay_ki', 'ngay_giao_nhan', 'ngay_het_han', 'ngay_ngungthu', 'ngay_thanh_ly'], 'safe'],
            [['dien_tich_su_dung', 'dien_tich_khuon_vien'], 'number'],
            [['so_hop_dong', 'so_quyet_dinh', 'nguoi_thue', 'noi_cap', 'vi_tri', 'so_luu_kho', 'so_nha', 'ten_duong', 'ten_tnv'], 'string', 'max' => 100],
            [['cmnd', 'dien_thoai', 'cap_nha', 'so_to_bd', 'so_thua', 'tenquan'], 'string', 'max' => 20],
            [['thuong_tru', 'dia_chi_lien_he', 'ten_loainha'], 'string', 'max' => 200],
            [['ly_do_giam', 'ghi_chu'], 'string', 'max' => 500],
            [['ma_phuong', 'tenphuong'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_hopdong' => 'Id Hopdong',
            'id_ho' => 'Id Ho',
            'so_hop_dong' => 'So Hop Dong',
            'ngay_hop_dong' => 'Ngay Hop Dong',
            'so_quyet_dinh' => 'So Quyet Dinh',
            'nguoi_thue' => 'Nguoi Thue',
            'cmnd' => 'Cmnd',
            'ngay_cap' => 'Ngay Cap',
            'noi_cap' => 'Noi Cap',
            'thuong_tru' => 'Thuong Tru',
            'dia_chi_lien_he' => 'Dia Chi Lien He',
            'dien_thoai' => 'Dien Thoai',
            'gia_thue' => 'Gia Thue',
            'gia_giam' => 'Gia Giam',
            'ly_do_giam' => 'Ly Do Giam',
            'gia_phai_tra' => 'Gia Phai Tra',
            'thoi_han_thanh_toan' => 'Thoi Han Thanh Toan',
            'thoi_han_thue' => 'Thoi Han Thue',
            'ngay_bat_dau' => 'Ngay Bat Dau',
            'ngay_ki' => 'Ngay Ki',
            'ngay_giao_nhan' => 'Ngay Giao Nhan',
            'ngay_het_han' => 'Ngay Het Han',
            'ghi_chu' => 'Ghi Chu',
            'ngung_thu' => 'Ngung Thu',
            'thanh_ly' => 'Thanh Ly',
            'ngay_ngungthu' => 'Ngay Ngungthu',
            'ngay_thanh_ly' => 'Ngay Thanh Ly',
            'id_can' => 'Id Can',
            'cap_nha' => 'Cap Nha',
            'dien_tich_su_dung' => 'Dien Tich Su Dung',
            'vi_tri' => 'Vi Tri',
            'gia_nha' => 'Gia Nha',
            'so_luu_kho' => 'So Luu Kho',
            'trang_thai' => 'Trang Thai',
            'so_nha' => 'So Nha',
            'ten_duong' => 'Ten Duong',
            'id_loainha' => 'Id Loainha',
            'dien_tich_khuon_vien' => 'Dien Tich Khuon Vien',
            'so_to_bd' => 'So To Bd',
            'so_thua' => 'So Thua',
            'ma_phuong' => 'Ma Phuong',
            'tenphuong' => 'Tenphuong',
            'tenquan' => 'Tenquan',
            'ten_loainha' => 'Ten Loainha',
            'id_tnv' => 'Id Tnv',
            'ten_tnv' => 'Ten Tnv',
            'id_bct' => 'Id Bct',
            'stt' => 'Stt',
        ];
    }

    public static function primaryKey()
    {
        return ['id_hopdong']; // TODO: Change the autogenerated stub
    }
}

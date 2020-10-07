<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "v_phongthinghiem".
 *
 * @property integer $id_ptn
 * @property integer $dtpv_id
 * @property string $ten_tv
 * @property string $ten_ta
 * @property string $coquan_chuquan
 * @property string $dia_chi
 * @property string $email
 * @property string $website
 * @property string $phu_trach
 * @property string $dai_dien
 * @property string $dactrung_hoatdong
 * @property integer $tien_si
 * @property integer $thac_si
 * @property integer $cu_nhan
 * @property integer $ky_thuat
 * @property integer $dien_tich
 * @property string $dinh_huong
 * @property boolean $xac_nhan
 * @property string $ghi_chu
 * @property string $geom
 * @property string $gia_tri_uoc_tinh
 * @property string $ghichu_chungloai
 * @property string $ghichu_chatluong
 * @property string $ghichu_tieuchuan
 * @property string $dien_thoai
 * @property string $fax
 * @property string $geo_x
 * @property string $geo_y
 * @property string $quan_huyen
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $created_by
 * @property integer $taikhoan_id
 */
class VPhongthinghiem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_phongthinghiem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ptn', 'dtpv_id', 'tien_si', 'thac_si', 'cu_nhan', 'ky_thuat', 'dien_tich', 'status', 'updated_by', 'created_by', 'taikhoan_id'], 'integer'],
            [['dactrung_hoatdong', 'dinh_huong', 'geom', 'ghichu_chungloai', 'ghichu_chatluong', 'ghichu_tieuchuan'], 'string'],
            [['xac_nhan'], 'boolean'],
            [['geo_x', 'geo_y'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_tv', 'ten_ta', 'coquan_chuquan', 'dia_chi', 'email', 'website', 'phu_trach', 'dai_dien', 'ghi_chu', 'gia_tri_uoc_tinh'], 'string', 'max' => 100],
            [['dien_thoai', 'fax'], 'string', 'max' => 50],
            [['quan_huyen'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ptn' => 'Id Ptn',
            'dtpv_id' => 'Dtpv ID',
            'ten_tv' => 'Ten Tv',
            'ten_ta' => 'Ten Ta',
            'coquan_chuquan' => 'Coquan Chuquan',
            'dia_chi' => 'Dia Chi',
            'email' => 'Email',
            'website' => 'Website',
            'phu_trach' => 'Phu Trach',
            'dai_dien' => 'Dai Dien',
            'dactrung_hoatdong' => 'Dactrung Hoatdong',
            'tien_si' => 'Tien Si',
            'thac_si' => 'Thac Si',
            'cu_nhan' => 'Cu Nhan',
            'ky_thuat' => 'Ky Thuat',
            'dien_tich' => 'Dien Tich',
            'dinh_huong' => 'Dinh Huong',
            'xac_nhan' => 'Xac Nhan',
            'ghi_chu' => 'Ghi Chu',
            'geom' => 'Geom',
            'gia_tri_uoc_tinh' => 'Gia Tri Uoc Tinh',
            'ghichu_chungloai' => 'Ghichu Chungloai',
            'ghichu_chatluong' => 'Ghichu Chatluong',
            'ghichu_tieuchuan' => 'Ghichu Tieuchuan',
            'dien_thoai' => 'Dien Thoai',
            'fax' => 'Fax',
            'geo_x' => 'Geo X',
            'geo_y' => 'Geo Y',
            'quan_huyen' => 'Quan Huyen',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
            'taikhoan_id' => 'Taikhoan ID',
        ];
    }
}

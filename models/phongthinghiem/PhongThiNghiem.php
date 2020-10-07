<?php

namespace app\models\phongthinghiem;

use app\models\danhmuc\phongthinghiem\doituongphucvu\DoituongPhucvu;
use app\models\TaiKhoan;
use app\services\DebugService;
use Yii;

/**
 * This is the model class for table "phong_thi_nghiem".
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
 * @property string $ten_khongdau
 *
 * @property DoituongPhucvu $dtpv
 * @property TaiKhoan $taikhoan
 * @property PhongthinghiemChatluong[] $phongthinghiemChatluongs
 * @property PhongthinghiemChungloai[] $phongthinghiemChungloais
 * @property PhongthinghiemHoptac[] $phongthinghiemHoptacs
 * @property PhongthinghiemLinhvuc[] $phongthinghiemLinhvucs
 * @property PhongthinghiemTieuchuan[] $phongthinghiemTieuchuans
 * @property SohuuTritue[] $sohuuTritues
 * @property Thietbithunghiem[] $thietbithunghiems
 */
class PhongThiNghiem extends \yii\db\ActiveRecord
{
    public $linhvucChecked;
    public $tieuchuanChecked;
    public $chatluongChecked;
    public $phanloaiChecked;
    public $hoivienChecked;
    public $chungloai;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phong_thi_nghiem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dtpv_id', 'tien_si', 'thac_si', 'cu_nhan', 'ky_thuat', 'dien_tich', 'status', 'updated_by', 'created_by', 'taikhoan_id'], 'integer'],
            [['dactrung_hoatdong', 'dinh_huong', 'geom', 'ghichu_chungloai', 'ghichu_chatluong', 'ghichu_tieuchuan'], 'string'],
            [['xac_nhan'], 'boolean'],
            [['geo_x', 'geo_y'], 'number'],
            [['email'], 'email', 'message' => 'Email không đúng định dạng'],
            [['linhvucChecked', 'tieuchuanChecked', 'chatluongChecked', 'phanloaiChecked', 'hoivienChecked', 'chungloai','updated_at','created_at'], 'safe'],
            [['ten_tv', 'ten_ta', 'coquan_chuquan', 'dia_chi', 'email', 'website', 'phu_trach', 'dai_dien', 'ghi_chu', 'gia_tri_uoc_tinh','ten_khongdau'], 'string', 'max' => 100],
            [['dien_thoai', 'fax'], 'string', 'max' => 50],
            [['quan_huyen'], 'string', 'max' => 30],
//            [['ten_tv','dia_chi','coquan_chuquan','dai_dien','phu_trach'],'required','message' => 'Thông tin bắt buộc'],
            [['tien_si','thac_si','cu_nhan','ky_thuat'], 'compare', 'compareValue' => 0, 'operator' => '>=','message' => 'Số liệu phải lớn hơn hoặc bằng 0'],
            [['dtpv_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoituongPhucvu::className(), 'targetAttribute' => ['dtpv_id' => 'id_dtpv']],
            [['taikhoan_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaiKhoan::className(), 'targetAttribute' => ['taikhoan_id' => 'id_taikhoan']],
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
            'ten_tv' => 'Tên tiếng Việt',
            'ten_ta' => 'Tên tiếng Anh',
            'coquan_chuquan' => 'Cơ quan chủ quản',
            'dia_chi' => 'Địa chỉ',
            'email' => 'Email',
            'website' => 'Website',
            'phu_trach' => 'Phu Trach',
            'dai_dien' => 'Người đại diện',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDtpv()
    {
        return $this->hasOne(DoituongPhucvu::className(), ['id_dtpv' => 'dtpv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaikhoan()
    {
        return $this->hasOne(TaiKhoan::className(), ['id_taikhoan' => 'taikhoan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemChatluongs()
    {
        return $this->hasMany(PhongthinghiemChatluong::className(), ['ptn_id' => 'id_ptn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemChungloais()
    {
        return $this->hasMany(PhongthinghiemChungloai::className(), ['ptn_id' => 'id_ptn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemHoptacs()
    {
        return $this->hasMany(PhongthinghiemHoptac::className(), ['ptn_id' => 'id_ptn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemLinhvucs()
    {
        return $this->hasMany(PhongthinghiemLinhvuc::className(), ['ptn_id' => 'id_ptn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemTieuchuans()
    {
        return $this->hasMany(PhongthinghiemTieuchuan::className(), ['ptn_id' => 'id_ptn']);
    }

    public function getPhongthinghiemThietbis()
    {
        return $this->hasMany(PhongthinghiemThietbi::className(), ['ptn_id' => 'id_ptn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSohuuTritues()
    {
        return $this->hasMany(PhongthinghiemSohuutritue::className(), ['id_ptn' => 'id_ptn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThietbithunghiems()
    {
        return $this->hasMany(PhongthinghiemThietbi::className(), ['ptn_id' => 'id_ptn']);
    }

    public function afterSave($insert, $changedAttributes) {
        \Yii::$app->db->createCommand()->delete('phongthinghiem_linhvuc', 'ptn_id = ' . (int) $this->id_ptn)->execute(); //Delete existing value

        if ($this->linhvucChecked != null) {
            foreach ($this->linhvucChecked as $id_lv) { //Write new values
                if($id_lv != null){
                    $lvtn = new PhongthinghiemLinhvuc();
                    $lvtn->ptn_id = $this->id_ptn;
                    $lvtn->lv_id = $id_lv;
                    $lvtn->save();
                }
            }
        }
        if ($this->tieuchuanChecked != null) {
            \Yii::$app->db->createCommand()->delete('phongthinghiem_tieuchuan', 'ptn_id = ' . (int) $this->id_ptn)->execute(); //Delete existing value

            foreach ($this->tieuchuanChecked as $id_tc) { //Write new values
                $tc = new PhongthinghiemTieuchuan();
                $tc->ptn_id = $this->id_ptn;
                $tc->tc_id = $id_tc;
                $tc->save();
            }
        }
        if ($this->chatluongChecked != null) {
            \Yii::$app->db->createCommand()->delete('phongthinghiem_chatluong', 'ptn_id = ' . (int) $this->id_ptn)->execute(); //Delete existing value

            foreach ($this->chatluongChecked as $id_cncl) { //Write new values
                $cl = new PhongthinghiemChatluong();
                $cl->ptn_id = $this->id_ptn;
                $cl->cncl_id = $id_cncl;
                $cl->save();
            }
        }
        if ($this->hoivienChecked != null) {
            \Yii::$app->db->createCommand()->delete('phongthinghiem_hoptac', 'ptn_id = ' . (int) $this->id_ptn)->execute(); //Delete existing value

            foreach ($this->hoivienChecked as $id_tcht) { //Write new values
                $tcht = new PhongthinghiemHoptac();
                $tcht->ptn_id = $this->id_ptn;
                $tcht->tcht_id = $id_tcht;
                $tcht->save();
            }
        }
        if ($this->phanloaiChecked != null) {
            \Yii::$app->db->createCommand()->delete('phongthinghiem_chungloai', 'ptn_id = ' . (int) $this->id_ptn)->execute(); //Delete existing value
            foreach ($this->phanloaiChecked as $i => $cl) { //Write new values
                if ($cl != null) {
                    foreach ($cl as $k => $pl) {
                        $ptncl = new PhongthinghiemChungloai();
                        $ptncl->ptn_id = $this->id_ptn;
                        $ptncl->pl_id = $pl;
                        $ptncl->cl_id = $i;
                        $ptncl->save();
                    }
                }
            }
        }
    }
}

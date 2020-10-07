<?php

namespace app\models;

use app\services\DebugService;
use Yii;

/**
 * This is the model class for table "pdk_phongthinghiem".
 *
 * @property integer $id_pdkptn
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
 * @property string $dien_tich
 * @property string $dinh_huong
 * @property boolean $xac_nhan
 * @property string $ghi_chu
 * @property string $gia_tri_uoc_tinh
 * @property string $ghichu_chungloai
 * @property string $ghichu_chatluong
 * @property string $ghichu_tieuchuan
 * @property string $dien_thoai
 * @property string $fax
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $updated_at
 * @property integer $ket_qua
 *
 * @property PdkThietbithunghiem[] $pdkThietbithunghiems
 */
class PdkPhongthinghiem extends \yii\db\ActiveRecord
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
        return 'pdk_phongthinghiem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dactrung_hoatdong', 'dinh_huong', 'ghichu_chungloai', 'ghichu_chatluong', 'ghichu_tieuchuan'], 'string'],
            [['dtpv_id','tien_si', 'thac_si', 'cu_nhan', 'ky_thuat', 'status', 'created_by', 'updated_by','ket_qua'], 'integer'],
            [['dien_tich'], 'number'],
            [['xac_nhan'], 'boolean'],
            [['linhvucChecked', 'tieuchuanChecked', 'chatluongChecked', 'phanloaiChecked', 'hoivienChecked','created_at', 'updated_at'], 'safe'],
            [['ten_tv', 'ten_ta', 'coquan_chuquan', 'dia_chi', 'email', 'website', 'phu_trach', 'dai_dien', 'ghi_chu', 'gia_tri_uoc_tinh'], 'string', 'max' => 100],
            [['dien_thoai', 'fax'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pdkptn' => 'Id Pdkptn',
            'dtpv_id' => 'Dtpv Id',
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
            'gia_tri_uoc_tinh' => 'Gia Tri Uoc Tinh',
            'ghichu_chungloai' => 'Ghichu Chungloai',
            'ghichu_chatluong' => 'Ghichu Chatluong',
            'ghichu_tieuchuan' => 'Ghichu Tieuchuan',
            'dien_thoai' => 'Dien Thoai',
            'fax' => 'Fax',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDtpv() {
        return $this->hasOne(DoituongPhucvu::className(), ['id_dtpv' => 'dtpv_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdkThietbithunghiems()
    {
        return $this->hasMany(PdkThietbithunghiem::className(), ['pdkptn_id' => 'id_pdkptn']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemChatluongs() {
        return $this->hasMany(PhongthinghiemChatluong::className(), ['pdkptn_id' => 'id_pdkptn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemChungloais() {
        return $this->hasMany(PhongthinghiemChungloai::className(), ['pdkptn_id' => 'id_pdkptn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemHoptacs() {
        return $this->hasMany(PhongthinghiemHoptac::className(), ['pdkptn_id' => 'id_pdkptn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemLinhvucs() {
        return $this->hasMany(PhongthinghiemLinhvuc::className(), ['pdkptn_id' => 'id_pdkptn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemTieuchuans() {
        return $this->hasMany(PhongthinghiemTieuchuan::className(), ['pdkptn_id' => 'id_pdkptn']);
    }

    public function afterSave($insert, $changedAttributes) {
        if ($this->linhvucChecked != null) {
            \Yii::$app->db->createCommand()->delete('phongthinghiem_linhvuc', 'pdkptn_id = ' . (int) $this->id_pdkptn)->execute(); //Delete existing value
            foreach ($this->linhvucChecked as $id_lv) { //Write new values
                $lvtn = new PhongthinghiemLinhvuc();
                $lvtn->pdkptn_id = $this->id_pdkptn;
                $lvtn->lv_id = $id_lv;
                $lvtn->save();
            }
        }
        if ($this->tieuchuanChecked != null) {
            \Yii::$app->db->createCommand()->delete('phongthinghiem_tieuchuan', 'pdkptn_id = ' . (int) $this->id_pdkptn)->execute(); //Delete existing value

            foreach ($this->tieuchuanChecked as $id_tc) { //Write new values
                $tc = new PhongthinghiemTieuchuan();
                $tc->pdkptn_id = $this->id_pdkptn;
                $tc->tc_id = $id_tc;
                $tc->save();
            }
        }
        if ($this->chatluongChecked != null) {
            \Yii::$app->db->createCommand()->delete('phongthinghiem_chatluong', 'pdkptn_id = ' . (int) $this->id_pdkptn)->execute(); //Delete existing value

            foreach ($this->chatluongChecked as $id_cncl) { //Write new values
                $cl = new PhongthinghiemChatluong();
                $cl->pdkptn_id = $this->id_pdkptn;
                $cl->cncl_id = $id_cncl;
                $cl->save();
            }
        }
        if ($this->hoivienChecked != null) {
            \Yii::$app->db->createCommand()->delete('phongthinghiem_hoptac', 'pdkptn_id = ' . (int) $this->id_pdkptn)->execute(); //Delete existing value

            foreach ($this->hoivienChecked as $id_tcht) { //Write new values
                $tcht = new PhongthinghiemHoptac();
                $tcht->pdkptn_id = $this->id_pdkptn;
                $tcht->tcht_id = $id_tcht;
                $tcht->save();
            }
        }
        if ($this->phanloaiChecked != null) {
            \Yii::$app->db->createCommand()->delete('phongthinghiem_chungloai', 'pdkptn_id = ' . (int) $this->id_pdkptn)->execute(); //Delete existing value
            foreach ($this->phanloaiChecked as $i => $cl) { //Write new values
                if ($cl != null) {
                    foreach ($cl as $k => $pl) {
                        $ptncl = new PhongthinghiemChungloai();
                        $ptncl->pdkptn_id = $this->id_pdkptn;
                        $ptncl->pl_id = $pl;
                        $ptncl->cl_id = $i;
                        $ptncl->save();
                    }
                }
            }
        }
    }
}

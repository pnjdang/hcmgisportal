<?php

namespace app\modules\quanly\models\ho;

use app\modules\quanly\models\can\ThongTinCan;
use app\modules\quanly\models\hopdong\GiaHan;
use app\modules\quanly\models\hopdong\Hopdong;
use app\services\UtilityService;
use Yii;

/**
 * This is the model class for table "thong_tin_ho".
 *
 * @property integer $id_ho
 * @property integer $id_can
 * @property integer $stt_ho
 * @property string $cap_nha
 * @property string $nguoi_thue
 * @property string $dien_tich_su_dung
 * @property string $ghi_chu
 * @property string $hop_dong_hien_tai
 * @property string $thoi_han
 * @property string $ngay_bat_dau
 * @property string $vi_tri
 * @property integer $gia_nha
 * @property string $so_luu_kho
 * @property integer $trang_thai
 * @property integer $ngung_thu
 * @property integer $thanh_ly
 * @property string $ngay_ngungthu
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $quyetdinh_capnha
 * @property string $ngay_capnha
 * @property string $ngay_thanhly
 * @property string $ghichu_ban
 * @property string $ghichu_chuyengiao
 * @property boolean $da_ban
 * @property boolean $chuyen_giao
 * @property boolean $ngay_chuyengiao
 * @property boolean $ngay_ban
 *
 * @property Hopdong[] $hopDongs
 * @property ThongTinCan $idCan
 */
class ThongTinHo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thong_tin_ho';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_can', 'stt_ho', 'gia_nha', 'trang_thai', 'ngung_thu', 'thanh_ly', 'status', 'created_by', 'updated_by'], 'integer'],
            [['dien_tich_su_dung'], 'match', 'pattern' => '/^([0-9.,])+$/'],
            [['da_ban', 'chuyen_giao'], 'boolean'],
            [['ngay_bat_dau', 'ngay_ngungthu', 'ngay_capnha', 'ngay_thanhly', 'ngay_chuyengiao', 'ngay_ban', 'created_at', 'updated_at'], 'safe'],
            [['cap_nha'], 'string', 'max' => 20],
            [['nguoi_thue'], 'string', 'max' => 200],
            [['ghi_chu', 'quyetdinh_capnha'], 'string', 'max' => 500],
            [['hop_dong_hien_tai', 'vi_tri', 'so_luu_kho'], 'string', 'max' => 100],
            [['thoi_han'], 'string', 'max' => 10],
            [['id_can'], 'exist', 'skipOnError' => true, 'targetClass' => ThongTinCan::className(), 'targetAttribute' => ['id_can' => 'id_can']],
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
            'cap_nha' => 'Cấp nhà',
            'nguoi_thue' => 'Người thuê',
            'dien_tich_su_dung' => 'Diện tích sử dụng',
            'ghi_chu' => 'Ghi chú',
            'hop_dong_hien_tai' => 'Hợp đồng hiện tại',
            'thoi_han' => 'Thời hạn',
            'ngay_bat_dau' => 'Ngày bắt đầu',
            'vi_tri' => 'Vị trí',
            'gia_nha' => 'Gia Nha',
            'so_luu_kho' => 'Số lưu kho',
            'trang_thai' => 'Trang Thai',
            'ngung_thu' => 'Ngung Thu',
            'thanh_ly' => 'Thanh Ly',
            'ngay_ngungthu' => 'Ngay Ngungthu',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getIdCan()
    {
        return $this->hasOne(ThongTinCan::className(), ['id_can' => 'id_can']);
    }

    public function getThongtincan()
    {
        return $this->hasOne(ThongTinCan::className(), ['id_can' => 'id_can']);
    }

    public function getHopdong()
    {
        return $this->hasOne(HopDong::className(), ['id_ho' => 'id_ho'])->where('hop_dong.status = 1');
    }

    public function getHopdonghientai()
    {
        return $this->hasOne(HopDong::className(), ['id_hopdong' => 'hopdonghientai_id'])->where('hop_dong.status = 1');
    }

    public function getHopdongs()
    {
        return $this->hasMany(HopDong::className(), ['id_ho' => 'id_ho'])->where('hop_dong.status = 1')->orderBy('ngay_ki desc');
    }

    public function getTailieus()
    {
        return $this->hasMany(TaiLieu::className(), ['id_ho' => 'id_ho']);
    }

    public function beforeValidate()
    {
        $this->dien_tich_su_dung = str_replace(",", ".", $this->dien_tich_su_dung);
        return true;
    }

    public function deleteModel()
    {
        date_default_timezone_set('Asia/Ho_chi_minh');

        $this->status = 0;
        $this->updated_by = Yii::$app->user->id;
        $this->updated_at = date('Y-m-d H:i:s');

        if ($this->validate()) {
            $this->save();

            if($this->hop_dong_hien_tai != null){
                $hopdong = Hopdong::findOne($this->hop_dong_hien_tai);
                $hopdong->status = 0;
                $hopdong->updated_by = Yii::$app->user->id;
                $hopdong->updated_at = date('Y-m-d H:i:s');
                $hopdong->save();
                GiaHan::deleteAll(['id_hopdong' => $hopdong->id_hopdong]);
            }

            UtilityService::lichsu('Xóa hộ <i>' . $this->vi_tri . ' - ' . $this->cap_nha . '</i>');
            UtilityService::alert('deleted');
            return true;
        } else {
            return false;
        }
    }
}

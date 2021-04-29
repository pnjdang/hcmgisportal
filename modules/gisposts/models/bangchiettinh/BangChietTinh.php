<?php

namespace app\modules\quanly\models\bangchiettinh;
use app\models\danhmuc\miengiam\Miengiam;
use app\models\danhmuc\thoigianbotri\DmThoigianbotri;
use app\modules\quanly\base\Constants;
use app\services\DebugService;
use Yii;

/**
 * This is the models class for table "bang_chiet_tinh".
 *
 * @property integer $id_bangchiettinh
 * @property integer $gia_chuan
 * @property string $heso_k2
 * @property string $heso_k3
 * @property string $heso_k4
 * @property integer $quyetdinh_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $miengiam_id
 * @property string $dien_tich
 * @property integer $gia_thue
 * @property integer $gia_lamtron
 * @property integer $muc_giam
 * @property string $thoigian
 * @property string $heso_tlcb
 * @property integer $thoigianbotri_id
 * @property string $tu_ngay
 * @property integer $gia_tinh
 * @property integer $hopdong_id
 * @property string $nguoi_thue
 * @property string $phap_ly
 */
class BangChietTinh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bang_chiet_tinh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gia_chuan', 'quyetdinh_id', 'status', 'created_by', 'updated_by', 'miengiam_id', 'gia_thue', 'gia_lamtron', 'muc_giam', 'thoigianbotri_id', 'gia_tinh', 'hopdong_id'], 'integer'],
            [['heso_k2', 'heso_k3', 'heso_k4', 'dien_tich', 'thoigian', 'heso_tlcb'], 'number'],
            [['created_at', 'updated_at', 'tu_ngay'], 'safe'],
            [['phap_ly'], 'string'],
            [['nguoi_thue'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bangchiettinh' => 'Id Bangchiettinh',
            'gia_chuan' => 'Giá chuẩn',
            'heso_k2' => 'K2',
            'heso_k3' => 'K3',
            'heso_k4' => 'K4',
            'quyetdinh_id' => 'Quyetdinh ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'miengiam_id' => 'Miengiam ID',
            'dien_tich' => 'Diện tích',
            'gia_thue' => 'Gia Thue',
            'gia_lamtron' => 'Gia Lamtron',
            'muc_giam' => 'Muc Giam',
            'thoigian' => 'Thoigian',
            'heso_tlcb' => 'Heso Tlcb',
            'thoigianbotri_id' => 'Thoigianbotri ID',
            'tu_ngay' => 'Tu Ngay',
            'gia_tinh' => 'Gia Tinh',
            'hopdong_id' => 'Hopdong ID',
            'nguoi_thue' => 'Nguoi Thue',
            'phap_ly' => 'Phap Ly',
        ];
    }

    public function getHopdong()
    {
        return $this->hasOne(HopDong::className(), ['id_hopdong' => 'hopdong_id']);
    }

    public function getMiengiam()
    {
        return $this->hasOne(Miengiam::className(), ['id_miengiam' => 'miengiam_id']);
    }

    public function getThoigianbotri()
    {
        return $this->hasOne(DmThoigianbotri::className(), ['id_thoigianbotri' => 'thoigianbotri_id']);
    }

    public function beforeValidate(){
        date_default_timezone_set('Asia/Ho_chi_minh');
        $this->tu_ngay = date('Y-m-d',strtotime(str_replace('/','-',$this->tu_ngay)));
        $this->status = Constants::STATUS_ACTIVE;
        $this->created_by = Yii::$app->user->id;
        $this->created_at = date('Y-m-d H:i:s');
        return parent::beforeValidate();
    }
}

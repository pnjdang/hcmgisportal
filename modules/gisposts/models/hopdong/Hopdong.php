<?php

namespace app\modules\quanly\models\hopdong;

use app\models\KhoanThu;
use app\models\SoThu;
use app\modules\quanly\models\ho\ThongTinHo;
use app\services\DebugService;
use Yii;

/**
 * This is the model class for table "hop_dong".
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
 * @property string $dienthoai
 * @property integer $gia_thue
 * @property integer $gia_giam
 * @property string $ly_do_giam
 * @property integer $gia_phai_tra
 * @property integer $thoi_han_thanh_toan
 * @property integer $thoi_han_thue
 * @property string $ngay_bat_dau
 * @property string $ghi_chu
 * @property string $ngay_giao_nhan
 * @property string $ngay_ki
 * @property string $ngay_het_han
 * @property string $ngay_thanh_ly
 * @property integer $thanh_ly
 * @property integer $ngung_thu
 * @property string $ngay_ngungthu
 * @property integer $id_bct
 * @property integer $nohh
 * @property integer $nam_sinh
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $tien_thue
 * @property string $don_vi
 *
 * @property ThongTinHo $idHo
 * @property KhoanThu[] $khoanThus
 * @property SoThu[] $soThus
 */
class Hopdong extends \yii\db\ActiveRecord
{
    public $giathue;
    public $giagiam;
    public $giaphaitra;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hop_dong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ho', 'gia_thue', 'gia_giam', 'gia_phai_tra', 'thoi_han_thanh_toan', 'thoi_han_thue', 'thanh_ly', 'ngung_thu', 'id_bct', 'nohh', 'nam_sinh', 'status', 'created_by', 'updated_by','tien_thue'], 'integer'],
            [['ngay_hop_dong', 'ngay_cap', 'ngay_bat_dau', 'ngay_giao_nhan', 'ngay_ki', 'ngay_het_han', 'ngay_thanh_ly', 'ngay_ngungthu', 'created_at', 'updated_at'], 'safe'],
            [['so_hop_dong', 'so_quyet_dinh', 'nguoi_thue', 'noi_cap'], 'string', 'max' => 100],
            [['cmnd', 'dien_thoai'], 'string', 'max' => 20],
            [['dienthoai'], 'string'],
            [['giathue','giagiam','giaphaitra'], 'safe'],
            [['thuong_tru', 'dia_chi_lien_he', 'don_vi'], 'string', 'max' => 200],
            [['ly_do_giam', 'ghi_chu'], 'string', 'max' => 500],
            [['nguoi_thue','so_hop_dong','giathue','giagiam','giaphaitra'], 'required', 'message' => 'Dữ liệu bắt buộc'],
            [['id_ho'], 'exist', 'skipOnError' => true, 'targetClass' => ThongTinHo::className(), 'targetAttribute' => ['id_ho' => 'id_ho']],
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
            'dienthoai' => 'Dien Thoai',
            'gia_thue' => 'Gia Thue',
            'gia_giam' => 'Gia Giam',
            'ly_do_giam' => 'Ly Do Giam',
            'gia_phai_tra' => 'Gia Phai Tra',
            'thoi_han_thanh_toan' => 'Thoi Han Thanh Toan',
            'thoi_han_thue' => 'Thoi Han Thue',
            'ngay_bat_dau' => 'Ngay Bat Dau',
            'ghi_chu' => 'Ghi Chu',
            'ngay_giao_nhan' => 'Ngay Giao Nhan',
            'ngay_ki' => 'Ngay Ki',
            'ngay_het_han' => 'Ngay Het Han',
            'ngay_thanh_ly' => 'Ngay Thanh Ly',
            'thanh_ly' => 'Thanh Ly',
            'ngung_thu' => 'Ngung Thu',
            'ngay_ngungthu' => 'Ngay Ngungthu',
            'id_bct' => 'Id Bct',
            'nohh' => 'Nohh',
            'nam_sinh' => 'Nam Sinh',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'don_vi' => 'Don Vi',
            'tien_thue' => 'Tien Thue',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThongtinho()
    {
        return $this->hasOne(ThongTinHo::className(), ['id_ho' => 'id_ho']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKhoanThus()
    {
        return $this->hasMany(KhoanThu::className(), ['id_hopdong' => 'id_hopdong']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoThus()
    {
        return $this->hasMany(SoThu::className(), ['id_hopdong' => 'id_hopdong']);
    }

    public function getGiahans()
    {
        return $this->hasMany(GiaHan::className(), ['id_hopdong' => 'id_hopdong']);
    }

    public function getLatestGiahan(){
        return $this->hasOne(GiaHan::className(), ['id_hopdong' => 'id_hopdong'])->orderBy('ngay_gia_han');
    }

    public function afterFind(){
        $this->giathue = $this->gia_thue;
        $this->giagiam = $this->gia_giam;
        $this->giaphaitra = $this->gia_phai_tra;
        if($this->ngay_cap != null){
            $this->ngay_cap = date('d/m/Y', strtotime($this->ngay_cap));
        }
        if($this->ngay_ki != null){
            $this->ngay_ki = date('d/m/Y', strtotime($this->ngay_ki));
        }
        if($this->ngay_bat_dau != null){
            $this->ngay_bat_dau = date('d/m/Y', strtotime($this->ngay_bat_dau));
        }
        if($this->ngay_het_han != null){
            $this->ngay_het_han = date('d/m/Y', strtotime($this->ngay_het_han));
        }
    }

    public function saveModel($ho = null){
        if($this->ngay_cap != null){
            $this->ngay_cap = date('Y-m-d', strtotime(str_replace('/','-', $this->ngay_cap)));
        }
        if($this->ngay_ki != null){
            $this->ngay_ki = date('Y-m-d', strtotime(str_replace('/','-', $this->ngay_ki)));
        }
        if($this->ngay_bat_dau != null){
            $this->ngay_bat_dau = date('Y-m-d', strtotime(str_replace('/','-', $this->ngay_bat_dau)));
            if($this->ngay_het_han == null){
                $this->ngay_het_han = date('Y-m-d', strtotime("+$this->thoi_han_thue months", strtotime($this->ngay_bat_dau)));
            }
        }

        $this->gia_thue = str_replace(',','', $this->giathue);
        $this->gia_giam = str_replace(',','', $this->giagiam);
        $this->gia_phai_tra = str_replace(',','', $this->giaphaitra);

        if($this->validate()){
            \date_default_timezone_set('Asia/Ho_chi_minh');
            $this->status = 1;
            if($this->isNewRecord){
                $this->status = 1;
                $this->created_by = Yii::$app->user->id;
                $this->created_at = date('Y-m-d H:i:s');
                $this->id_ho = $ho->id_ho;
                $this->save();

                $ho->nguoi_thue = $this->nguoi_thue;
                $ho->hopdonghientai_id = $this->id_hopdong;
                $ho->updated_by = Yii::$app->user->id;
                $ho->updated_at = date('Y-m-d H:i:s');
                $ho->save();
            } else {

                $this->updated_by = Yii::$app->user->id;
                $this->updated_at = date('Y-m-d H:i:s');
                $this->save();

                $ho->nguoi_thue = $this->nguoi_thue;
                $ho->hopdonghientai_id = $this->id_hopdong;
                $ho->updated_by = Yii::$app->user->id;
                $ho->updated_at = date('Y-m-d H:i:s');
                $ho->save();
            }

            return true;
        } else {
            DebugService::dumpdie($this->getErrors());
            return false;
        }
    }

    public function deleteModel(){
        if($this->ngay_cap != null){
            $this->ngay_cap = date('Y-m-d', strtotime(str_replace('/','-', $this->ngay_cap)));
        }
        if($this->ngay_ki != null){
            $this->ngay_ki = date('Y-m-d', strtotime(str_replace('/','-', $this->ngay_ki)));
        }
        if($this->ngay_bat_dau != null){
            $this->ngay_bat_dau = date('Y-m-d', strtotime(str_replace('/','-', $this->ngay_bat_dau)));
            $this->ngay_het_han = date('Y-m-d', strtotime(str_replace('/','-', $this->ngay_het_han)));
            if($this->ngay_het_han == null){
                $this->ngay_het_han = date('Y-m-d', strtotime("+$this->thoi_han_thue months", strtotime($this->ngay_bat_dau)));
            }
        }

        $this->gia_thue = str_replace(',','', $this->giathue);
        $this->gia_giam = str_replace(',','', $this->giagiam);
        $this->gia_phai_tra = str_replace(',','', $this->giaphaitra);
        $this->status = 0;
        $this->updated_by = Yii::$app->user->id;
        $this->updated_at = date('Y-m-d H:i:s');
        $this->save();

        return true;
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pdk_chuyengia".
 *
 * @property integer $id_pdkcg
 * @property integer $lvql_id
 * @property integer $dvct_id
 * @property integer $hocham_id
 * @property integer $hocvi_id
 * @property string $ho_ten
 * @property integer $nam_sinh
 * @property string $ngay_sinh
 * @property integer $donvi_id
 * @property string $dia_chi
 * @property string $dien_thoai
 * @property string $email
 * @property string $chuyen_mon
 * @property integer $gioi_tinh
 * @property string $dinh_huong
 * @property string $congtrinh_nghiencuu
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $taikhoan_id
 * @property string $donvi_congtac
 * @property string $chuc_vu
 * @property integer $ket_qua
 * @property string $ghi_chu
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $nam_hh
 * @property integer $nam_hv
 * @property integer $chucvu_id
 * @property integer $chuyennganh_id
 * @property string $dinhhuong_hoatdong
 * @property string $dinhhuong_trinhdo
 * @property string $congviec_hiennay
 *
 * @property ChuyengiaLinhvucnghiencuu[] $chuyengiaLinhvucnghiencuus
 * @property Chucvu $chucvu
 * @property DonVi $donvi
 * @property DonviCongtac $dvct
 * @property HocHam $hocham
 * @property HocVi $hocvi
 * @property LinhvucQuanly $lvql
 * @property LinhvucnghiencuuCap3 $chuyenganh
 */
class PdkChuyengia extends \yii\db\ActiveRecord
{
    public $linhvucnghiencuu;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pdk_chuyengia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lvql_id', 'dvct_id', 'hocham_id', 'hocvi_id', 'nam_sinh', 'donvi_id', 'gioi_tinh', 'status', 'taikhoan_id', 'ket_qua', 'created_by', 'updated_by', 'nam_hh', 'nam_hv', 'chucvu_id', 'chuyennganh_id'], 'integer'],
            [['ngay_sinh', 'created_at', 'updated_at'], 'safe'],
            [['dinh_huong', 'congtrinh_nghiencuu', 'dinhhuong_hoatdong', 'dinhhuong_trinhdo','linhvucnghiencuu'], 'string'],
            [['ho_ten', 'chuc_vu'], 'string', 'max' => 100],
            [['dia_chi', 'ghi_chu'], 'string', 'max' => 500],
            [['dien_thoai'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['chuyen_mon', 'donvi_congtac', 'congviec_hiennay'], 'string', 'max' => 200],
            [['chucvu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chucvu::className(), 'targetAttribute' => ['chucvu_id' => 'id_chucvu']],
            [['donvi_id'], 'exist', 'skipOnError' => true, 'targetClass' => DonVi::className(), 'targetAttribute' => ['donvi_id' => 'id_donvi']],
            [['dvct_id'], 'exist', 'skipOnError' => true, 'targetClass' => DonviCongtac::className(), 'targetAttribute' => ['dvct_id' => 'id_dvct']],
            [['hocham_id'], 'exist', 'skipOnError' => true, 'targetClass' => HocHam::className(), 'targetAttribute' => ['hocham_id' => 'id_hh']],
            [['hocvi_id'], 'exist', 'skipOnError' => true, 'targetClass' => HocVi::className(), 'targetAttribute' => ['hocvi_id' => 'id_hv']],
            [['lvql_id'], 'exist', 'skipOnError' => true, 'targetClass' => LinhvucQuanly::className(), 'targetAttribute' => ['lvql_id' => 'id_lvql']],
            [['chuyennganh_id'], 'exist', 'skipOnError' => true, 'targetClass' => LinhvucnghiencuuCap3::className(), 'targetAttribute' => ['chuyennganh_id' => 'id_cap3']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pdkcg' => 'Id Pdkcg',
            'lvql_id' => 'Lvql ID',
            'dvct_id' => 'Dvct ID',
            'hocham_id' => 'Hocham ID',
            'hocvi_id' => 'Hocvi ID',
            'ho_ten' => 'Ho Ten',
            'nam_sinh' => 'Nam Sinh',
            'ngay_sinh' => 'Ngay Sinh',
            'donvi_id' => 'Donvi ID',
            'dia_chi' => 'Dia Chi',
            'dien_thoai' => 'Dien Thoai',
            'email' => 'Email',
            'chuyen_mon' => 'Chuyen Mon',
            'gioi_tinh' => 'Gioi Tinh',
            'dinh_huong' => 'Dinh Huong',
            'congtrinh_nghiencuu' => 'Congtrinh Nghiencuu',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'taikhoan_id' => 'Taikhoan ID',
            'donvi_congtac' => 'Donvi Congtac',
            'chuc_vu' => 'Chuc Vu',
            'ket_qua' => 'Ket Qua',
            'ghi_chu' => 'Ghi Chu',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'nam_hh' => 'Nam Hh',
            'nam_hv' => 'Nam Hv',
            'chucvu_id' => 'Chucvu ID',
            'chuyenganh_id' => 'Chuyenganh ID',
            'dinhhuong_hoatdong' => 'Định hướng hoạt động khoa học công nghệ',
            'dinhhuong_trinhdo' => 'Định hướng nâng cao trình độ',
            'congviec_hiennay' => 'Công việc hiện nay',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengiaLinhvucnghiencuus()
    {
        return $this->hasMany(ChuyengiaLinhvucnghiencuu::className(), ['pdkcg_id' => 'id_pdkcg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChucvu()
    {
        return $this->hasOne(Chucvu::className(), ['id_chucvu' => 'chucvu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDonvi()
    {
        return $this->hasOne(DonVi::className(), ['id_donvi' => 'donvi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDvct()
    {
        return $this->hasOne(DonviCongtac::className(), ['id_dvct' => 'dvct_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHocham()
    {
        return $this->hasOne(HocHam::className(), ['id_hh' => 'hocham_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHocvi()
    {
        return $this->hasOne(HocVi::className(), ['id_hv' => 'hocvi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLvql()
    {
        return $this->hasOne(LinhvucQuanly::className(), ['id_lvql' => 'lvql_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyenganh()
    {
        return $this->hasOne(LinhvucnghiencuuCap3::className(), ['id_cap3' => 'chuyenganh_id']);
    }
}

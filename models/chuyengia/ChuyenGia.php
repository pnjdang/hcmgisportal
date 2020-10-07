<?php

namespace app\models\chuyengia;

use app\models\danhmuc\chuyengia\donvi\Donvi;
use app\models\danhmuc\chuyengia\hocham\HocHam;
use app\models\danhmuc\chuyengia\hocvi\HocVi;
use app\models\danhmuc\chuyengia\linhvucquanly\LinhvucQuanly;
use app\models\TaiKhoan;
use app\services\DebugService;
use Yii;

/**
 * This is the model class for table "chuyengia".
 *
 * @property integer $id_chuyengia
 * @property string $ho_ten
 * @property integer $gioi_tinh
 * @property integer $nam_sinh
 * @property integer $hocham_id
 * @property integer $nam_hocham
 * @property integer $hocvi_id
 * @property integer $nam_hocvi
 * @property integer $chuyennganh_id
 * @property string $congviec_hiennay
 * @property string $chucvu_hientai
 * @property string $diachi_nharieng
 * @property string $dien_thoai
 * @property string $email
 * @property integer $donvi_id
 * @property integer $congbothongtin
 * @property string $ghichu_chuyengia
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $lvql_id
 * @property string $dinhhuong_hoatdong
 * @property string $dinhhuong_daotao
 * @property string $di_dong
 * @property string $ten_khongdau
 *
 * @property DonVi $donvi
 * @property HocHam $hocham
 * @property HocVi $hocvi
 * @property LinhvucQuanly $lvql
 * @property ChuyengiaChuyennganh[] $chuyengiaChuyennganhs
 * @property ChuyengiaCongtrinh[] $chuyengiaCongtrinhs
 * @property ChuyengiaDaotao[] $chuyengiaDaotaos
 * @property ChuyengiaLinhvuc[] $chuyengiaLinhvucs
 * @property ChuyengiaNgoaingu[] $chuyengiaNgoaingus
 */
class Chuyengia extends \yii\db\ActiveRecord
{
    public $linhvucnghiencuu;
    public $chuyennganh;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuyengia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gioi_tinh', 'nam_sinh', 'hocham_id', 'nam_hocham', 'hocvi_id', 'nam_hocvi', 'chuyennganh_id', 'donvi_id', 'congbothongtin', 'status', 'created_by', 'updated_by', 'lvql_id'], 'integer'],
            [['created_at', 'updated_at','linhvucnghiencuu','chuyennganh'], 'safe'],
            [['dinhhuong_hoatdong', 'dinhhuong_daotao'], 'string'],
            [['ho_ten', 'ten_khongdau','chucvu_hientai', 'diachi_nharieng', 'ghichu_chuyengia'], 'string', 'max' => 200],
            [['dien_thoai', 'di_dong'], 'string', 'max' => 100],
            [['email'], 'email','message' => 'Email không đúng định dạng'],
            [['congviec_hiennay'], 'string', 'max' => 500],
            [['ho_ten','nam_sinh'],'required','message' => 'Dữ liệu bắt buộc'],
            [['donvi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Donvi::className(), 'targetAttribute' => ['donvi_id' => 'id_donvi']],
            [['hocham_id'], 'exist', 'skipOnError' => true, 'targetClass' => HocHam::className(), 'targetAttribute' => ['hocham_id' => 'id_hh']],
            [['hocvi_id'], 'exist', 'skipOnError' => true, 'targetClass' => HocVi::className(), 'targetAttribute' => ['hocvi_id' => 'id_hv']],
            [['lvql_id'], 'exist', 'skipOnError' => true, 'targetClass' => LinhvucQuanly::className(), 'targetAttribute' => ['lvql_id' => 'id_lvql']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_chuyengia' => 'Id Chuyengia',
            'ho_ten' => 'Họ tên',
            'gioi_tinh' => 'Giới tính',
            'nam_sinh' => 'Năm sinh',
            'hocham_id' => 'Học hàm',
            'nam_hocham' => 'Năm được phong',
            'hocvi_id' => 'Học vị',
            'nam_hocvi' => 'Năm đạt được',
            'chuyennganh_id' => 'Chuyên ngành',
            'congviec_hiennay' => 'Công việc hiện nay',
            'chucvu_hientai' => 'Chức vụ hiện tại',
            'diachi_nharieng' => 'Địa chỉ nhà riêng',
            'dien_thoai' => 'Điện thoại',
            'email' => 'Email',
            'donvi_id' => 'Đơn vị',
            'congbothongtin' => 'Đồng ý công bố thông tin',
            'ghichu_chuyengia' => 'Ghi chú',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'lvql_id' => 'Lvql ID',
            'dinhhuong_hoatdong' => 'Định hướng hoạt động',
            'dinhhuong_daotao' => 'Định hướng đào tạo',
            'di_dong' => 'Di động',
        ];
    }
    public function getTaikhoan()
    {
        return $this->hasOne(TaiKhoan::className(), ['id_taikhoan' => 'created_by']);
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
    public function getChuyengiaChuyennganhs()
    {
        return $this->hasMany(ChuyengiaChuyennganh::className(), ['chuyengia_id' => 'id_chuyengia']);
    }
    public function getChuyengiaCongtacs()
    {
        return $this->hasMany(ChuyengiaCongtac::className(), ['chuyengia_id' => 'id_chuyengia']);
    }
    public function getChuyengiaDetais()
    {
        return $this->hasMany(ChuyengiaDetai::className(), ['chuyengia_id' => 'id_chuyengia']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengiaCongtrinhs()
    {
        return $this->hasMany(ChuyengiaCongtrinh::className(), ['chuyengia_id' => 'id_chuyengia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengiaDaotaos()
    {
        return $this->hasMany(ChuyengiaDaotao::className(), ['chuyengia_id' => 'id_chuyengia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengiaLinhvucs()
    {
        return $this->hasMany(ChuyengiaLinhvuc::className(), ['chuyengia_id' => 'id_chuyengia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengiaNgoaingus()
    {
        return $this->hasMany(ChuyengiaNgoaingu::className(), ['chuyengia_id' => 'id_chuyengia']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->linhvucnghiencuu != null){
            \Yii::$app->db->createCommand()->delete('chuyengia_linhvuc', 'chuyengia_id = '.(int) $this->id_chuyengia)->execute(); //Delete existing value

            foreach ($this->linhvucnghiencuu as $cap1) { //Write new values
                $chuyengia_linhvuc = new ChuyengiaLinhvuc();
                $chuyengia_linhvuc->chuyengia_id = $this->id_chuyengia;
                $chuyengia_linhvuc->cap1_id = $cap1;
                $chuyengia_linhvuc->save();
            }
        }
        if($this->chuyennganh != null){
            \Yii::$app->db->createCommand()->delete('chuyengia_chuyennganh', 'chuyengia_id = '.(int) $this->id_chuyengia)->execute(); //Delete existing value

            foreach ($this->chuyennganh as $cap3) { //Write new values
                $chuyengia_chuyennganh = new ChuyengiaChuyennganh();
                $chuyengia_chuyennganh->chuyengia_id = $this->id_chuyengia;
                $chuyengia_chuyennganh->cap3_id = $cap3;
                $chuyengia_chuyennganh->save();
            }
        }
    }

    public function getTencongtrinh() {
        $vendor_arry = [];

        foreach ($this->chuyengiaCongtrinhs as $key => $item) {
            array_push($vendor_arry, $item->ten_congtrinh);
        }

        sort($vendor_arry);
        return implode(array_unique($vendor_arry, SORT_STRING), ", ");
    }
}

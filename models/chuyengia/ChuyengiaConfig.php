<?php

namespace app\models\chuyengia;

use Yii;

/**
 * This is the model class for table "chuyengia_config".
 *
 * @property integer $id_chuyengiaconfig
 * @property integer $chuyengia_id
 * @property boolean $ho_ten
 * @property boolean $gioi_tinh
 * @property boolean $nam_sinh
 * @property boolean $hocham_id
 * @property boolean $nam_hocham
 * @property boolean $hocvi_id
 * @property boolean $nam_hocvi
 * @property boolean $chuyennganh_id
 * @property boolean $congviec_hiennay
 * @property boolean $chucvu_hientai
 * @property boolean $diachi_nharieng
 * @property boolean $dien_thoai
 * @property boolean $email
 * @property boolean $donvi_id
 * @property boolean $congbothongtin
 * @property boolean $ghichu_chuyengia
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $lvql_id
 * @property boolean $dinhhuong_hoatdong
 * @property boolean $dinhhuong_daotao
 * @property boolean $di_dong
 * @property boolean $linhvuc_hoatdong
 * @property boolean $chuyen_nganh
 *
 * @property Chuyengia $chuyengia
 */
class ChuyengiaConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuyengia_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['ho_ten', 'gioi_tinh', 'nam_sinh', 'hocham_id', 'nam_hocham', 'hocvi_id', 'nam_hocvi', 'chuyennganh_id', 'congviec_hiennay', 'chucvu_hientai', 'diachi_nharieng', 'dien_thoai', 'email', 'donvi_id', 'congbothongtin', 'ghichu_chuyengia', 'lvql_id', 'dinhhuong_hoatdong', 'dinhhuong_daotao', 'di_dong', 'linhvuc_hoatdong', 'chuyen_nganh'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_chuyengiaconfig' => 'Id Chuyengiaconfig',
            'chuyengia_id' => 'Chuyengia ID',
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
            'linhvuc_hoatdong' => 'Linhvuc Hoatdong',
            'chuyen_nganh' => 'Chuyen Nganh',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengia()
    {
        return $this->hasOne(Chuyengia::className(), ['id_chuyengia' => 'chuyengia_id']);
    }
}

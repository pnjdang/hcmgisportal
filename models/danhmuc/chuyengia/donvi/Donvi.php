<?php

namespace app\models\danhmuc\chuyengia\donvi;

use app\models\Chuyengia;
use app\models\danhmuc\chuyengia\nhomdonvi\Nhomdonvi;
use app\models\PdkChuyengia;
use Yii;

/**
 * This is the model class for table "don_vi".
 *
 * @property integer $id_donvi
 * @property string $ten_donvi
 * @property string $dia_chi
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $nhomdonvi_id
 * @property integer $updated_by
 * @property integer $created_by
 * @property string $nguoidungdau
 * @property string $dien_thoai
 * @property string $fax
 * @property string $website
 *
 * @property ChuyenGia[] $chuyenGias
 * @property Nhomdonvi $nhomdonvi
 * @property PdkChuyengia[] $pdkChuyengias
 */
class Donvi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'don_vi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'nhomdonvi_id', 'updated_by', 'created_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_donvi', 'dia_chi'], 'string', 'max' => 200],
            [['nguoidungdau', 'website'], 'string', 'max' => 100],
            [['dien_thoai', 'fax'], 'string', 'max' => 100],
            [['nhomdonvi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nhomdonvi::className(), 'targetAttribute' => ['nhomdonvi_id' => 'id_nhomdonvi']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_donvi' => 'Id Donvi',
            'ten_donvi' => 'Tên đơn vị',
            'dia_chi' => 'Địa chỉ',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'nhomdonvi_id' => 'Nhomdonvi ID',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
            'nguoidungdau' => 'Người đứng đầu',
            'dien_thoai' => 'Điện thoại',
            'fax' => 'Fax',
            'website' => 'Website',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyenGias()
    {
        return $this->hasMany(Chuyengia::className(), ['donvi_id' => 'id_donvi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNhomdonvi()
    {
        return $this->hasOne(Nhomdonvi::className(), ['id_nhomdonvi' => 'nhomdonvi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdkChuyengias()
    {
        return $this->hasMany(PdkChuyengia::className(), ['donvi_id' => 'id_donvi']);
    }
}

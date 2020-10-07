<?php

namespace app\models\phongthinghiem;

use Yii;
use app\models\danhmuc\phongthinghiem\thietbi\ThietBi;
/**
 * This is the model class for table "phongthinghiem_thietbi".
 *
 * @property integer $id_phongthinghiemthietbi
 * @property integer $ptn_id
 * @property integer $thietbi_id
 * @property string $so_hieu
 * @property string $tinh_trang
 * @property integer $so_luong
 * @property string $ghi_chu
 * @property integer $nam_sx
 * @property string $hang_sx
 * @property string $nuoc_sx
 * @property string $dactinh_kythuat
 *
 * @property PhongThiNghiem $ptn
 * @property ThietBi $thietbi
 */
class PhongthinghiemThietbi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phongthinghiem_thietbi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ptn_id', 'thietbi_id', 'so_luong', 'nam_sx'], 'integer'],
            [['so_hieu', 'tinh_trang', 'hang_sx', 'nuoc_sx'], 'string', 'max' => 200],
            [['ghi_chu', 'dactinh_kythuat'], 'string', 'max' => 500],
            [['ptn_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongThiNghiem::className(), 'targetAttribute' => ['ptn_id' => 'id_ptn']],
            [['thietbi_id'], 'exist', 'skipOnError' => true, 'targetClass' => ThietBi::className(), 'targetAttribute' => ['thietbi_id' => 'id_tb']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_phongthinghiemthietbi' => 'Id Phongthinghiemthietbi',
            'ptn_id' => 'Ptn ID',
            'thietbi_id' => 'Thietbi ID',
            'so_hieu' => 'Số hiệu',
            'tinh_trang' => 'Tình trạng',
            'so_luong' => 'Số lượng',
            'ghi_chu' => 'Ghi chú',
            'nam_sx' => 'Năm sản xuất',
            'hang_sx' => 'Hãng sản xuất',
            'nuoc_sx' => 'Nước sản xuất',
            'dactinh_kythuat' => 'Đặc tính kỹ thuật',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtn()
    {
        return $this->hasOne(PhongThiNghiem::className(), ['id_ptn' => 'ptn_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThietbi()
    {
        return $this->hasOne(ThietBi::className(), ['id_tb' => 'thietbi_id']);
    }
}

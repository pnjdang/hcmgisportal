<?php

namespace app\models\chuyengia;

use app\models\danhmuc\chuyengia\loaicongtrinhnghiencuu\LoaiCongtrinhnghiencuu;
use Yii;

/**
 * This is the model class for table "chuyengia_congtrinh".
 *
 * @property integer $id_chuyengiacongtrinh
 * @property integer $chuyengia_id
 * @property integer $loaicongtrinh_id
 * @property integer $nam
 * @property string $tac_gia
 * @property string $noi_congbo
 * @property string $ghichu_chuyengiacongtrinh
 * @property string $ten_congtrinh
 *
 * @property Chuyengia $chuyengia
 * @property LoaiCongtrinhnghiencuu $loaicongtrinh
 */
class ChuyengiaCongtrinh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuyengia_congtrinh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'loaicongtrinh_id', 'nam'], 'integer'],
            [['ten_congtrinh'], 'string'],
            [['tac_gia', 'ghichu_chuyengiacongtrinh'], 'string', 'max' => 200],
            [['noi_congbo'], 'string', 'max' => 1000],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
            [['loaicongtrinh_id'], 'exist', 'skipOnError' => true, 'targetClass' => LoaiCongtrinhnghiencuu::className(), 'targetAttribute' => ['loaicongtrinh_id' => 'id_loaicongtrinh']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_chuyengiacongtrinh' => 'Id Chuyengiacongtrinh',
            'chuyengia_id' => 'Chuyengia ID',
            'loaicongtrinh_id' => 'Loaicongtrinh ID',
            'nam' => 'Năm',
            'tac_gia' => 'Tác giả',
            'noi_congbo' => 'Nơi công bố',
            'ghichu_chuyengiacongtrinh' => 'Ghi chú',
            'ten_congtrinh' => 'Tên công trình',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengia()
    {
        return $this->hasOne(Chuyengia::className(), ['id_chuyengia' => 'chuyengia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoaicongtrinh()
    {
        return $this->hasOne(LoaiCongtrinhnghiencuu::className(), ['id_loaicongtrinh' => 'loaicongtrinh_id']);
    }
}

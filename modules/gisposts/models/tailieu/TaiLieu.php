<?php

namespace app\modules\quanly\models\tailieu;

use app\modules\quanly\models\ho\ThongTinHo;
use Yii;

/**
 * This is the model class for table "tai_lieu".
 *
 * @property integer $id_tailieu
 * @property integer $id_ho
 * @property string $ten_tai_lieu
 * @property string $loai_tai_lieu
 * @property string $so_tai_lieu
 * @property string $ngay_tai_lieu
 * @property string $noi_dung
 * @property string $ghi_chu
 * @property string $duong_dan
 * @property string $so_luu_kho
 * @property integer $id_can
 */
class TaiLieu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tai_lieu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ho', 'id_can'], 'integer'],
            [['ngay_tai_lieu'], 'safe'],
            [['ten_tai_lieu', 'loai_tai_lieu'], 'string', 'max' => 200],
            [['so_tai_lieu'], 'string', 'max' => 100],
            [['noi_dung', 'ghi_chu', 'duong_dan'], 'string', 'max' => 500],
            [['so_luu_kho'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tailieu' => 'Id Tailieu',
            'id_ho' => 'Id Ho',
            'ten_tai_lieu' => 'Ten Tai Lieu',
            'loai_tai_lieu' => 'Loai Tai Lieu',
            'so_tai_lieu' => 'So Tai Lieu',
            'ngay_tai_lieu' => 'Ngay Tai Lieu',
            'noi_dung' => 'Noi Dung',
            'ghi_chu' => 'Ghi Chu',
            'duong_dan' => 'Duong Dan',
            'so_luu_kho' => 'So Luu Kho',
            'id_can' => 'Id Can',
        ];
    }

    public function getHo()
    {
        return $this->hasOne(ThongTinHo::className(), ['id_ho' => 'id_ho']);
    }
}

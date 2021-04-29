<?php

namespace app\modules\quanly\models\config;

use app\modules\auth\models\TaiKhoan;
use Yii;

/**
 * This is the model class for table "lich_su_truy_cap".
 *
 * @property integer $id_lichsu
 * @property integer $id_loaitk
 * @property string $thao_tac
 * @property string $thoi_gian
 * @property string $ghi_chu
 * @property integer $taikhoan_id
 *
 * @property TaiKhoan $taikhoan
 */
class LichSuTruyCap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lich_su_truy_cap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_loaitk', 'taikhoan_id'], 'integer'],
            [['thoi_gian'], 'safe'],
            [['thao_tac', 'ghi_chu'], 'string', 'max' => 500],
            [['taikhoan_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaiKhoan::className(), 'targetAttribute' => ['taikhoan_id' => 'id_taikhoan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lichsu' => 'Id Lichsu',
            'id_loaitk' => 'Id Loaitk',
            'thao_tac' => 'Thao Tac',
            'thoi_gian' => 'Thoi Gian',
            'ghi_chu' => 'Ghi Chu',
            'taikhoan_id' => 'Taikhoan ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaikhoan()
    {
        return $this->hasOne(TaiKhoan::className(), ['id_taikhoan' => 'taikhoan_id']);
    }
}

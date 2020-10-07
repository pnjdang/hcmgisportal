<?php

namespace app\models\danhmuc\phongthinghiem\chungloai;

use app\models\danhmuc\phongthinghiem\phanloai\PhanLoai;
use Yii;

/**
 * This is the model class for table "chung_loai".
 *
 * @property integer $id_cl
 * @property string $ten_cl
 * @property string $ghi_chu
 *
 * @property PhanLoai[] $phanLoais
 * @property PhongthinghiemChungloai[] $phongthinghiemChungloais
 */
class ChungLoai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $phanloaiChecked;

    public static function tableName()
    {
        return 'chung_loai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_cl'], 'string', 'max' => 300],
            [['ghi_chu'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cl' => 'Id Cl',
            'ten_cl' => 'Tên chủng loại',
            'ghi_chu' => 'Ghi chú',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhanLoais()
    {
        return $this->hasMany(PhanLoai::className(), ['id_cl' => 'id_cl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemChungloais()
    {
        return $this->hasMany(PhongthinghiemChungloai::className(), ['id_cl' => 'id_cl']);
    }
}

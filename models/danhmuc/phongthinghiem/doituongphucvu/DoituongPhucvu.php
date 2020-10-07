<?php

namespace app\models\danhmuc\phongthinghiem\doituongphucvu;

use Yii;

/**
 * This is the model class for table "doituong_phucvu".
 *
 * @property integer $id_dtpv
 * @property string $ten_dtpv
 * @property string $ghi_chu
 *
 * @property PhongThiNghiem[] $phongThiNghiems
 */
class DoituongPhucvu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doituong_phucvu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_dtpv', 'ghi_chu'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dtpv' => 'Id Dtpv',
            'ten_dtpv' => 'Ten Dtpv',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongThiNghiems()
    {
        return $this->hasMany(PhongThiNghiem::className(), ['id_dtpv' => 'id_dtpv']);
    }
}

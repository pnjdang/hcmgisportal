<?php

namespace app\models\phongthinghiem;

use app\models\danhmuc\phongthinghiem\sohuutritue\KetquaShtt;
use Yii;

/**
 * This is the model class for table "phongthinghiem_sohuutritue".
 *
 * @property integer $id_phongthinghiemsohuutritue
 * @property integer $ptn_id
 * @property integer $ketquashtt_id
 * @property integer $nam
 * @property integer $so_luong
 * @property string $ghi_chu
 *
 * @property KetquaShtt $ketquashtt
 * @property PhongThiNghiem $ptn
 */
class PhongthinghiemSohuutritue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phongthinghiem_sohuutritue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ptn_id', 'ketquashtt_id', 'nam', 'so_luong'], 'integer'],
            [['ghi_chu'], 'string', 'max' => 500],
            [['ketquashtt_id'], 'exist', 'skipOnError' => true, 'targetClass' => KetquaShtt::className(), 'targetAttribute' => ['ketquashtt_id' => 'id_ketquashtt']],
            [['ptn_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongThiNghiem::className(), 'targetAttribute' => ['ptn_id' => 'id_ptn']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_phongthinghiemsohuutritue' => 'Id Phongthinghiemsohuutritue',
            'ptn_id' => 'Ptn ID',
            'ketquashtt_id' => 'Ketquashtt ID',
            'nam' => 'Nam',
            'so_luong' => 'So Luong',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKetquashtt()
    {
        return $this->hasOne(KetquaShtt::className(), ['id_ketquashtt' => 'ketquashtt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtn()
    {
        return $this->hasOne(PhongThiNghiem::className(), ['id_ptn' => 'ptn_id']);
    }
}

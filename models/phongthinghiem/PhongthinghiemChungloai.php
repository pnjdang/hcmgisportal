<?php

namespace app\models\phongthinghiem;

use Yii;
use app\models\danhmuc\phongthinghiem\chungloai\ChungLoai;
use app\models\danhmuc\phongthinghiem\phanloai\PhanLoai;
use app\models\TempPhongthinghiem;

/**
 * This is the model class for table "phongthinghiem_chungloai".
 *
 * @property integer $id_ptn_cl
 * @property integer $cl_id
 * @property integer $pl_id
 * @property integer $ptn_id
 * @property integer $pdkptn_id
 * @property integer $tempptn_id
 *
 * @property ChungLoai $cl
 * @property PhanLoai $pl
 * @property PhongThiNghiem $ptn
 * @property TempPhongthinghiem $tempptn
 */
class PhongthinghiemChungloai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phongthinghiem_chungloai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cl_id', 'pl_id', 'ptn_id', 'pdkptn_id', 'tempptn_id'], 'integer'],
            [['cl_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChungLoai::className(), 'targetAttribute' => ['cl_id' => 'id_cl']],
            [['pl_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhanLoai::className(), 'targetAttribute' => ['pl_id' => 'id_pl']],
            [['ptn_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongThiNghiem::className(), 'targetAttribute' => ['ptn_id' => 'id_ptn']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ptn_cl' => 'Id Ptn Cl',
            'cl_id' => 'Cl ID',
            'pl_id' => 'Pl ID',
            'ptn_id' => 'Ptn ID',
            'pdkptn_id' => 'Pdkptn ID',
            'tempptn_id' => 'Tempptn ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCl()
    {
        return $this->hasOne(ChungLoai::className(), ['id_cl' => 'cl_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPl()
    {
        return $this->hasOne(PhanLoai::className(), ['id_pl' => 'pl_id']);
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
    public function getTempptn()
    {
        return $this->hasOne(TempPhongthinghiem::className(), ['id_tempptn' => 'tempptn_id']);
    }
}

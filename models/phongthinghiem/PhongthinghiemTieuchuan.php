<?php

namespace app\models\phongthinghiem;
use app\models\danhmuc\phongthinghiem\tieuchuan\TieuChuan;


use Yii;

/**
 * This is the model class for table "phongthinghiem_tieuchuan".
 *
 * @property integer $id_ptn_tc
 * @property integer $ptn_id
 * @property integer $tc_id
 * @property integer $pdkptn_id
 * @property integer $tempptn_id
 *
 * @property PhongThiNghiem $ptn
 * @property TempPhongthinghiem $tempptn
 * @property TieuChuan $tc
 */
class PhongthinghiemTieuchuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phongthinghiem_tieuchuan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ptn_id', 'tc_id', 'pdkptn_id', 'tempptn_id'], 'integer'],
            [['ptn_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongThiNghiem::className(), 'targetAttribute' => ['ptn_id' => 'id_ptn']],
            [['tc_id'], 'exist', 'skipOnError' => true, 'targetClass' => TieuChuan::className(), 'targetAttribute' => ['tc_id' => 'id_tc']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ptn_tc' => 'Id Ptn Tc',
            'ptn_id' => 'Ptn ID',
            'tc_id' => 'Tc ID',
            'pdkptn_id' => 'Pdkptn ID',
            'tempptn_id' => 'Tempptn ID',
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
    public function getTempptn()
    {
        return $this->hasOne(TempPhongthinghiem::className(), ['id_tempptn' => 'tempptn_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTc()
    {
        return $this->hasOne(TieuChuan::className(), ['id_tc' => 'tc_id']);
    }
}

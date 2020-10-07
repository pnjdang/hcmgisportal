<?php

namespace app\models\phongthinghiem;
use app\models\danhmuc\phongthinghiem\tochuchoptac\TochucHoptac;

use app\models\TempPhongthinghiem;
use Yii;

/**
 * This is the model class for table "phongthinghiem_hoptac".
 *
 * @property integer $id_ptn_ht
 * @property integer $ptn_id
 * @property integer $tcht_id
 * @property integer $pdkptn_id
 * @property integer $tempptn_id
 *
 * @property PhongThiNghiem $ptn
 * @property TempPhongthinghiem $tempptn
 * @property TochucHoptac $tcht
 */
class PhongthinghiemHoptac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phongthinghiem_hoptac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ptn_id', 'tcht_id', 'pdkptn_id', 'tempptn_id'], 'integer'],
            [['ptn_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongThiNghiem::className(), 'targetAttribute' => ['ptn_id' => 'id_ptn']],
            [['tcht_id'], 'exist', 'skipOnError' => true, 'targetClass' => TochucHoptac::className(), 'targetAttribute' => ['tcht_id' => 'id_tcht']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ptn_ht' => 'Id Ptn Ht',
            'ptn_id' => 'Ptn ID',
            'tcht_id' => 'Tcht ID',
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
    public function getTcht()
    {
        return $this->hasOne(TochucHoptac::className(), ['id_tcht' => 'tcht_id']);
    }
}

<?php

namespace app\models\phongthinghiem;
use app\models\danhmuc\phongthinghiem\linhvucthunghiem\LinhvucThunghiem;


use app\models\TempPhongthinghiem;
use Yii;

/**
 * This is the model class for table "phongthinghiem_linhvuc".
 *
 * @property integer $id_ptn_lv
 * @property integer $ptn_id
 * @property integer $lv_id
 * @property integer $pdkptn_id
 * @property integer $tempptn_id
 *
 * @property LinhvucThunghiem $lv
 * @property PhongThiNghiem $ptn
 * @property TempPhongthinghiem $tempptn
 */
class PhongthinghiemLinhvuc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phongthinghiem_linhvuc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ptn_id', 'lv_id', 'pdkptn_id', 'tempptn_id'], 'integer'],
            [['lv_id'], 'exist', 'skipOnError' => true, 'targetClass' => LinhvucThunghiem::className(), 'targetAttribute' => ['lv_id' => 'id_lv']],
            [['ptn_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongThiNghiem::className(), 'targetAttribute' => ['ptn_id' => 'id_ptn']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ptn_lv' => 'Id Ptn Lv',
            'ptn_id' => 'Ptn ID',
            'lv_id' => 'Lv ID',
            'pdkptn_id' => 'Pdkptn ID',
            'tempptn_id' => 'Tempptn ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLv()
    {
        return $this->hasOne(LinhvucThunghiem::className(), ['id_lv' => 'lv_id']);
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

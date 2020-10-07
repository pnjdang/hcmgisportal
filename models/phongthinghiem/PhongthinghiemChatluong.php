<?php

namespace app\models\phongthinghiem;

use Yii;
use app\models\danhmuc\phongthinghiem\congnhanchatluong\CongnhanChatluong;
use app\models\TempPhongthinghiem;
/**
 * This is the model class for table "phongthinghiem_chatluong".
 *
 * @property integer $cncl_id
 * @property integer $id_ptn_cncl
 * @property integer $ptn_id
 * @property string $ghi_chu
 * @property integer $pdkptn_id
 * @property integer $tempptn_id
 *
 * @property CongnhanChatluong $cncl
 * @property PhongThiNghiem $ptn
 * @property TempPhongthinghiem $tempptn
 */
class PhongthinghiemChatluong extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phongthinghiem_chatluong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cncl_id', 'ptn_id', 'pdkptn_id', 'tempptn_id'], 'integer'],
            [['ghi_chu'], 'string', 'max' => 500],
            [['cncl_id'], 'exist', 'skipOnError' => true, 'targetClass' => CongnhanChatluong::className(), 'targetAttribute' => ['cncl_id' => 'id_cncl']],
            [['ptn_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongThiNghiem::className(), 'targetAttribute' => ['ptn_id' => 'id_ptn']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cncl_id' => 'Cncl ID',
            'id_ptn_cncl' => 'Id Ptn Cncl',
            'ptn_id' => 'Ptn ID',
            'ghi_chu' => 'Ghi Chu',
            'pdkptn_id' => 'Pdkptn ID',
            'tempptn_id' => 'Tempptn ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCncl()
    {
        return $this->hasOne(CongnhanChatluong::className(), ['id_cncl' => 'cncl_id']);
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

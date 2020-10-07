<?php

namespace app\models\chuyengia;

use Yii;

/**
 * This is the model class for table "chuyengia_linhvucnghiencuu".
 *
 * @property integer $cg_id
 * @property integer $cap1_id
 * @property integer $id_chuyengialinhvucnghiencuu
 * @property integer $pdkcg_id
 *
 * @property ChuyenGia $cg
 * @property LinhvucnghiencuuCap1 $cap1
 * @property PdkChuyengia $pdkcg
 */
class ChuyengiaLinhvucnghiencuu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuyengia_linhvucnghiencuu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cg_id', 'cap1_id', 'pdkcg_id'], 'integer'],
            [['cg_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChuyenGia::className(), 'targetAttribute' => ['cg_id' => 'id_cg']],
            [['cap1_id'], 'exist', 'skipOnError' => true, 'targetClass' => LinhvucnghiencuuCap1::className(), 'targetAttribute' => ['cap1_id' => 'id_cap1']],
            [['pdkcg_id'], 'exist', 'skipOnError' => true, 'targetClass' => PdkChuyengia::className(), 'targetAttribute' => ['pdkcg_id' => 'id_pdkcg']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cg_id' => 'Cg ID',
            'cap1_id' => 'Cap1 ID',
            'id_chuyengialinhvucnghiencuu' => 'Id Chuyengialinhvucnghiencuu',
            'pdkcg_id' => 'Pdkcg ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCg()
    {
        return $this->hasOne(ChuyenGia::className(), ['id_cg' => 'cg_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCap1()
    {
        return $this->hasOne(LinhvucnghiencuuCap1::className(), ['id_cap1' => 'cap1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdkcg()
    {
        return $this->hasOne(PdkChuyengia::className(), ['id_pdkcg' => 'pdkcg_id']);
    }
}

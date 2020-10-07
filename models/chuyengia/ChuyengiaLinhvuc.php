<?php

namespace app\models\chuyengia;

use app\models\danhmuc\chuyengia\linhvucnghiencuucap1\LinhvucnghiencuuCap1;
use app\services\DebugService;
use Yii;

/**
 * This is the model class for table "chuyengia_linhvuc".
 *
 * @property integer $id_chuyengialinhvuc
 * @property integer $chuyengia_id
 * @property integer $cap1_id
 *
 * @property Chuyengia $chuyengia
 * @property LinhvucnghiencuuCap1 $cap1
 */
class ChuyengiaLinhvuc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuyengia_linhvuc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'cap1_id'], 'integer'],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
            [['cap1_id'], 'exist', 'skipOnError' => true, 'targetClass' => LinhvucnghiencuuCap1::className(), 'targetAttribute' => ['cap1_id' => 'id_cap1']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_chuyengialinhvuc' => 'Id Chuyengialinhvuc',
            'chuyengia_id' => 'Chuyengia ID',
            'cap1_id' => 'Cap1 ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengia()
    {
        return $this->hasOne(Chuyengia::className(), ['id_chuyengia' => 'chuyengia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCap1()
    {
        return $this->hasOne(LinhvucnghiencuuCap1::className(), ['id_cap1' => 'cap1_id']);
    }
}

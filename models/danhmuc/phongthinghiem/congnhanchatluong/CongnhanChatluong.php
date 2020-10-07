<?php

namespace app\models\danhmuc\phongthinghiem\congnhanchatluong;

use Yii;

/**
 * This is the model class for table "congnhan_chatluong".
 *
 * @property integer $id_cncl
 * @property string $tieu_chuan
 * @property string $ghi_chu
 *
 * @property PhongThiNghiem[] $phongThiNghiems
 */
class CongnhanChatluong extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'congnhan_chatluong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tieu_chuan', 'ghi_chu'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cncl' => 'Id Cncl',
            'tieu_chuan' => 'Tieu Chuan',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongThiNghiems()
    {
        return $this->hasMany(PhongThiNghiem::className(), ['id_cncl' => 'id_cncl']);
    }
}

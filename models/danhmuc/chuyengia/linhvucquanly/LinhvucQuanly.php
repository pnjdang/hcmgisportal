<?php

namespace app\models\danhmuc\chuyengia\linhvucquanly;
use Yii;

/**
 * This is the model class for table "linhvuc_quanly".
 *
 * @property integer $id_lvql
 * @property string $ten_lvql
 * @property string $ghi_chu
 *
 * @property ChuyenGia[] $chuyenGias
 */
class LinhvucQuanly extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'linhvuc_quanly';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_lvql', 'ghi_chu'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lvql' => 'Id Lvql',
            'ten_lvql' => 'Ten Lvql',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyenGias()
    {
        return $this->hasMany(ChuyenGia::className(), ['id_lvql' => 'id_lvql']);
    }
}

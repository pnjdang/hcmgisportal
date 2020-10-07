<?php

namespace app\models\danhmuc\chuyengia\linhvucnghiencuucap1;

use Yii;

/**
 * This is the model class for table "linhvucnghiencuu_cap1".
 *
 * @property integer $id_cap1
 * @property string $ten_cap1
 * @property string $ma_cap1
 * @property string $ghichu_cap1
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property ChuyengiaLinhvuc[] $chuyengiaLinhvucs
 */
class LinhvucnghiencuuCap1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'linhvucnghiencuu_cap1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_cap1'], 'string', 'max' => 50],
            [['ma_cap1'], 'string', 'max' => 10],
            [['ghichu_cap1'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cap1' => 'Id Cap1',
            'ten_cap1' => 'Lĩnh vực nghiên cứu cấp 1',
            'ma_cap1' => 'Mã cấp 1',
            'ghichu_cap1' => 'Ghi chú',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengiaLinhvucs()
    {
        return $this->hasMany(ChuyengiaLinhvuc::className(), ['cap1_id' => 'id_cap1']);
    }
}

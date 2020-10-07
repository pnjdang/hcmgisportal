<?php

namespace app\models\danhmuc\chuyengia\loaicongtrinhnghiencuu;

use Yii;

/**
 * This is the model class for table "loai_congtrinhnghiencuu".
 *
 * @property string $ten_loaicongtrinh
 * @property integer $id_loaicongtrinh
 * @property string $ghichu_loaicongtrinh
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property ChuyengiaCongtrinh[] $chuyengiaCongtrinhs
 */
class LoaiCongtrinhnghiencuu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loai_congtrinhnghiencuu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_loaicongtrinh', 'ghichu_loaicongtrinh'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ten_loaicongtrinh' => 'Tên loại công trình nghiên cứu',
            'id_loaicongtrinh' => 'Id Loaicongtrinh',
            'ghichu_loaicongtrinh' => 'Ghi chú',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengiaCongtrinhs()
    {
        return $this->hasMany(ChuyengiaCongtrinh::className(), ['loaicongtrinh_id' => 'id_loaicongtrinh']);
    }
}

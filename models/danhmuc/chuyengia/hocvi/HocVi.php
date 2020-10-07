<?php

namespace app\models\danhmuc\chuyengia\hocvi;

use Yii;

/**
 * This is the model class for table "hoc_vi".
 *
 * @property integer $id_hv
 * @property string $ten_hv
 * @property string $ghi_chu
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $created_by
 * @property string $viettat_hv
 *
 * @property ChuyenGia[] $chuyenGias
 * @property PdkChuyengia[] $pdkChuyengias
 */
class HocVi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hoc_vi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'updated_by', 'created_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_hv', 'ghi_chu'], 'string', 'max' => 100],
            [['viettat_hv'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_hv' => 'Id Hv',
            'ten_hv' => 'Ten Hv',
            'ghi_chu' => 'Ghi Chu',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
            'viettat_hv' => 'Viettat Hv',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyenGias()
    {
        return $this->hasMany(ChuyenGia::className(), ['id_hv' => 'id_hv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdkChuyengias()
    {
        return $this->hasMany(PdkChuyengia::className(), ['hv_id' => 'id_hv']);
    }
}

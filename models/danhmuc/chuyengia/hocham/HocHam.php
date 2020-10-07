<?php

namespace app\models\danhmuc\chuyengia\hocham;

use Yii;

/**
 * This is the model class for table "hoc_ham".
 *
 * @property integer $id_hh
 * @property string $ten_hh
 * @property string $ghi_chu
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $viettat_hh
 *
 * @property ChuyenGia[] $chuyenGias
 * @property PdkChuyengia[] $pdkChuyengias
 */
class HocHam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hoc_ham';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_hh', 'ghi_chu'], 'string', 'max' => 100],
            [['viettat_hh'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_hh' => 'Id Hh',
            'ten_hh' => 'Ten Hh',
            'ghi_chu' => 'Ghi Chu',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'viettat_hh' => 'Viettat Hh',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyenGias()
    {
        return $this->hasMany(ChuyenGia::className(), ['id_hh' => 'id_hh']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdkChuyengias()
    {
        return $this->hasMany(PdkChuyengia::className(), ['hh_id' => 'id_hh']);
    }
}

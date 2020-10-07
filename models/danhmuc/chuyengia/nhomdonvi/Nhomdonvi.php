<?php

namespace app\models\danhmuc\chuyengia\nhomdonvi;

use app\models\danhmuc\chuyengia\donvi\Donvi;
use Yii;

/**
 * This is the model class for table "nhomdonvi".
 *
 * @property integer $id_nhomdonvi
 * @property string $ten_nhomdonvi
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $ghi_chu
 *
 * @property DonVi[] $donVis
 */
class Nhomdonvi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nhomdonvi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_nhomdonvi'], 'string', 'max' => 100],
            [['ghi_chu'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_nhomdonvi' => 'Id Nhomdonvi',
            'ten_nhomdonvi' => 'Ten Nhomdonvi',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDonVis()
    {
        return $this->hasMany(Donvi::className(), ['nhomdonvi_id' => 'id_nhomdonvi']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_thongtin".
 *
 * @property integer $id_reportthongtin
 * @property string $truong_du_lieu_sai
 * @property string $thong_tin_dinh_chinh
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $chuyengia_id
 * @property integer $phongthinghiem_id
 */
class ReportThongtin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report_thongtin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'chuyengia_id', 'phongthinghiem_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['truong_du_lieu_sai'], 'string', 'max' => 100],
            [['thong_tin_dinh_chinh'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_reportthongtin' => 'Id Reportthongtin',
            'truong_du_lieu_sai' => 'Truong Du Lieu Sai',
            'thong_tin_dinh_chinh' => 'Thong Tin Dinh Chinh',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'chuyengia_id' => 'Chuyengia ID',
            'phongthinghiem_id' => 'Phongthinghiem ID',
        ];
    }
}

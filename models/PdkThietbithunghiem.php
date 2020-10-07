<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pdk_thietbithunghiem".
 *
 * @property integer $id_pdkthietbithunghiem
 * @property integer $id_pdkptn
 * @property string $ten_thietbi
 * @property string $hang_sx
 * @property string $nuoc_sx
 * @property integer $nam_sx
 * @property string $dactinh_kythuat
 * @property integer $so_luong
 * @property string $ghi_chu
 * @property string $so_hieu
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $thietbi_id
 *
 * @property PdkPhongthinghiem $idPdkptn
 */
class PdkThietbithunghiem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pdk_thietbithunghiem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pdkptn', 'nam_sx', 'so_luong', 'status', 'created_by', 'updated_by', 'thietbi_id'], 'integer'],
            [['dactinh_kythuat'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_thietbi', 'hang_sx'], 'string', 'max' => 200],
            [['nuoc_sx', 'so_hieu'], 'string', 'max' => 100],
            [['ghi_chu'], 'string', 'max' => 500],
            [['id_pdkptn'], 'exist', 'skipOnError' => true, 'targetClass' => PdkPhongthinghiem::className(), 'targetAttribute' => ['id_pdkptn' => 'id_pdkptn']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pdkthietbithunghiem' => 'Id Pdkthietbithunghiem',
            'id_pdkptn' => 'Id Pdkptn',
            'ten_thietbi' => 'Ten Thietbi',
            'hang_sx' => 'Hang Sx',
            'nuoc_sx' => 'Nuoc Sx',
            'nam_sx' => 'Nam Sx',
            'dactinh_kythuat' => 'Dactinh Kythuat',
            'so_luong' => 'So Luong',
            'ghi_chu' => 'Ghi Chu',
            'so_hieu' => 'So Hieu',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'thietbi_id' => 'Thietbi ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPdkptn()
    {
        return $this->hasOne(PdkPhongthinghiem::className(), ['id_pdkptn' => 'id_pdkptn']);
    }
}

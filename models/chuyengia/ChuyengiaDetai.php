<?php

namespace app\models\chuyengia;

use Yii;

/**
 * This is the model class for table "chuyengia_detai".
 *
 * @property integer $id_chuyengiadetai
 * @property integer $chuyengia_id
 * @property string $ten_detai
 * @property integer $nam_batdau
 * @property integer $nam_ketthuc
 * @property integer $tinh_trang
 * @property string $chuong_trinh
 * @property string $xep_loai
 * @property integer $vai_tro
 * @property string $noi_dung
 *
 * @property Chuyengia $chuyengia
 */
class ChuyengiaDetai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuyengia_detai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'nam_batdau', 'nam_ketthuc', 'tinh_trang', 'vai_tro'], 'integer'],
            [['ten_detai', 'chuong_trinh', 'noi_dung'], 'string', 'max' => 500],
            [['xep_loai'], 'string', 'max' => 100],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_chuyengiadetai' => 'Id Chuyengiadetai',
            'chuyengia_id' => 'Chuyengia ID',
            'ten_detai' => 'Tên đề tài',
            'nam_batdau' => 'Nam Batdau',
            'nam_ketthuc' => 'Nam Ketthuc',
            'tinh_trang' => 'Tinh Trang',
            'chuong_trinh' => 'Chuong Trinh',
            'xep_loai' => 'Xep Loai',
            'vai_tro' => 'Vai Tro',
            'noi_dung' => 'Noi Dung',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengia()
    {
        return $this->hasOne(Chuyengia::className(), ['id_chuyengia' => 'chuyengia_id']);
    }
}

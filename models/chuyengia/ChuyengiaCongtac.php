<?php

namespace app\models\chuyengia;

use Yii;

/**
 * This is the model class for table "chuyengia_congtac".
 *
 * @property integer $id_chuyengiacongtac
 * @property integer $chuyengia_id
 * @property string $noi_congtac
 * @property integer $nam_batdau
 * @property integer $nam_ketthuc
 * @property integer $so_thang
 * @property string $vitri_congtac
 * @property string $linhvuc_congtac
 *
 * @property Chuyengia $chuyengia
 */
class ChuyengiaCongtac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuyengia_congtac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'nam_batdau', 'nam_ketthuc', 'so_thang'], 'integer'],
            [['noi_congtac'], 'string', 'max' => 500],
            [['vitri_congtac'], 'string', 'max' => 200],
            [['linhvuc_congtac'], 'string', 'max' => 1000],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_chuyengiacongtac' => 'Id Chuyengiacongtac',
            'chuyengia_id' => 'Chuyengia ID',
            'noi_congtac' => 'Nơi công tác',
            'nam_batdau' => 'Năm bắt đầu',
            'nam_ketthuc' => 'Năm kết thúc',
            'so_thang' => 'Số tháng',
            'vitri_congtac' => 'Vị trí công tác',
            'linhvuc_congtac' => 'Lĩnh vực công tác',
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

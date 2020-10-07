<?php

namespace app\models\danhmuc\chuyengia\linhvucnghiencuucap3;

use app\models\chuyengia\Chuyengia;
use app\models\chuyengia\ChuyengiaChuyennganh;
use app\models\danhmuc\chuyengia\linhvucnghiencuucap2\LinhvucnghiencuuCap2;
use Yii;

/**
 * This is the model class for table "linhvucnghiencuu_cap3".
 *
 * @property integer $id_cap3
 * @property string $ten_cap3
 * @property string $ma_cap3
 * @property string $ghichu_cap3
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $id_cap2
 * @property string $ma_ten_cap3
 *
 * @property ChuyenGia[] $chuyenGias
 * @property ChuyengiaChuyennganh[] $chuyengiaChuyennganhs
 * @property LinhvucnghiencuuCap2 $idCap2
 * @property PdkChuyengia[] $pdkChuyengias
 */
class LinhvucnghiencuuCap3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'linhvucnghiencuu_cap3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by', 'id_cap2'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_cap3', 'ma_ten_cap3'], 'string', 'max' => 700],
            [['ma_cap3'], 'string', 'max' => 10],
            [['ghichu_cap3'], 'string', 'max' => 300],
            [['id_cap2'], 'exist', 'skipOnError' => true, 'targetClass' => LinhvucnghiencuuCap2::className(), 'targetAttribute' => ['id_cap2' => 'id_cap2']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cap3' => 'Id Cap3',
            'ten_cap3' => 'Lĩnh vực nghiên cứu cấp 3',
            'ma_cap3' => 'Mã cấp 3',
            'ghichu_cap3' => 'Ghi chú',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'id_cap2' => 'Id Cap2',
            'ma_ten_cap3' => 'Ma Ten Cap3',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyenGias()
    {
        return $this->hasMany(Chuyengia::className(), ['chuyennganh_id' => 'id_cap3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengiaChuyennganhs()
    {
        return $this->hasMany(ChuyengiaChuyennganh::className(), ['cap3_id' => 'id_cap3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCap2()
    {
        return $this->hasOne(LinhvucnghiencuuCap2::className(), ['id_cap2' => 'id_cap2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdkChuyengias()
    {
        return $this->hasMany(PdkChuyengia::className(), ['chuyennganh_id' => 'id_cap3']);
    }
}

<?php

namespace app\models\danhmuc\chuyengia\linhvucnghiencuucap2;

use app\models\danhmuc\chuyengia\linhvucnghiencuucap1\LinhvucnghiencuuCap1;
use Yii;

/**
 * This is the model class for table "linhvucnghiencuu_cap2".
 *
 * @property integer $id_cap2
 * @property string $ten_cap2
 * @property string $ma_cap2
 * @property string $ghichu_cap2
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $id_cap1
 *
 * @property LinhvucnghiencuuCap1 $idCap1
 * @property LinhvucnghiencuuCap3[] $linhvucnghiencuuCap3s
 */
class LinhvucnghiencuuCap2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'linhvucnghiencuu_cap2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by', 'id_cap1'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_cap2'], 'string', 'max' => 50],
            [['ma_cap2'], 'string', 'max' => 10],
            [['ghichu_cap2'], 'string', 'max' => 200],
            [['id_cap1'], 'exist', 'skipOnError' => true, 'targetClass' => LinhvucnghiencuuCap1::className(), 'targetAttribute' => ['id_cap1' => 'id_cap1']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cap2' => 'Id Cap2',
            'ten_cap2' => 'Lĩnh vực nghiên cứu cấp 2',
            'ma_cap2' => 'Mã cấp 2',
            'ghichu_cap2' => 'Ghi chú',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'id_cap1' => 'Id Cap1',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCap1()
    {
        return $this->hasOne(LinhvucnghiencuuCap1::className(), ['id_cap1' => 'id_cap1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinhvucnghiencuuCap3s()
    {
        return $this->hasMany(LinhvucnghiencuuCap3::className(), ['id_cap2' => 'id_cap2']);
    }
}

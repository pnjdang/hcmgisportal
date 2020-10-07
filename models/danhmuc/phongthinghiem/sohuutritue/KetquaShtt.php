<?php

namespace app\models\danhmuc\phongthinghiem\sohuutritue;

use Yii;

/**
 * This is the model class for table "ketqua_shtt".
 *
 * @property integer $id_ketquashtt
 * @property string $ten_ketquashtt
 * @property string $ghi_chu
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 */
class KetquaShtt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ketqua_shtt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ten_ketquashtt', 'ghi_chu'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ketquashtt' => 'Id Ketquashtt',
            'ten_ketquashtt' => 'Ten Ketquashtt',
            'ghi_chu' => 'Ghi Chu',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
}

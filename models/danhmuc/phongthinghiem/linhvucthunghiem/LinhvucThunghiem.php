<?php

namespace app\models\danhmuc\phongthinghiem\linhvucthunghiem;

use Yii;

/**
 * This is the model class for table "linhvuc_thunghiem".
 *
 * @property integer $id_lv
 * @property string $ten_lv
 * @property string $ghi_chu
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 */
class LinhvucThunghiem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'linhvuc_thunghiem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_lv', 'ghi_chu'], 'string', 'max' => 100],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lv' => 'Id Lv',
            'ten_lv' => 'Ten Lv',
            'ghi_chu' => 'Ghi Chu',
        ];
    }
}

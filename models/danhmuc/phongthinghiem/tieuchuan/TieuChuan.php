<?php

namespace app\models\danhmuc\phongthinghiem\tieuchuan;

use Yii;

/**
 * This is the model class for table "tieu_chuan".
 *
 * @property integer $id_tc
 * @property string $ten_tc
 * @property string $ghi_chu
 */
class TieuChuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tieu_chuan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_tc', 'ghi_chu'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tc' => 'Id Tc',
            'ten_tc' => 'Ten Tc',
            'ghi_chu' => 'Ghi Chu',
        ];
    }
}

<?php

namespace app\models\danhmuc\phongthinghiem\tochuchoptac;

use Yii;

/**
 * This is the model class for table "tochuc_hoptac".
 *
 * @property integer $id_tcht
 * @property string $ten_tc
 * @property string $ghi_chu
 */
class TochucHoptac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tochuc_hoptac';
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
            'id_tcht' => 'Id Tcht',
            'ten_tc' => 'Ten Tc',
            'ghi_chu' => 'Ghi Chu',
        ];
    }
}

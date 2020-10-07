<?php

namespace app\models\danhmuc\chuyengia\ngoaingu;

use app\models\chuyengia\ChuyengiaNgoaingu;
use Yii;

/**
 * This is the model class for table "ngoaingu".
 *
 * @property integer $id_ngoaingu
 * @property string $ten_ngoaingu
 * @property string $ghichu_ngoaingu
 *
 * @property ChuyengiaNgoaingu[] $chuyengiaNgoaingus
 */
class Ngoaingu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ngoaingu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_ngoaingu'], 'string', 'max' => 50],
            [['ghichu_ngoaingu'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ngoaingu' => 'Id Ngoaingu',
            'ten_ngoaingu' => 'Ngoại ngữ',
            'ghichu_ngoaingu' => 'Ghi chú',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengiaNgoaingus()
    {
        return $this->hasMany(ChuyengiaNgoaingu::className(), ['ngoaingu_id' => 'id_ngoaingu']);
    }
}

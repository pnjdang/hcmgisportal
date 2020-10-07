<?php

namespace app\models\chuyengia;

use Yii;

/**
 * This is the model class for table "chuyengia_daotao".
 *
 * @property integer $id_chuyengiadaotao
 * @property integer $chuyengia_id
 * @property string $noi_daotao
 * @property string $trinhdo_daotao
 * @property integer $nam_totnghiep
 * @property string $chuyennganh_daotao
 *
 * @property Chuyengia $chuyengia
 */
class ChuyengiaDaotao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuyengia_daotao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'nam_totnghiep'], 'integer'],
            [['noi_daotao', 'trinhdo_daotao', 'chuyennganh_daotao'], 'string', 'max' => 200],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_chuyengiadaotao' => 'Id Chuyengiadaotao',
            'chuyengia_id' => 'Chuyengia ID',
            'noi_daotao' => 'Nơi đào tạo',
            'trinhdo_daotao' => 'Trình độ',
            'nam_totnghiep' => 'Năm tốt nghiệp',
            'chuyennganh_daotao' => 'Chuyên ngành đào tạo',
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

<?php

namespace app\models\chuyengia;

use app\models\danhmuc\chuyengia\linhvucnghiencuucap3\LinhvucnghiencuuCap3;
use app\services\DebugService;
use Yii;

/**
 * This is the model class for table "chuyengia_chuyennganh".
 *
 * @property integer $id_chuyengiachuyennganh
 * @property integer $chuyengia_id
 * @property integer $cap3_id
 *
 * @property Chuyengia $chuyengia
 * @property LinhvucnghiencuuCap3 $cap3
 */
class ChuyengiaChuyennganh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuyengia_chuyennganh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'cap3_id'], 'integer'],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
            [['cap3_id'], 'exist', 'skipOnError' => true, 'targetClass' => LinhvucnghiencuuCap3::className(), 'targetAttribute' => ['cap3_id' => 'id_cap3']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_chuyengiachuyennganh' => 'Id Chuyengiachuyennganh',
            'chuyengia_id' => 'Chuyengia ID',
            'cap3_id' => 'Cap3 ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChuyengia()
    {
        return $this->hasOne(Chuyengia::className(), ['id_chuyengia' => 'chuyengia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCap3()
    {
        return $this->hasOne(LinhvucnghiencuuCap3::className(), ['id_cap3' => 'cap3_id']);
    }

}

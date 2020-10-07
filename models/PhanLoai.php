<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phan_loai".
 *
 * @property integer $id_pl
 * @property integer $id_cl
 * @property string $ten_pl
 * @property string $ghi_chu
 *
 * @property ChungLoai $idCl
 * @property PhongthinghiemChungloai[] $phongthinghiemChungloais
 */
class PhanLoai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phan_loai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cl'], 'integer'],
            [['ten_pl'], 'string', 'max' => 300],
            [['ghi_chu'], 'string', 'max' => 500],
            [['id_cl'], 'exist', 'skipOnError' => true, 'targetClass' => ChungLoai::className(), 'targetAttribute' => ['id_cl' => 'id_cl']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pl' => 'Id Pl',
            'id_cl' => 'Id Cl',
            'ten_pl' => 'Ten Pl',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCl()
    {
        return $this->hasOne(ChungLoai::className(), ['id_cl' => 'id_cl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongthinghiemChungloais()
    {
        return $this->hasMany(PhongthinghiemChungloai::className(), ['pl_id' => 'id_pl']);
    }
}

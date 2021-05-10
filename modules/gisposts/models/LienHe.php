<?php

namespace app\modules\gisposts\models;

use Yii;

/**
 * This is the model class for table "lien_he".
 *
 * @property int $id
 * @property string|null $hoten Họ tên
 * @property string|null $email Email
 * @property string|null $dienthoai Điện thoại
 * @property string|null $chude Chủ đề
 * @property string|null $noidung Nội dung
 * @property string|null $created_at
 */
class LienHe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lien_he';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noidung'], 'string'],
            [['created_at'], 'safe'],
            [['hoten', 'email', 'dienthoai', 'chude'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hoten' => Yii::t('app', 'Họ tên'),
            'email' => Yii::t('app', 'Email'),
            'dienthoai' => Yii::t('app', 'Điện thoại'),
            'chude' => Yii::t('app', 'Chủ đề'),
            'noidung' => Yii::t('app', 'Nội dung'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}

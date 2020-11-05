<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lienhe".
 *
 * @property int $id_lienhe
 * @property string $ho_ten
 * @property string $email
 * @property string $dien_thoai
 * @property string $noi_dung
 * @property string $created_at
 * @property string $reply
 * @property string $replied_at
 * @property string $created_by
 * @property string $replied_by
 * @property string $noi_dung_reply
 */
class Lienhe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lienhe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ho_ten', 'email', 'dien_thoai', 'noi_dung'], 'required'],
            [['email'],'email'],
            [['noi_dung', 'reply', 'noi_dung_reply'], 'string'],
            [['created_at', 'replied_at'], 'safe'],
            [['ho_ten', 'email', 'dien_thoai', 'created_by', 'replied_by'], 'string', 'max' => 50],
            [['noi_dung'], 'string', 'min' => 10]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lienhe' => 'Id Lienhe',
            'ho_ten' => 'Họ và Tên',
            'email' => 'Email',
            'dien_thoai' => 'Điện Thoại',
            'noi_dung' => 'Nội dung',
            'created_at' => 'Ngày tạo',
            'reply' => 'Reply',
            'replied_at' => 'Ngày trả lời',
            'created_by' => 'Tạo bởi',
            'replied_by' => 'Trả lời bởi',
            'noi_dung_reply' => 'Nội dung trả lời',
        ];
    }
}

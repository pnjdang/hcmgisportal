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
 * @property string|null $reply
 * @property string|null $replied_at
 * @property string|null $created_by
 * @property string|null $replied_by
 * @property string|null $noi_dung_reply
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
            [['reply', 'noi_dung_reply'], 'string'],
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
            'ho_ten' => 'Ho Ten',
            'email' => 'Email',
            'dien_thoai' => 'Dien Thoai',
            'noi_dung' => 'Noi Dung',
            'created_at' => 'Created At',
            'reply' => 'Reply',
            'replied_at' => 'Replied At',
            'created_by' => 'Created By',
            'replied_by' => 'Replied By',
            'noi_dung_reply' => 'Noi Dung Reply',
        ];
    }
}

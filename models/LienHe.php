<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lien_he".
 *
 * @property integer $id_lienhe
 * @property string $ho_ten
 * @property string $email
 * @property string $dien_thoai
 * @property string $noi_dung
 * @property string $created_at
 * @property integer $reply
 * @property string $replied_at
 * @property integer $created_by
 * @property integer $replied_by
 * @property string $noi_dung_reply
 */
class LienHe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lienhe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['noi_dung'], 'string'],
            [['created_at', 'replied_at'], 'safe'],
            [['reply', 'created_by', 'replied_by'], 'integer'],
            [['ho_ten', 'email'], 'string', 'max' => 200],
            [['dien_thoai'], 'string', 'max' => 50],
            [['noi_dung_reply'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
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

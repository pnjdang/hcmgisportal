<?php

namespace app\models\chuyengia;

use app\models\danhmuc\chuyengia\ngoaingu\Ngoaingu;
use Yii;

/**
 * This is the model class for table "chuyengia_ngoaingu".
 *
 * @property integer $id_chuyengiangoaingu
 * @property integer $chuyengia_id
 * @property integer $ngoaingu_id
 * @property string $nghe
 * @property string $noi
 * @property string $doc
 * @property string $viet
 *
 * @property Chuyengia $chuyengia
 * @property Ngoaingu $ngoaingu
 */
class ChuyengiaNgoaingu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chuyengia_ngoaingu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'ngoaingu_id'], 'integer'],
            [['nghe', 'noi', 'doc', 'viet'], 'string', 'max' => 20],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
            [['ngoaingu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ngoaingu::className(), 'targetAttribute' => ['ngoaingu_id' => 'id_ngoaingu']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_chuyengiangoaingu' => 'Id Chuyengiangoaingu',
            'chuyengia_id' => 'Chuyengia ID',
            'ngoaingu_id' => 'Ngoaingu ID',
            'nghe' => 'Nghe',
            'noi' => 'Nói',
            'doc' => 'Đọc',
            'viet' => 'Viết',
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
    public function getNgoaingu()
    {
        return $this->hasOne(Ngoaingu::className(), ['id_ngoaingu' => 'ngoaingu_id']);
    }
}

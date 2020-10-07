<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_thietbi".
 *
 * @property integer $id_filethietbi
 * @property integer $id_ptn
 * @property string $duong_dan
 * @property string $created_at
 * @property integer $status
 */
class FileThietbi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_thietbi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ptn', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['duong_dan'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_filethietbi' => 'Id Filethietbi',
            'id_ptn' => 'Id Ptn',
            'duong_dan' => 'Duong Dan',
            'created_at' => 'Created At',
            'status' => 'Status',
        ];
    }
}

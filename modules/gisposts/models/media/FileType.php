<?php

namespace app\modules\gisposts\models\media;

use Yii;

/**
 * This is the model class for table "file_type".
 *
 * @property int $id
 * @property string|null $type_name
 */
class FileType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_name' => Yii::t('app', 'Type Name'),
        ];
    }
}

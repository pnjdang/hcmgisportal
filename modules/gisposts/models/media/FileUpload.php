<?php

namespace app\modules\gisposts\models\media;

use Yii;

/**
 * This is the model class for table "file_upload".
 *
 * @property int $id
 * @property string|null $file_name
 * @property string|null $file_path
 * @property string|null $file_caption
 * @property string|null $file_type
 * @property string|null $file_slug
 * @property string|null $uploaded_at
 */
class FileUpload extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_upload';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name', 'file_path', 'file_caption', 'file_slug'], 'string'],
            [['uploaded_at'], 'safe'],
            [['file_type'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file_name' => Yii::t('app', 'File Name'),
            'file_path' => Yii::t('app', 'File Path'),
            'file_caption' => Yii::t('app', 'File Caption'),
            'file_type' => Yii::t('app', 'File Type'),
            'file_slug' => Yii::t('app', 'File Slug'),
            'uploaded_at' => Yii::t('app', 'Uploaded At'),
        ];
    }
}

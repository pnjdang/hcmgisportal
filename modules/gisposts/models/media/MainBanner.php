<?php

namespace app\modules\gisposts\models\media;

use Yii;

/**
 * This is the model class for table "main_banner".
 *
 * @property int $id
 * @property string|null $file_path
 * @property string|null $file_name
 * @property string|null $file_caption
 * @property string|null $file_description
 * @property string|null $uploaded_at
 * @property string|null $banner_position
 * @property boolean $banner_status
 */
class MainBanner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_path', 'file_name', 'file_caption', 'file_description'], 'string'],
            [['uploaded_at'], 'safe'],
            [['banner_status'], 'boolean'],
            [['banner_position'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file_path' => Yii::t('app', 'File Path'),
            'file_name' => Yii::t('app', 'File Name'),
            'file_caption' => Yii::t('app', 'File Caption'),
            'file_description' => Yii::t('app', 'File Description'),
            'uploaded_at' => Yii::t('app', 'Uploaded At'),
            'banner_position' => Yii::t('app', 'Banner Position'),
        ];
    }
}

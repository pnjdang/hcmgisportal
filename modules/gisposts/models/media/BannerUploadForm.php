<?php

namespace app\modules\gisposts\models\media;

use app\services\DebugService;
use app\services\UtilService;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use Yii;

class BannerUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;
    public $file_name;
    public $file_caption;
    public $file_status;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc,docx,png, jpg', 'maxSize' => 1024 * 1024 * 10],
            [['file_name', 'file_caption'], 'string'],
            [['file_status'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file_name' => Yii::t('app', 'File Name'),
            'file_caption' => Yii::t('app', 'File Caption'),
        ];
    }

    public function uploadFile()
    {
        $fileupload = new MainBanner();
        $fileupload->file_name = $this->file_name;
        $fileupload->file_caption = $this->file_caption;


        if ($this->validate()) {
            $path = "uploads/files/banners/";

            if (!is_dir($path)) {
                FileHelper::createDirectory($path);
            }

            date_default_timezone_set('Asia/Ho_chi_minh');
            $fileupload->uploaded_at = date('Y-m-d H:i:s');
            $fileupload->banner_status = $this->file_status;
            $fileupload->file_path = $path . $this->file->baseName . '.' . $this->file->extension;
            if ($fileupload->save()) {
                $this->file->saveAs($path . $this->file->baseName . '.' . $this->file->extension);
                return true;
            } else {
                return false;
            }
        } else {
            DebugService::dumpdie($this->getErrors());
            return false;
        }
    }
}


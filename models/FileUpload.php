<?php
namespace app\models;

use app\services\DebugService;
use app\services\UtilService;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class FileUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'xlsx', 'maxSize' => 1024 * 1024 * 10],

        ];
    }

    public function uploadFile()
    {
        if ($this->validate()) {
            if (!is_dir('uploads/file/import/')) {
                $path = 'uploads/file/import/';
                FileHelper::createDirectory($path);
            }
            $this->file->saveAs('uploads/file/import/' .$this->file->baseName. '.' . $this->file->extension);
            return true;
        } else {
            DebugService::dumpdie($this->getErrors());
            return false;
        }
    }
}


<?php
namespace app\models;

use app\services\DebugService;
use app\services\UtilService;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ThietbiUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $thietbi;

    public function rules()
    {
        return [
            [['thietbi'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, pdf, png, xls, xlsx, doc, docx', 'maxSize' => 1024 * 1024 * 10],

        ];
    }

    public function uploadThietbi($id)
    {

        if ($this->validate()) {
            if (!is_dir('uploads/phongthinghiem/' . $id . '/thietbi/')) {
                $path = 'uploads/phongthinghiem/' . $id . '/thietbi/';
                FileHelper::createDirectory($path);
            }

            $this->thietbi->saveAs('uploads/phongthinghiem/' . $id . '/' .$this->thietbi->baseName. '.' . $this->thietbi->extension);
            $taikhoan->duong_dan = 'uploads/users/avatar/' . $ten_dang_nhap . '/'.$this->anhdaidien->baseName. '.' . $this->anhdaidien->extension;
            $taikhoan->save();
            return true;
        } else {
            DebugService::dumpdie($this->getErrors());
            return false;
        }
    }
}


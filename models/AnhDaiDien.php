<?php
namespace app\models;

use app\services\DebugService;
use app\services\UtilService;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class AnhDaiDien extends Model
{
    /**
     * @var UploadedFile
     */
    public $anhdaidien;

    public function rules()
    {
        return [
            [['anhdaidien'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png', 'maxSize' => 1024 * 1024 * 10],

        ];
    }

    public function uploadAnhDaiDien($ten_dang_nhap,$id)
    {

        if ($this->validate()) {
            if (!is_dir('uploads/users/avatar/' . $ten_dang_nhap . '/')) {
                $path = 'uploads/users/avatar/' . $ten_dang_nhap . '/';
                FileHelper::createDirectory($path);
            }
            $taikhoan = TaiKhoan::findOne(['id_taikhoan' => $id]);
            if($taikhoan->duong_dan != null){
                unlink($taikhoan->duong_dan);
            }
            $this->anhdaidien->saveAs('uploads/users/avatar/' . $ten_dang_nhap . '/' .$this->anhdaidien->baseName. '.' . $this->anhdaidien->extension);
            $taikhoan->duong_dan = 'uploads/users/avatar/' . $ten_dang_nhap . '/'.$this->anhdaidien->baseName. '.' . $this->anhdaidien->extension;
            $taikhoan->save();
            return true;
        } else {
            DebugService::dumpdie($this->getErrors());
            return false;
        }
    }
}


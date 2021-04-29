<?php
namespace app\modules\quanly\models\tailieu;

use app\modules\quanly\models\ho\ThongTinHo;
use app\services\DebugService;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $a;

    public function rules()
    {
        return [
            [['a'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => 1024 * 1024 * 15],

        ];
    }

    public function uploadFile($so_luu_kho, $id_tailieu, $ma)
    {
        date_default_timezone_set('Asia/Ho_chi_minh');
        if ($this->validate()) {
            if (!is_dir('uploads/tailieu/' . $so_luu_kho . '/')) {
                $path = 'uploads/tailieu/' . $so_luu_kho . '/';
                FileHelper::createDirectory($path);
            }
            if(!is_numeric($ma)) {
                $ma = 6;
            }
            $ho = ThongTinHo::findOne(['so_luu_kho' => $so_luu_kho]);
            $tailieu = TaiLieu::findOne(['id_tailieu' => $id_tailieu]);
            $this->a->saveAs('uploads/tailieu/' . $so_luu_kho . '/' . ($so_luu_kho) . '_' . $ma . '_' . $tailieu->id_tailieu . '.' . $this->a->extension);
            $tailieu->id_ho = $ho->id_ho;

            $tailieu->duong_dan = 'uploads/tailieu/' . $so_luu_kho . '/' . $so_luu_kho . '_' . $ma . '_' . $tailieu->id_tailieu . '.' . $this->a->extension;
            $tailieu->so_luu_kho = $so_luu_kho;
            $tailieu->save();
            return true;
        } else {
            DebugService::dumpdie($this->getErrors());
            return false;
        }
    }
}


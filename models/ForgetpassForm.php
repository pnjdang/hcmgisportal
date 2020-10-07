<?php

namespace app\models;

use app\services\DebugService;
use app\services\UtilityService;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ForgetpassForm extends Model
{
    public $ten_dang_nhap;
    public $email;
    public $captcha;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_dang_nhap','email'], 'trim'],
            [['ten_dang_nhap','email'], 'required','message' => 'Thông tin bắt buộc.'],
            ['email', 'email','message' => 'Email không đúng định dạng.'],
            [['captcha'], 'captcha'],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function sendrequest()
    {
        date_default_timezone_set('Asia/Ho_chi_minh');
        if(TaiKhoan::findByUsername($this->ten_dang_nhap) != null){
            UtilityService::alert('tendangnhap');
            return false;
        }
        if(TaiKhoan::findOne(['email' => $this->email]) != null){
            UtilityService::alert('email');
            return false;
        }
        if ($this->validate()) {
            $taikhoan = new TaiKhoan();
            $taikhoan->ten_dang_nhap = $this->ten_dang_nhap;
            $taikhoan->mat_khau = md5($this->password.'@hcmgis#');
            $taikhoan->email = $this->email;
            $taikhoan->id_loaitk = 3;
            $taikhoan->ho_ten = $this->hoten;
            $taikhoan->dien_thoai = $this->dienthoai;
            $taikhoan->admin = false;
            $taikhoan->status = 1;
            $taikhoan->create_at = date('Y-m-d H:i:s');
            $taikhoan->save();
            return true;
        } else {
            return false;
        }
    }
}

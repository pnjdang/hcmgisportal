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
class SignupForm extends Model
{
    public $ten_dang_nhap;
    public $email;
    public $password;
    public $retypepassword;
    public $hoten;
    public $dienthoai;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_dang_nhap','password','retypepassword','email','hoten','dienthoai'], 'trim'],
            [['ten_dang_nhap','password','retypepassword','email','hoten','dienthoai'], 'required','message' => 'Thông tin bắt buộc.'],
            ['ten_dang_nhap', 'unique', 'targetClass' => 'app\Models\TaiKhoan', 'message' => 'Tên đăng nhập đã được sử dụng.'],
            ['ten_dang_nhap', 'string', 'min' => 2, 'max' => 255],

            ['email', 'email','message' => 'Email không đúng định dạng.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\Models\TaiKhoan', 'message' => 'Email đã được sử dụng.'],

            ['password', 'string', 'min' => 8,'tooShort' => 'Mật khẩu phải có tối thiểu 8 ký tự'],
            [['retypepassword'], 'compare', 'compareAttribute' => 'password','message' => 'Mật khẩu không chính xác.']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
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
            $taikhoan->tinh_trang = 1;
            $taikhoan->status = 1;
            $taikhoan->create_at = date('Y-m-d H:i:s');
            $taikhoan->auth_key = Yii::$app->security->generateRandomString();
            $taikhoan->save();
            return true;
        } else {
            return false;
        }
    }
}

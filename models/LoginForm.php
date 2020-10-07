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
class LoginForm extends Model
{
    public $ten_dang_nhap;
    public $mat_khau;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['ten_dang_nhap', 'mat_khau'], 'string'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['mat_khau', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($password, $username)
    {
        $taikhoan = TaiKhoan::findByUsername($username);
        if($taikhoan == null){
            return false;
        } else {
            if($taikhoan->mat_khau == md5($password.'@hcmgis#')){
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validatePassword($this->mat_khau, $this->ten_dang_nhap)) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = TaiKhoan::findByUsername($this->ten_dang_nhap);
        }

        return $this->_user;
    }

    public function checkUsername(){
        $taikhoan = Taikhoan::findByUsername($this->ten_dang_nhap);
        if($taikhoan == null){
            return false;
        } else {
            if($taikhoan->tinh_trang == 0 || $taikhoan->tinh_trang == -1){
                UtilityService::alert('locked');
                return false;
            } else {
                return true;
            }

        }
    }
    public function checkPassword(){
        if(Taikhoan::findByUsername($this->ten_dang_nhap)->mat_khau == md5($this->mat_khau.'@hcmgis#')){
            return true;
        } else {
            return false;
        }
    }
}

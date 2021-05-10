<?php

namespace app\modules\gisposts\models\auth;

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
            [['ten_dang_nhap', 'mat_khau'], 'string',],
            [['ten_dang_nhap'], 'required', 'message' => 'Username is required'],
            [['mat_khau'], 'required', 'message' => 'Password is required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['ten_dang_nhap', 'validateUsername'],
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

    public function validateUsername($attribute, $username)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                $this->addError($attribute, 'Username is not exist!');
            }
        }
    }

    public function validatePassword($attribute, $username)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !($user->mat_khau == md5($this->mat_khau.'@hcmgis#'))) {
                $this->addError($attribute, 'Password is incorrect!');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 3600 * 24 * 30);
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

<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class DoiMatKhau extends Model
{
    public $captcha;
    public $newpassword;
    public $confirm;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['password', 'confirm', 'newpassword', 'captcha'], 'required'],
            [['captcha'], 'captcha'],
            [['confirm', 'newpassword'], 'string', 'min' => 6],
            [['confirm'], 'compare', 'compareAttribute' => 'newpassword']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword(md5($this->password))) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function change() {
        if ($this->validate()) {
            if($this->validatePassword($this->password)){
                $this->addError($this->password, 'Incorrect username or password.');

            }

        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() {
        $user = TaiKhoan::findOne(['id_taikhoan' => Yii::$app->user->id]);
        return $user;
    }

    public function changePassword(){
        $user = $this->getUser();
        if($user->mat_khau == md5($this->password)){
            $user->mat_khau = $this->newpassword;
            $user->save();
            return true;
        } else {
            return false;
        }
    }



    public function attributeLabels()
    {
        return [
            'newpassword' => 'Mật khẩu mới',
            'password' => 'Mật khẩu',
            'confirm' => 'Xác nhận mật khẩu mới',
        ];
    }
}

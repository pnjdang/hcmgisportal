<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tai_khoan".
 *
 * @property integer $id_taikhoan
 * @property string $ten_dang_nhap
 * @property string $mat_khau
 * @property integer $id_loaitk
 * @property string $ho_ten
 * @property string $dia_chi
 * @property boolean $admin
 * @property string $email
 * @property string $dien_thoai
 * @property integer $tinh_trang
 * @property string $lan_dang_nhap_cuoi
 * @property string $auth_key
 * @property string $create_at
 * @property string $update_at
 * @property integer $status
 * @property string $duong_dan
 */
class TaiKhoan extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tai_khoan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_loaitk', 'tinh_trang','status'], 'integer'],
            [['admin'], 'boolean'],
            [['lan_dang_nhap_cuoi', 'create_at', 'update_at'], 'safe'],
            [['ten_dang_nhap'], 'string', 'max' => 50],
            [['ten_dang_nhap','mat_khau','ho_ten','email'],'required','message' => 'Trường dữ liệu bắt buộc'],
            [['mat_khau', 'ho_ten', 'dia_chi', 'email', 'dien_thoai', 'auth_key','duong_dan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_taikhoan' => 'Id Taikhoan',
            'ten_dang_nhap' => 'Ten Dang Nhap',
            'mat_khau' => 'Mat Khau',
            'id_loaitk' => 'Id Loaitk',
            'ho_ten' => 'Ho Ten',
            'dia_chi' => 'Dia Chi',
            'admin' => 'Admin',
            'email' => 'Email',
            'dien_thoai' => 'Dien Thoai',
            'tinh_trang' => 'Tinh Trang',
            'lan_dang_nhap_cuoi' => 'Lan Dang Nhap Cuoi',
            'auth_key' => 'Auth Key',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'status' => 'Status',
            'duong_dan' => 'Duong dan',
        ];
    }

    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id_taikhoan;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        return $this->authKey;
    }

    public static function findIdentity($id){
        return TaiKhoan::findOne(['id_taikhoan' => $id]);
    }

    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public static function findByUsername($username){
        return TaiKhoan::findOne(['ten_dang_nhap' => $username]);
    }

    public function getLoaitaikhoan(){
        return LoaiTaikhoan::findOne(['id_loaitk' => $this->id_loaitk])->ten_loaitk;
    }
}

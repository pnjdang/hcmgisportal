<?php

namespace app\services;

use Yii;
use yii\base\Exception;


class MailService
{

    public static function sendEmail($emailto, $title, $template, $model)
    {
        try {
            if (!filter_var($emailto, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            Yii::$app->mailer->compose($template, $model)
                ->setFrom('eiso.hcmgis@gmail.com')
                ->setTo($emailto)
                ->setSubject($title)
                ->send();
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

//    public static function sendSignUpEmail($user)
//    {
//        $user['nguoi_nop_hs'] = \app\models\NguoiNopHs::findOne($user['id'])->attributes;
//        $user['cfg'] = ConfigService::getConfigData();
//        try {
//            self::sendEmail($user['username'], $user['cfg']['email_tieu_de'] . ' - Xác nhận đăng ký thành viên', 'xacnhandangky', $user);
//        } catch (Exception $ex) {
//            throw $ex;
//        }
//    }
//
//    public static function sendSubmitDon($user, $don)
//    {
//
//    }
//
//    public static function sendResetPasswordEmail($user)
//    {
//        $user['nguoi_nop_hs'] = \app\models\NguoiNopHs::findOne($user['id'])->attributes;
//        $user['cfg'] = ConfigService::getConfigData();
//        try {
//            self::sendEmail($user['username'], $user['cfg']['email_tieu_de'] . ' - Thiết lập mật khẩu mới', 'resetmatkhau', $user);
//        } catch (Exception $ex) {
//            throw $ex;
//        }
//    }
//
//    public static function sendBienNhanHoso($user, $don)
//    {
//        $nguoi_nop_hs = \app\models\NguoiNopHs::findOne($user['id']);
//        $user['nguoi_nop_hs'] = isset($nguoi_nop_hs) ? $nguoi_nop_hs->attributes : [];
//
//        $don['ngay_nhan'] = UtilsService::reverseDateTime($don['ngay_nhan']);
//        $don['ngay_hen_tra'] = UtilsService::reverseDate($don['ngay_hen_tra']);
//
//        $user['don'] = $don;
//        $user['cfg'] = ConfigService::getConfigData();
//        try {
//            if (self::sendEmail($user['username'], $user['cfg']['email_tieu_de'] . ' - Số biên nhận ' . $don['so_bien_nhan'], 'biennhanhoso', $user)) {
//                UtilsService::pushMessage(UtilsService::$_M_SUCCESS, 'Gửi biên nhận đến ' . $user['username'] . ' thành công.');
//            } else {
//                UtilsService::pushMessage(UtilsService::$_M_ERROR, 'Gửi biên nhận đến ' . $user['username'] . ' không thành công.');
//            }
//        } catch (Exception $ex) {
//            throw $ex;
//        }
//    }
//
//    public static function sendDonHoanThanh($user, $don)
//    {
//        $nguoi_nop_hs = \app\models\NguoiNopHs::findOne($user['id']);
//        $user['nguoi_nop_hs'] = isset($nguoi_nop_hs) ? $nguoi_nop_hs->attributes : [];
//
//        $user['don'] = $don;
//        $user['cfg'] = ConfigService::getConfigData();
//        try {
//            if (self::sendEmail($user['username'], $user['cfg']['email_tieu_de'] . ' - Thông báo nhận hồ sơ ' . $don['so_bien_nhan'], 'trahoso', $user)) {
//                UtilsService::pushMessage(UtilsService::$_M_SUCCESS, 'Gửi thông báo nhận hồ sơ đến ' . $user['username'] . ' thành công.');
//            } else {
//                UtilsService::pushMessage(UtilsService::$_M_ERROR, 'Gửi thông báo nhận hồ sơ đến ' . $user['username'] . ' không thành công.');
//            }
//        } catch (Exception $ex) {
//            throw $ex;
//        }
//    }
//
//    public static function sendDonTraKQ($user, $don)
//    {
//
//    }
//
//    public static function sendThamDinh($user, $don)
//    {
//        $nguoi_nop_hs = \app\models\NguoiNopHs::findOne($user['id']);
//        $user['nguoi_nop_hs'] = isset($nguoi_nop_hs) ? $nguoi_nop_hs->attributes : [];
//
//        $user['don'] = $don;
//        $user['cfg'] = ConfigService::getConfigData();
//        try {
//            if (self::sendEmail($user['username'], '[TPHCM-SoKH&CN] Kết quả thẩm định hồ sơ ' . $don['so_bien_nhan'], 'thamdinhhoso', $user)) {
//                UtilsService::pushMessage(UtilsService::$_M_SUCCESS, 'Gửi kết quả thẩm định đến ' . $user['username'] . ' thành công.');
//            } else {
//                UtilsService::pushMessage(UtilsService::$_M_ERROR, 'Gửi kết quả thẩm định đến ' . $user['username'] . ' không thành công.');
//            }
//        } catch (Exception $ex) {
//            throw $ex;
//        }
//    }

    public static function sendPhanhoi($email, $title, $content)
    {
        $body = $content;
        $foot = "<br>Trân trọng<br><br>

<b>SỞ KHOA HỌC VÀ CÔNG NGHỆ THÀNH PHỐ HỒ CHÍ MINH </b><br>
Địa chỉ: 244 Điện Biên Phủ, P.7, Q.3, TP. Hồ Chí Minh<br>
Điện thoại: 08 3932 7831<br>
";
        Yii::$app->mailer->compose()
            ->setFrom('eiso.hcmgis@gmail.com')
            ->setTo($email)
            ->setSubject($title)
            ->setHtmlBody($body . $foot)
            ->send();
        return true;
    }

    public static function sendQuenmatkhau($email, $ho_ten, $code)
    {
        $link = 'http://dkdetai.hcmgis.vn/cap-lai-mat-khau?email='.$email.'&code='.$code;
        $body = 'Xin chào ' . $ho_ten . ', <br>Hệ thống vừa nhận được yêu cầu cấp lại mật khẩu của anh/chị!';
        $body .= '<br>Vui lòng click vào đường dẫn dưới đây để tiếp tục:<br><a href="'.$link.'">';
        $body .= $link.'</a><br>';
        $foot = "<br>Trân trọng<br><br>

<b>SỞ KHOA HỌC VÀ CÔNG NGHỆ THÀNH PHỐ HỒ CHÍ MINH </b><br>
Địa chỉ: 244 Điện Biên Phủ, P.7, Q.3, TP. Hồ Chí Minh<br>
Điện thoại: 08 3932 7831<br>
";
        Yii::$app->mailer->compose()
            ->setFrom('eiso.hcmgis@gmail.com')
            ->setTo($email)
            ->setSubject('dkdetai.hcmgis.vn - Khôi phục mật khẩu')
            ->setHtmlBody($body . $foot)
            ->send();
        return true;
    }

    public static function sendDangkythanhcong($email, $ho_ten, $ma_pdk)
    {
        $body = 'Xin chào ' . $ho_ten . ', <br>Anh/chị vừa gửi thành công phiếu đăng ký thực hiện đề tài khoa học công nghệ!';
        $body .= '<br> Mã phiếu đăng ký của anh/chị là '.$ma_pdk;
        $foot = "<br>Trân trọng<br><br>

<b>SỞ KHOA HỌC VÀ CÔNG NGHỆ THÀNH PHỐ HỒ CHÍ MINH </b><br>
Địa chỉ: 244 Điện Biên Phủ, P.7, Q.3, TP. Hồ Chí Minh<br>
Điện thoại: 08 3932 7831<br>
";
        Yii::$app->mailer->compose()
            ->setFrom('eiso.hcmgis@gmail.com')
            ->setTo($email)
            ->setSubject('dkdetai.hcmgis.vn - Đăng ký thành công')
            ->setHtmlBody($body . $foot)
            ->send();
        return true;
    }
}

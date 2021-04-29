<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/7/2021
 * Time: 8:23 AM
 */

use app\modules\DCrud\DCrudAsset;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

DCrudAsset::register($this);

?>

<div class="row">
    <div class="col-lg-12">
        <h3 class="uppercase" style="text-align: center">
            <b>Hợp đồng thuê nhà ở thuộc sở hữu nhà nước</b><br>
            <?= $model['hopdong']->so_hop_dong . ' - ' ?>
            <?= $model['hethan'] ? '<span class="badge badge-danger">' . $model['hopdong']->ngay_het_han . '</span>' . '<label class="control-label" style="color: red">Hết hạn</label>' : '<span class="badge badge-success">' . $model['hopdong']->ngay_het_han . '</span>' ?>
            <?= ($model['hopdong']->thanh_ly == 1) ? '<br><label class="control-label" style="color: red">Đã thanh lý ngày ' . (($model['hopdong']->ngay_thanh_ly != null) ? date('d-m-Y', strtotime($model['hopdong']->ngay_thanh_ly)) : '') . ' </label>' : '' ?>
        </h3>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label class="control-label">
            BÊN CHO THUÊ NHÀ Ở THUỘC SỞ HỮU NHÀ NƯỚC
            <a <?= ($model['hopdong']->thanh_ly == 1) ? 'style="display:none"' : '' ?>
                    class='btn btn-warning btn-xs' role="modal-remote"
                    href='<?= Yii::$app->urlManager->createUrl(['setting/updatesetting', 'id' => 1]) ?>'><i
                        class='fa fa-pencil'></i></a>
        </label>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-scrollable-borderless">
            <tr>
                <th width="15%">Ông (bà):</th>
                <td width="35%"><?= $model['config']->ho_ten ?></td>
                <th width="15%">Chức vụ:</th>
                <td width="35%"><?= $model['config']->chuc_vu ?></td>
            </tr>
            <tr>
                <th width="15%">Đại diện cho:</th>
                <td colspan="3"><?= $model['config']->co_quan ?></td>
            </tr>
            <tr>
                <th width="15%">Địa chỉ cơ quan:</th>
                <td colspan="3"><?= $model['config']->dia_chi ?></td>
            </tr>
            <tr>
                <th width="15%">Điện thoại:</th>
                <td width="35%"><?= $model['config']->dien_thoai ?></td>
                <th width="15%">Fax:</th>
                <td width="35%"><?= $model['config']->fax ?></td>
            </tr>
            <tr>
                <th width="15%">Tài khoản:</th>
                <td width="35%"><?= $model['config']->tai_khoan ?></td>
                <th width="15%">Tại ngân hàng:</th>
                <td width="35%"><?= $model['config']->ngan_hang ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label class="control-label">
            BÊN THUÊ NHÀ Ở THUỘC SỞ HỮU NHÀ NƯỚC
        </label>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-scrollable-borderless">
            <?php if ($model['can']->id_loainha == 4 || $model['can']->id_loainha == 5): ?>
                <tr>
                    <th>Đơn vị</th>
                    <td colspan="5"><?= $model['hopdong']->don_vi ?></td>
                </tr>
            <?php endif ?>
            <tr>
                <th>Ông (bà)</th>
                <td colspan="5"><?= $model['hopdong']->nguoi_thue ?></td>
            </tr>
            <tr>
                <th>Chứng minh nhân dân</th>
                <td colspan="5"><?= $model['hopdong']->cmnd . (($model['hopdong']->ngay_cap != null) ? ', cấp ngày ' . date('d-m-Y', strtotime($model['hopdong']->ngay_cap)) : '') . (($model['hopdong']->noi_cap != null) ? ', cấp tại ' . $model['hopdong']->noi_cap : '') ?></td>
            </tr>
            <tr>
                <th>Hộ khẩu thường trú</th>
                <td colspan="5"><?= $model['hopdong']->thuong_tru ?></td>
            </tr>
            <tr>
                <th>Địa chỉ liên hệ</th>
                <td colspan="5"><?= $model['hopdong']->dia_chi_lien_he ?></td>
            </tr>
            <tr>
                <th>Điện thoại</th>
                <td colspan="5"><?= $model['hopdong']->dienthoai ?></td>
            </tr>
            <tr>
                <th>Giá thuê</th>
                <td><?= number_format($model['hopdong']->gia_thue, 0, ',', '.') ?></td>
                <th>Giá giảm</th>
                <td><?= number_format($model['hopdong']->gia_giam, 0, ',', '.') ?></td>
                <th>Giá thuê thực tế</th>
                <td><?= number_format($model['hopdong']->gia_phai_tra, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th>Thời hạn</th>
                <td><?= $model['hopdong']->thoi_han_thue . ' tháng' ?></td>
                <th>Ngày bắt đầu</th>
                <td colspan="3"><?= $model['hopdong']->ngay_bat_dau ?></td>
            </tr>
            <tr>
                <th>Ghi chú</th>
                <td colspan="5"><?= $model['hopdong']->ghi_chu ?></td>
            </tr>
        </table>
    </div>
</div>

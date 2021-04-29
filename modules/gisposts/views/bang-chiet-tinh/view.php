<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/12/2021
 * Time: 8:30 AM
 */

?>

<div class="row">
    <div class="col-lg-12">
        <label class="control-label">
            PHỤ LỤC CHIẾT TÍNH TIỀN THUÊ NHÀ
        </label>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-scrollable-borderless">
            <tr>
                <th width="20%">Địa chỉ</th>
                <td colspan="5"><?= $model['can']->fulldiachi ?></td>
            </tr>
            <tr>
                <th width="20%">Hộ sử dụng</th>
                <td colspan="5"><?= $model['bangchiettinh']->nguoi_thue ?></td>
            </tr>
            <tr>
                <th width="20%">Pháp lý</th>
                <td colspan="5"><?= $model['bangchiettinh']->phap_ly ?></td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <th width="20%">Thu từ</th>
                <td colspan="5"><?= ($model['bangchiettinh']->tu_ngay != null) ? date('d-m-Y', strtotime($model['bangchiettinh']->tu_ngay)) : '' ?></td>
            </tr>
            <tr>
                <th width="20%">Cấp nhà</th>
                <td colspan="5"><?= $model['ho']->cap_nha ?></td>
            </tr>
            <tr>
                <th width="20%">Đơn giá</th>
                <th width="20%">Diện tích</th>
                <th width="15%">K1</th>
                <th width="15%">K2</th>
                <th width="15%">K3</th>
                <th width="15%">1 + &Sigma;K</th>
            </tr>
            <tr>
                <td width="20%"><?= $model['bangchiettinh']->gia_chuan?></td>
                <td width="20%"><?= $model['ho']->dien_tich_su_dung?></td>
                <td width="15%"><?= $model['bangchiettinh']->heso_k2?></td>
                <td width="15%"><?= $model['bangchiettinh']->heso_k3?></td>
                <td width="15%"><?= $model['bangchiettinh']->heso_k4?></td>
                <td width="15%"><?= 1 + $model['bangchiettinh']->heso_k2 + $model['bangchiettinh']->heso_k3 + $model['bangchiettinh']->heso_k4?></td>
            </tr>
            <tr>
                <th width="20%">Thành tiền</th>
                <td colspan="4"></td>
                <td align="right"><?= number_format($model['bangchiettinh']->gia_tinh,0,',','.') ?></td>
            </tr>
            <tr>
                <th width="20%">Giảm giá</th>
                <td align="justify" colspan="4">
                    <?php if(isset($model['bangchiettinh']->miengiam) && $model['bangchiettinh']->miengiam != null):?>
                        <?= $model['bangchiettinh']->miengiam->dieu_khoan?><br><?= $model['bangchiettinh']->miengiam->ghichu_miengiam?>
                    <?php else:?>
                        <i>Không miễn giảm</i>
                    <?php endif;?>
                </td>
                <td align="right"><?= number_format($model['bangchiettinh']->muc_giam,0,',','.') ?></td>
            </tr>
            <tr>
                <th width="20%">Hệ số tăng lương cơ bản</th>
                <td colspan="4"></td>
                <td align="right"><?= number_format($model['bangchiettinh']->heso_tlcb,2,',','.') ?></td>
            </tr>
            <tr>
                <th width="20%">Thời điểm bố trí sử dụng</th>
                <td colspan="4"><?= $model['bangchiettinh']->thoigianbotri->mota_thoigian?></td>
                <td align="right"><?= $model['bangchiettinh']->thoigianbotri->he_so ?></td>
            </tr>
            <tr>
                <th width="20%">Giá thuê</th>
                <td colspan="4"></td>
                <td align="right"><?= number_format($model['bangchiettinh']->gia_thue,0,',','.') ?></td>
            </tr>
            <tr>
                <th width="20%">Giá làm tròn</th>
                <td colspan="4"></td>
                <td align="right"><?= number_format($model['bangchiettinh']->gia_lamtron,0,',','.') ?></td>
            </tr>
        </table>
    </div>
</div>


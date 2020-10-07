<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>
<?php $form = ActiveForm::begin() ?>
    <div class='col-lg-12 form-group'>
        <div class='panel panel-default'>
            <div class='panel-heading' style="background-color: #026fb7">
                <h4 class='panel-title' align="center" style="color: white; font-family: Tahoma">PHIẾU ĐĂNG KÝ THÔNG TIN
                    CHUYÊN GIA </h4>
            </div>
            <div class='panel-body'>
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th width="15%">Mã phiếu đăng ký</th>
                        <td width="35%"><?= $model['phieudangky']['id_pdkcg'] ?></td>
                        <th width="15%">Trạng thái</th>
                        <td width="35%"><?= ($model['phieudangky']['ket_qua'] != null && $model['phieudangky']['ket_qua'] == 1) ? 'Đã duyệt' : 'Chưa duyệt' ?></td>
                    </tr>
                    <tr>
                        <th width="15%">Thời gia đăng ký</th>
                        <td width="35%"><?= ($model['phieudangky']['created_at'] != null) ? date('d-m-Y H:i:s', strtotime($model['phieudangky']['created_at'])) : '' ?></td>
                        <th width="15%">Tài khoản đăng ký</th>
                        <td width="35%"><?= ($model['phieudangky']['created_by'] != null) ? $model['phieudangky']['created_by'] : '' ?></td>

                    </tr>
                    <tr>
                        <th width="15%">Thời gian cập nhật</th>
                        <td width="35%"><?= ($model['phieudangky']['updated_at'] != null) ? date('d-m-Y H:i:s', strtotime($model['phieudangky']['updated_at'])) : '' ?></td>
                        <th width="15%">Tài khoản cập nhật</th>
                        <td width="35%"><?= ($model['phieudangky']['updated_by'] != null) ? $model['phieudangky']['updated_by'] : '' ?></td>
                    </tr>
                </table>
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th width="15%">Họ tên</th>
                        <td width="35%"><?= $model['phieudangky']['ho_ten'] ?></td>
                        <th width="15%">Lĩnh vực</th>
                        <td width="35%"><?= $model['phieudangky']['ten_lvql'] ?></td>
                    </tr>
                    <tr>
                        <th width="15%">Năm sinh</th>
                        <td width="35%"><?= $model['phieudangky']['nam_sinh'] ?></td>
                        <th width="15%">Giới tính</th>
                        <td width="35%"><?= ($model['phieudangky']['gioi_tinh'] == 1) ? 'Nam' : 'Nữ' ?></td>

                    </tr>
                    <tr>
                        <th width="15%">Học hàm</th>
                        <td width="35%"><?= ($model['phieudangky']['hh_id'] == null) ? '' : $model['phieudangky']['ten_hh'] ?></td>
                        <th width="15%">Học vị</th>
                        <td width="35%"><?= ($model['phieudangky']['hv_id'] == null) ? '' : $model['phieudangky']['ten_hv'] ?></td>
                    </tr>
                    <tr>
                        <th width="15%">Chuyên môn</th>
                        <td width="35%"><?= $model['phieudangky']['chuyen_mon'] ?></td>
                        <th width="15%">Đơn vị công tác</th>
                        <td width="35%"><?= $model['phieudangky']['donvi_congtac'] ?></td>
                    </tr>
                    <tr>
                        <th width="15%">Địa chỉ</th>
                        <td colspan="3"><?= $model['phieudangky']['dia_chi'] ?></td>
                    </tr>
                    <tr>
                        <th width="15%">Điện thoại</th>
                        <td width="35%"><?= $model['phieudangky']['dien_thoai'] ?></td>
                        <th width="15%">Email</th>
                        <td width="35%"><?= $model['phieudangky']['email'] ?></td>
                    </tr>
                    <tr>
                        <th width="15%">Định hướng nghiên cứu</th>
                        <td colspan="3"><?= $model['phieudangky']['dinh_huong'] ?></td>
                    </tr>
                    <tr>
                        <th width="15%">Công trình nghiên cứu</th>
                        <td colspan="3"><?= $model['phieudangky']['congtrinh_nghiencuu'] ?></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <div class="col-lg-12 form-group">
        <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
    </div>
<?php ActiveForm::end(); ?>
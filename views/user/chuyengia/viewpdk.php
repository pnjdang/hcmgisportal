<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VChuyengia */
?>
<div class="vchuyengia-view">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Chi tiết phiếu đăng ký chuyên gia</h4>
    </div>
    <div class="modal-body">
        <div class="col-lg-12">
            <table class="table table-scrollable-borderless table-responsive">
                <tr>
                    <th width="25%">Họ tên</th>
                    <td width="25%"><?= $model['ho_ten'] ?></td>
                    <th width="25%">Giới tính</th>
                    <td width="25%"><?= ($model['gioi_tinh'] == null) ? '' : (($model['gioi_tinh'] == 1) ? 'Nam' : 'Nữ') ?></td>
                </tr>
                <tr>
                    <th>Năm sinh</th>
                    <td><?= $model['nam_sinh'] ?></td>
                    <th>Ngày sinh</th>
                    <td><?= $model['ngay_sinh'] ?></td>
                </tr>
                <tr>
                    <th>Học hàm</th>
                    <td><?= $model['ten_hh'] ?></td>
                    <th>Học vị</th>
                    <td><?= $model['ten_hv'] ?></td>
                </tr>
                <tr>
                    <th>Điện thoại</th>
                    <td><?= $model['dien_thoai'] ?></td>
                    <th>Email</th>
                    <td><?= $model['email'] ?></td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td colspan="3"><?= $model['dia_chi'] ?></td>
                </tr>
                <tr>
                    <th>Chuyên môn</th>
                    <td><?= $model['chuyen_mon'] ?></td>
                    <th>Chức vụ</th>
                    <td><?= $model['chuc_vu'] ?></td>
                </tr>
                <tr>
                    <th>Đơn vị công tác</th>
                    <td colspan="3"><?= $model['donvi_congtac'] ?></td>
                </tr>
                <tr>
                    <th>Định hướng nghiên cứu</th>
                    <td colspan="3"><?= $model['dinh_huong'] ?></td>
                </tr>
                <tr>
                    <th>Công trình nghiên cứu</th>
                    <td colspan="3"><?= $model['congtrinh_nghiencuu'] ?></td>
                </tr>
            </table>
        </div>
        <div style="clear: both"></div>

    </div>


    <div class="modal-footer">
        <button data-dismiss="modal" type="button" class="btn btn-default pull-right">Đóng</button>
    </div>
</div>

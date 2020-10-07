<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ['pdk'] app\models\VChuyengia */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Phiếu đăng ký thông tin chuyên gia</h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <table class="table table-bordered table-striped table-responsive">
        <tr>
            <th>Họ tên</th>
            <td colspan="3"><?= $model['chuyengia']->ho_ten?></td>
        </tr>
        <tr>
            <th width="20%">Năm sinh</th>
            <td width="30%"><?= $model['chuyengia']->nam_sinh?></td>
            <th width="20%">Giới tính</th>
            <td width="30%"><?= ($model['chuyengia']->gioi_tinh == null) ? '' : (($model['chuyengia']->gioi_tinh == 0) ? 'Nữ' : 'Nam')?></td>
        </tr>
        <tr>
            <th>Học hàm</th>
            <td><?= ($model['chuyengia']->hocham != null) ? $model['chuyengia']->hocham->ten_hh : ''?></td>
            <th>Năm được phong</th>
            <td><?= $model['chuyengia']->nam_hocham?></td>
        </tr>
        <tr>
            <th>Học vị</th>
            <td><?= ($model['chuyengia']->hocvi != null) ? $model['chuyengia']->hocvi->ten_hv : ''?></td>
            <th>Năm đạt được</th>
            <td><?= $model['chuyengia']->nam_hocvi?></td>
        </tr>
        <tr>
            <th>Lĩnh vực hoạt động</th>
            <td colspan="3">
                <?php if($model['chuyengia']->chuyengiaLinhvucs != null):?>
                    <?php foreach($model['chuyengia']->chuyengiaLinhvucs as $linhvuc):?>
                        <?= '- '.$linhvuc->cap1->ten_cap1.'<br>'?>
                    <?php endforeach?>
                <?php endif;?>
            </td>
        </tr>
        <tr>
            <th>Chuyên ngành</th>
            <td colspan="3">
                <?php if($model['chuyengia']->chuyengiaChuyennganhs != null):?>
                    <?php foreach($model['chuyengia']->chuyengiaChuyennganhs as $chuyennganh):?>
                        <?= '- '.$chuyennganh->cap3->ten_cap3.'<br>'?>
                    <?php endforeach?>
                <?php endif;?>
            </td>
        </tr>
        <tr>
            <th>Đơn vị</th>
            <td colspan="3"><?= ($model['chuyengia']->donvi != null) ? $model['chuyengia']->donvi->ten_donvi : ''?></td>
        </tr>
        <tr>
            <th>Công việc hiện nay</th>
            <td colspan="3"><?= $model['chuyengia']->congviec_hiennay?></td>
        </tr>
        <tr>
            <th>Chức vụ hiện tại</th>
            <td colspan="3"><?= $model['chuyengia']->chucvu_hientai?></td>
        </tr>
        <tr>
            <th>Địa chỉ nhà riêng</th>
            <td colspan="3"><?= $model['chuyengia']->diachi_nharieng?></td>
        </tr>
        <tr>
            <th>Điện thoại</th>
            <td><?= $model['chuyengia']->dien_thoai?></td>
            <th>Di động</th>
            <td><?= $model['chuyengia']->di_dong?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td colspan="3"><?= $model['chuyengia']->email?></td>
        </tr>
        <tr>
            <th>Thời gian đăng ký</th>
            <td><?= $model['chuyengia']->created_at?></td>
            <th>Trạng thái</th>
            <td><?= ($model['chuyengia']->status == 2) ? 'Đã đăng ký' : ''?>
                <?= ($model['chuyengia']->status == 1) ? 'Đã duyệt' : ''?></td>
        </tr>
    </table>
    <div style="clear:both;"></div>
</div>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>
</div>
<?php ActiveForm::end() ?>


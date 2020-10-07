<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/2/2017
 * Time: 11:11 AM
 */
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="<?= Yii::$app->homeUrl ?>">Trang chủ</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Quản lý tài khoản</span>
    </li>
</ul>

<?php $update = Yii::$app->session->getFlash('update') ?>
<?php if (isset($update)): ?>
    <div class="portlet box green" id="notice">
        <div class="portlet-title">
            <div class="caption"><span class="fa fa-check-circle-o"></span> Cập nhật thành công!</div>
        </div>
    </div>
<?php endif; ?>
<?php $restore = Yii::$app->session->getFlash('restore') ?>
<?php if (isset($error)): ?>
    <div class="portlet box green" id="notice">
        <div class="portlet-title">
            <div class="caption"><span class="fa fa-times-circle-o"></span> Khôi phục thành công!</div>
        </div>
    </div>
<?php endif; ?>
<div class="page-content-inner">
    <div class="row">
        <div class="col-md-12">
            <div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <span><i class="fa fa-users"></i> Quản lý tài khoản</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-group">
                            <a class="btn btn-success" data-toggle="modal" href="#create">Tạo tài khoản</a>
                        </div>
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Loại tài khoản</th>
                                    <th>Họ tên</th>
                                    <th>Điện thoại</th>
                                    <th>Email</th>
                                    <th>Lần đăng nhập cuối</th>
                                    <th>Thời gian khởi tạo</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($model['danhsachtaikhoan'] != null): ?>
                                    <?php foreach ($model['danhsachtaikhoan'] as $i => $taikhoan): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $taikhoan->ten_dang_nhap ?></td>
                                            <td><?= $taikhoan->getLoaitaikhoan() ?></td>
                                            <td><?= $taikhoan->ho_ten ?></td>
                                            <td><?= $taikhoan->dien_thoai ?></td>
                                            <td><?= $taikhoan->email ?></td>
                                            <td><?= $taikhoan->lan_dang_nhap_cuoi ?></td>
                                            <td><?= $taikhoan->create_at ?></td>
                                            <td><?= ($taikhoan->tinh_trang == 0) ? 'Khóa' : 'Kích hoạt' ?></td>
                                            <td>
                                                <a class="btn btn-warning custom-element-load-ajax-div" data-url="<?= Yii::$app->homeUrl ?>taikhoan/updatetaikhoan?id=<?= $taikhoan->id_taikhoan?>" data-target-div="#ajaxModalContent" title="Create new Qlkh Donvis" data-toggle="modal" data-target="#ajaxModal">Cập nhật</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" style="text-align: center"><i>Chưa có dữ liệu</i></td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div>
                <div class="portlet box red">
                    <div class="portlet-title">
                        <div class="caption">
                            <span><i class="fa fa-trash"></i> Tài khoản đã xóa</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Loại tài khoản</th>
                                    <th>Họ tên</th>
                                    <th>Điện thoại</th>
                                    <th>Email</th>
                                    <th>Lần đăng nhập cuối</th>
                                    <th>Thời gian khởi tạo</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($model['danhsachdaxoa'] != null): ?>
                                    <?php foreach ($model['danhsachdaxoa'] as $i => $taikhoan): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $taikhoan->ten_dang_nhap ?></td>
                                            <td><?= $taikhoan->getLoaitaikhoan() ?></td>
                                            <td><?= $taikhoan->ho_ten ?></td>
                                            <td><?= $taikhoan->dien_thoai ?></td>
                                            <td><?= $taikhoan->email ?></td>
                                            <td><?= $taikhoan->lan_dang_nhap_cuoi ?></td>
                                            <td><?= $taikhoan->create_at ?></td>
                                            <td><?= ($taikhoan->tinh_trang == 0) ? 'Khóa' : 'Kích hoạt' ?></td>
                                            <td>
                                                <a class="btn btn-info custom-element-load-ajax-div" data-target-div='#ajaxModalContent' data-toggle='modal' data-target='#ajaxModal' data-url='<?= Yii::$app->urlManager->createUrl('taikhoan/restoretaikhoan').'?id='.$taikhoan->id_taikhoan?>'>Khôi phục</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" style="text-align: center"><i>Chưa có dữ liệu</i></td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="create" tabindex="-1" role="create" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $form = ActiveForm::begin()?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tạo mới tài khoản</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?= $form->field($model['taikhoan'],'ten_dang_nhap')->input('text')->label('Tên đăng nhập')?>
                </div>
                <div class="form-group">
                    <?= $form->field($model['taikhoan'],'mat_khau')->input('password')->label('Mật khẩu')?>
                </div>
                <div class="form-group">
                    <?= $form->field($model['taikhoan'],'id_loaitk')->dropDownList(ArrayHelper::map($model['loaitaikhoan'],'id_loaitk','ten_loaitk'))->label('Loại tài khoản')?>
                </div>
                <div class="form-group">
                    <?= $form->field($model['taikhoan'],'ho_ten')->input('text')->label('Họ tên')?>
                </div>
                <div class="form-group">
                    <?= $form->field($model['taikhoan'],'dia_chi')->input('text')->label('Địa chỉ')?>
                </div>
                <div class="form-group">
                    <?= $form->field($model['taikhoan'],'dien_thoai')->input('text',['onkeypress' => 'return event.charCode>= 48 && event.charCode <= 57'])->label('Điện thoại')?>
                </div>
                <div class="form-group">
                    <?= $form->field($model['taikhoan'],'email')->input('email')->label('Email')?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-success pull-left">Tạo mới</button>
            </div>
            <?php ActiveForm::end()?>
        </div>
    </div>
</div>

<div id="updateTaiKhoan" style="display: none"></div>
<div id="restoreTaiKhoan" style="display: none"></div>

<!-- Modal -->
<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content no-padding" id="ajaxModalContent">

        </div>
    </div>
</div>
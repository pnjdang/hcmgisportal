<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 11/28/2016
 * Time: 8:43 PM
 */
?>


<!-- Page Content -->
<div id="page-content" style="padding-top: 10px">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class=" sidebar-menu">
                    <ul class="nav nav-stacked">
                        <li><a href="<?= Yii::$app->urlManager->createUrl('taikhoan/thongtincanhan') ?>">Thông tin cá
                                nhân</a></li>
                        <li><a href="<?= Yii::$app->homeUrl . 'setting/danhsachcanxoa' ?>">Danh sách căn đã xóa</a></li>
                        <li class="active"><a href="<?= Yii::$app->homeUrl . Yii::getAlias('cau-hinh') ?>">Cấu hình</a>
                        </li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl('taikhoan/index') ?>">Quản lý tài khoản</a>
                        </li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl('taikhoan/history') ?>">Lịch sử đăng nhập</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="portlet box blue-steel">
                    <div class="portlet-title">
                        <div class="caption">
                            <span>Bên cho thuê nhà ở</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="col-md-6"><label class="control-label">Ông
                                (bà): </label> <?= (isset($model->ho_ten)) ? $model->ho_ten : '<i>Chưa cập nhật</i>' ?>
                        </div>
                        <div class="col-md-6"><label class="control-label">Chức
                                vụ:</label> <?= (isset($model->chuc_vu)) ? $model->chuc_vu : '<i>Chưa cập nhật</i>' ?>
                        </div>
                        <div class="col-md-12"><label class="control-label">Đại diện
                                cho: </label> <?= (isset($model->co_quan)) ? $model->co_quan : '<i>Chưa cập nhật</i>' ?>
                        </div>
                        <div class="col-md-12"><label class="control-label">Địa chỉ cơ
                                quan: </label> <?= (isset($model->dia_chi)) ? $model->dia_chi : '<i>Chưa cập nhật</i>' ?>
                        </div>
                        <div class="col-md-6"><label class="control-label">Điện
                                thoại: </label> <?= (isset($model->dien_thoai)) ? $model->dien_thoai : '<i>Chưa cập nhật</i>' ?>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Fax:</label> <?= (isset($model->fax)) ? $model->fax : '<i>Chưa cập nhật</i>' ?></div>
                        <div class="col-md-6"><label class="control-label">Tài
                                khoản: </label> <?= (isset($model->tai_khoan)) ? $model->tai_khoan : '<i>Chưa cập nhật</i>' ?>
                        </div>
                        <div class="col-md-6"><label class="control-label">Tại Ngân
                                hàng:</label> <?= (isset($model->ngan_hang)) ? $model->ngan_hang : '<i>Chưa cập nhật</i>' ?>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-warning btn-md pull-right" data-toggle="modal"
                                    data-target="#modalConfig">Cập nhật
                            </button>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                </div>


            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
</div>
<!-- end Page Content -->

<!-- modalConfig -->
<div class="modal fade" id="modalConfig" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?= Yii::$app->homeUrl ?>setting/setting" enctype="multipart/form-data">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">Cập nhật bên cho thuê</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <label class="control-label">Ông (bà)</label>
                            <input type="text" class="form-control" name="config[ho_ten]"
                                   value="<?= (isset($model->ho_ten)) ? $model->ho_ten : '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Chức vụ</label>
                            <input type="text" class="form-control" name="config[chuc_vu]"
                                   value="<?= (isset($model->chuc_vu)) ? $model->chuc_vu : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <label class="control-label">Đại diện cho</label>
                            <input type="text" class="form-control" name="config[co_quan]"
                                   value="<?= (isset($model->co_quan)) ? $model->co_quan : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <label class="control-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="config[dia_chi]"
                                   value="<?= (isset($model->dia_chi)) ? $model->dia_chi : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Điện thoại</label>
                            <input type="text" class="form-control" name="config[dien_thoai]"
                                   value="<?= (isset($model->dien_thoai)) ? $model->dien_thoai : '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Fax</label>
                            <input type="text" class="form-control" name="config[fax]"
                                   value="<?= (isset($model->fax)) ? $model->fax : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Tài khoản</label>
                            <input type="text" class="form-control" name="config[tai_khoan]"
                                   value="<?= (isset($model->tai_khoan)) ? $model->tai_khoan : '' ?>">
                        </div>
                        <div class="col-md-8">
                            <label class="control-label">Tại Ngân hàng</label>
                            <input type="text" class="form-control" name="config[ngan_hang]"
                                   value="<?= (isset($model->ngan_hang)) ? $model->ngan_hang : '' ?>">
                        </div>
                    </div>
                </div>
                <div style="clear: both; margin-bottom: 20px"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-warning pull-left">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
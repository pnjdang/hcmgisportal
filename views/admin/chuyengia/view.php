<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VChuyengia */
?>
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="<?= Yii::$app->homeUrl ?>">Trang chủ</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index') ?>">Danh sách chuyên gia</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active"><?= $model['chuyengia']->ho_ten?></span>
    </li>
</ul>

<div class="row">
    <div class="col-lg-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="uppercase">Thông tin chuyên gia</span>
                </div>
                <div class="caption pull-right">
                    <a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/view').'?id='.$model['chuyengia']->id_chuyengia?>">Thông tin chi tiết</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/ngoaingu').'?id='.$model['chuyengia']->id_chuyengia?>">Ngoại ngữ</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/congtrinh').'?id='.$model['chuyengia']->id_chuyengia?>">Công trình nghiên cứu</a>
                    <a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/congtac').'?id='.$model['chuyengia']->id_chuyengia?>">Công tác</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('daotao/daotao') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Đào tạo</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('detai/detai') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Đề tài</a>
                </div>
            </div>
            <div class="portlet-body">
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
                </table>


            </div>
            <div class="col-lg-12">
                <a class="btn btn-warning pull-left"
                   href="<?= Yii::$app->urlManager->createUrl('admin/chuyengia/update') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Cập
                    nhật thông tin</a>
                <a class="btn btn-default pull-right"
                   href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index') ?>">Danh sách chuyên gia</a>
            </div>
            <div style="clear: both"></div>
        </div>

    </div>
</div>

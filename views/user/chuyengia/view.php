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
        <a href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/index') ?>">Danh sách chuyên gia</a>
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
                    <span class="uppercase">Thông tin chi tiết</span>
                </div>
                <div class="caption pull-right">
                    <a class="btn btn-primary"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/view') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Thông
                        tin chi tiết</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/ngoaingu') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Ngoại ngữ</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/congtrinh') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Công
                        trình nghiên cứu</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/congtac') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Công tác</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/daotao') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Đào tạo</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/detai') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Đề tài</a>
                    <?php if($model['chuyengia']->created_by == Yii::$app->user->id):?>
                        <a class="btn btn-default"
                           href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/congbo') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Công bố thông tin</a>
                    <?php endif?>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered detail-view">
                    <?= ($model['config']->ho_ten) ? "<tr><th>Họ tên</th><td>".((is_null($model['chuyengia']->ho_ten)) ? '' : $model['chuyengia']->ho_ten )."</td></tr>" : ''?>
                    <?= ($model['config']->nam_sinh) ? "<tr><th>Năm sinh</th><td>".((is_null($model['chuyengia']->nam_sinh)) ? '' : $model['chuyengia']->nam_sinh )."</td></tr>" : ''?>
                    <?= ($model['config']->gioi_tinh) ? "<tr><th>Giới Tính</th><td>".((is_null($model['chuyengia']->gioi_tinh)) ? 'Nữ' : 'Nam' )."</td></tr>" : ''?>
                    <?= ($model['config']->hocham_id) ? "<tr><th>Học hàm</th><td>".((is_null($model['chuyengia']->hocham)) ? '' : $model['chuyengia']->hocham->ten_hh )."</td></tr>" : ''?>
                    <?= ($model['config']->hocvi_id) ? "<tr><th>Học vị</th><td>".((is_null($model['chuyengia']->hocvi)) ? '' : $model['chuyengia']->hocvi->ten_hv )."</td></tr>" : ''?>
                    <?= ($model['config']->linhvuc_hoatdong) ? "<tr><th>Lĩnh vực hoạt động</th><td>".implode(\yii\helpers\ArrayHelper::map($model['chuyengia']->chuyengiaLinhvucs, 'cap1.id_cap1', 'cap1.ten_cap1'))."</td></tr>" : ''?>
                    <?= ($model['config']->chuyen_nganh) ? "<tr><th>Chuyên ngành</th><td>".implode(\yii\helpers\ArrayHelper::map($model['chuyengia']->chuyengiaChuyennganhs, 'cap3.id_cap3', 'cap3.ten_cap3'))."</td></tr>" : ''?>
                    <?= ($model['config']->donvi_id) ? "<tr><th>Đơn vị</th><td>".((is_null($model['chuyengia']->donvi)) ? '' : $model['chuyengia']->donvi->ten_donvi )."</td></tr>" : ''?>
                    <?= ($model['config']->congviec_hiennay) ? "<tr><th>Công việc hiện nay</th><td>".((is_null($model['chuyengia']->congviec_hiennay)) ? '' : $model['chuyengia']->congviec_hiennay )."</td></tr>" : ''?>
                    <?= ($model['config']->chucvu_hientai) ? "<tr><th>Chức vụ hiện tại</th><td>".((is_null($model['chuyengia']->chucvu_hientai)) ? '' : $model['chuyengia']->chucvu_hientai )."</td></tr>" : ''?>
                    <?= ($model['config']->diachi_nharieng) ? "<tr><th>Địa chỉ nhà riêng</th><td>".((is_null($model['chuyengia']->diachi_nharieng)) ? '' : $model['chuyengia']->diachi_nharieng )."</td></tr>" : ''?>
                    <?= ($model['config']->dien_thoai) ? "<tr><th>Điện thoại</th><td>".((is_null($model['chuyengia']->dien_thoai)) ? '' : $model['chuyengia']->dien_thoai )."</td></tr>" : ''?>
                    <?= ($model['config']->di_dong) ? "<tr><th>Di động</th><td>".((is_null($model['chuyengia']->di_dong)) ? '' : $model['chuyengia']->di_dong )."</td></tr>" : ''?>
                    <?= ($model['config']->email) ? "<tr><th>Email</th><td>".((is_null($model['chuyengia']->email)) ? '' : $model['chuyengia']->email )."</td></tr>" : ''?>
                </table>

                <div class="col-lg-12">
                    <?php if(!Yii::$app->user->isGuest && $model['chuyengia']->created_by == Yii::$app->user->id):?>
                        <a class='btn btn-info btn-word-export' data-target='#div_word_export' data-filename='Lý lịch khoa học <?=$model['chuyengia']->ho_ten?>' data-url='<?= Yii::$app->urlManager->createUrl('user/chuyengia/export') . "?id=" . $model['chuyengia']->id_chuyengia?>' title='Xuất lý lịch'><i class='fa fa-file-word-o'></i> Xuất lý lịch khoa học</a>
                    <?php endif?>
                    <a class="btn btn-default pull-right"
                       href="<?= Yii::$app->urlManager->createUrl('chuyen-gia') ?>">Danh sách chuyên gia</a>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
</div>
<div id="div_word_export" style="display: none"></div>
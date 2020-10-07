<?php

/* @var $this yii\web\View */
/* @var $model app\models\Chuyengia */
use yii\helpers\ArrayHelper;

?>

<div class="row">
    <div class="col-lg-12">
        <?php $success = Yii::$app->session->getFlash('success') ?>
        <?php if (isset($success)): ?>
            <div class="portlet box green-haze" id="notice">
                <div class="portlet-title">
                    <div class="caption">
                        <span><i class="fa fa-check-circle"></i> Đăng ký thông tin phòng thí nghiệm thành công!</span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#notice').delay(5000).fadeOut();
            });
        </script>
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="font-blue-steel">Thông tin đăng ký phòng thí nghiệm</span>
                </div>
            </div>
            <div class="portlet-body">

                <table class="table table-scrollable-borderless table-responsive">
                    <tr>
                        <th width="15%">Tên tiếng Việt</th>
                        <td colspan="3"
                            class="uppercase"><?= ($model['phongthinghiem']->ten_tv != null) ? $model['phongthinghiem']->ten_tv : '<i>Chưa cập nhật</i>' ?></td>
                    </tr>
                    <tr>
                        <th width="15%">Tên tiếng Anh</th>
                        <td colspan="3"
                            class="uppercase"><?= ($model['phongthinghiem']->ten_ta != null) ? $model['phongthinghiem']->ten_ta : '<i>Chưa cập nhật</i>' ?></td>
                    </tr>
                    <tr>
                        <th width="15%">Cơ quan chủ quản</th>
                        <td colspan="3"><?= ($model['phongthinghiem']->coquan_chuquan != null) ? $model['phongthinghiem']->coquan_chuquan : '<i>Chưa cập nhật</i>' ?></td>
                    </tr>
                    <tr>
                        <th width="15%">Địa chỉ</th>
                        <td colspan="3"><?= ($model['phongthinghiem']->dia_chi != null) ? $model['phongthinghiem']->dia_chi : '<i>Chưa cập nhật</i>' ?></td>
                    </tr>
                    <tr>
                        <th width="20%">Điện thoại</th>
                        <td width="30%"><?= ($model['phongthinghiem']->dien_thoai != null) ? $model['phongthinghiem']->dien_thoai : '' ?></td>
                        <th width="20%">Fax</th>
                        <td width="30%"><?= ($model['phongthinghiem']->fax != null) ? $model['phongthinghiem']->fax : '' ?></td>
                    </tr>
                    <tr>
                        <th width="20%">Email</th>
                        <td width="30%"><?= ($model['phongthinghiem']->email != null) ? $model['phongthinghiem']->email : '' ?></td>
                        <th width="20%">Website</th>
                        <td width="30%"><?= ($model['phongthinghiem']->website != null) ? $model['phongthinghiem']->website : '' ?></td>
                    </tr>
                    <tr>
                        <th width="20%">Người phụ trách</th>
                        <td width="30%"><?= ($model['phongthinghiem']->phu_trach != null) ? $model['phongthinghiem']->phu_trach : '' ?></td>
                        <th width="20%">Người đại diện</th>
                        <td width="30%"><?= ($model['phongthinghiem']->dai_dien != null) ? $model['phongthinghiem']->dai_dien : '' ?></td>
                    </tr>
                    <tr>
                        <th>Đặc trưng hoạt động</th>
                        <td colspan="3" style="text-align: justify">
                            <?= ($model['phongthinghiem']->dactrung_hoatdong != null) ? nl2br($model['phongthinghiem']->dactrung_hoatdong) : '<i>Chưa cập nhật</i>' ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Lĩnh vực thử nghiệm</th>
                        <td colspan="3" style="text-align: justify">
                            <?php if ($model['phongthinghiem']->phongthinghiemLinhvucs == null): ?>
                                <i>Chưa cập nhật</i>
                            <?php else: ?>
                                <?php foreach ($model['phongthinghiem']->phongthinghiemLinhvucs as $i => $lvtn): ?>
                                    - <?= $lvtn->lv->ten_lv ?> <br>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Vật liệu và sản phẩm thử nghiệm</th>
                        <td colspan="3" style="text-align: justify">
                            <?php if ($model['phongthinghiem']->phongthinghiemChungloais == null): ?>
                                <i>Chưa cập nhật</i>
                            <?php else: ?>
                                <?php foreach (ArrayHelper::index($model['phongthinghiem']->phongthinghiemChungloais, 'pl_id', 'cl_id') as $i => $cl): ?>
                                    <?php $chungloai = array_shift($cl) ?>
                                    <label class="uppercase"><?= $chungloai->cl->ten_cl ?></label> <br>
                                    <?php array_unshift($cl, $chungloai) ?>
                                    <?php foreach ($cl as $k => $pl): ?>
                                        <?= ($k + 1) . '. ' . $pl->pl->ten_pl ?> <br>
                                    <?php endforeach ?>
                                    <br>
                                <?php endforeach ?>

                                <label class="uppercase">CÁC CHỦNG LOẠI VẬT LIỆU VÀ SẢN PHẨM KHÁC</label><br>
                                <?= $model['phongthinghiem']->ghichu_chungloai ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Phương pháp thử chủ yếu</th>
                        <td colspan="3" style="text-align: justify">
                            <?php if ($model['phongthinghiem']->phongthinghiemTieuchuans == null): ?>
                                <i>Chưa cập nhật</i>
                            <?php else: ?>
                                <?php foreach ($model['phongthinghiem']->phongthinghiemTieuchuans as $i => $pptcy): ?>
                                    - <?= $pptcy->tc->ten_tc ?> <br>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Nhân sự</th>
                        <td colspan="3" style="text-align: justify">
                            <label class="col-lg-12">Tiến
                                sĩ: <?= ($model['phongthinghiem']->tien_si == null) ? 0 : $model['phongthinghiem']->tien_si ?></label>

                            <label class="col-lg-12">Thạc
                                sĩ: <?= ($model['phongthinghiem']->thac_si == null) ? 0 : $model['phongthinghiem']->thac_si ?></label>

                            <label class="col-lg-12">Kỹ sư/Cử
                                nhân: <?= ($model['phongthinghiem']->cu_nhan == null) ? 0 : $model['phongthinghiem']->cu_nhan ?></label>
                            <label class="col-lg-12">Kỹ thuật
                                viên: <?= ($model['phongthinghiem']->ky_thuat == null) ? 0 : $model['phongthinghiem']->ky_thuat ?></label>

                        </td>
                    </tr>
                    <tr>
                        <th width="20%">Diện tích</th>
                        <td width="30%"><?= ($model['phongthinghiem']->dien_tich != null) ? $model['phongthinghiem']->dien_tich . ' m<sup>2</sup>' : '<i>Chưa cập nhật</i>' ?></td>
                        <th width="20%">Giá trị ước tính</th>
                        <td width="30%"><?= ($model['phongthinghiem']->gia_tri_uoc_tinh != null) ? $model['phongthinghiem']->gia_tri_uoc_tinh : '<i>Chưa cập nhật</i>' ?></td>
                    </tr>
                    <tr>
                        <th>PTN được Công nhận và/hoặc được Chỉ định</th>
                        <td colspan="3" style="text-align: justify">
                            <?php if ($model['phongthinghiem']->phongthinghiemChatluongs == null): ?>
                                <i>Chưa cập nhật</i>
                            <?php else: ?>
                                <?php foreach ($model['phongthinghiem']->phongthinghiemChatluongs as $i => $cncl): ?>
                                    - <?= $cncl->cncl->tieu_chuan ?> <br>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </td>
                    </tr>
                    <tr>
                        <th>PTN là hội viên của</th>
                        <td colspan="3" style="text-align: justify">
                            <?php if ($model['phongthinghiem']->phongthinghiemHoptacs == null): ?>
                                <i>Chưa cập nhật</i>
                            <?php else: ?>
                                <?php foreach ($model['phongthinghiem']->phongthinghiemHoptacs as $i => $hv): ?>
                                    - <?= $hv->tcht->ten_tc ?> <br>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </td>
                    </tr>
                    <tr>
                        <th>Đối tượng phục vụ</th>
                        <td colspan="3" style="text-align: justify">
                            <?= ($model['phongthinghiem']->dtpv != null) ? $model['phongthinghiem']->dtpv->ten_dtpv : '<i>Chưa cập nhật</i>' ?>
                        </td>
                    </tr>
                </table>
                <div class="col-lg-12">
                    <?php if ($model['phongthinghiem']->taikhoan_id == Yii::$app->user->id && $model['phongthinghiem']->taikhoan_id != null): ?>
                        <a href="<?= Yii::$app->urlManager->createUrl('user/phongthinghiem/update') . '?id=' . $model['phongthinghiem']->id_ptn ?>"
                           class="btn btn-warning pull-left">Thay đổi thông tin</a>
                    <?php endif; ?>
                    <a href="<?= Yii::$app->urlManager->createUrl('user/phongthinghiem/index')?>" class="btn btn-default pull-right">Danh sách phòng thí nghiệm</a>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
</div>

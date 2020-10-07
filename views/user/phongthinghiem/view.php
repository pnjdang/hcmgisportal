<?php

/* @var $this yii\web\View */
/* @var $model app\models\Chuyengia */
use yii\helpers\ArrayHelper;

?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Chi tiết phòng thí nghiệm</h4>
</div>
<div class="modal-body">
    <div class="tabbable-line form-group">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#thongtinchung">Thông tin chung</a></li>
            <?php if((!Yii::$app->user->isGuest) && (Yii::$app->user->id == $model['phongthinghiem']->taikhoan_id || (Yii::$app->user->identity->id_loaitk == 1))):?>
            <li><a data-toggle="tab" href="#thietbithunghiem">Thiết bị thử nghiệm</a></li>
            <?php endif?>
            <li><a data-toggle="tab" href="#sohuutritue">Sở hữu trí tuệ</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="thongtinchung">
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

            </div>
            <?php if((!Yii::$app->user->isGuest) && (Yii::$app->user->id == $model['phongthinghiem']->taikhoan_id || (Yii::$app->user->identity->id_loaitk == 1))):?>
            <div class="tab-pane" id="thietbithunghiem">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th>STT</th>
                        <th>Tên thiết bị</th>
                        <th>Số hiệu</th>
                        <th>Hãng sản xuất</th>
                        <th>Nước sản xuất</th>
                        <th>Năm sản xuất</th>
                        <th>Đặc tính kỹ thuật</th>
                        <th>Số lượng</th>
                        <th>Tình trạng</th>
                        <th>Ghi chú</th>
                    </tr>
                    <?php if ($model['phongthinghiem']->phongthinghiemThietbis != null): ?>
                        <?php foreach ($model['phongthinghiem']->phongthinghiemThietbis as $i => $thietbi): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= $thietbi->thietbi->ten_tb ?></td>
                                <td><?= ($thietbi['so_hieu'] != null) ? $thietbi['so_hieu'] : '' ?></td>
                                <td><?= ($thietbi['nam_sx'] != null) ? $thietbi['nam_sx'] : '' ?></td>
                                <td><?= ($thietbi['hang_sx'] != null) ? $thietbi['hang_sx'] : '' ?></td>
                                <td><?= ($thietbi['nuoc_sx'] != null) ? $thietbi['nuoc_sx'] : '' ?></td>
                                <td><?= ($thietbi['dactinh_kythuat'] != null) ? $thietbi['dactinh_kythuat'] : '' ?></td>
                                <td><?= ($thietbi['so_luong'] != null) ? $thietbi['so_luong'] : '' ?></td>
                                <td><?= ($thietbi['tinh_trang'] != null) ? $thietbi['tinh_trang'] : '' ?></td>
                                <td><?= ($thietbi['ghi_chu'] != null) ? $thietbi['ghi_chu'] : '' ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </table>
            </div>
            <?php endif?>
            <div class="tab-pane" id="sohuutritue">
                <table class="table table-bordered table-responsive" id="sohuutritue">
                    <tr>
                        <th>Năm</th>
                        <?php foreach ($model['ketquashtt'] as $i => $ketquashtt): ?>
                            <th><?= $ketquashtt->ten_ketquashtt ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <?php if (isset($model['sohuutritue']) && $model['sohuutritue'] != null): ?>

                        <?php foreach ($model['sohuutritue'] as $nam => $shtt): ?>
                            <tr>

                                <td><?= $nam ?></td>
                                <?php foreach ($model['ketquashtt'] as $i => $ketquashtt): ?>
                                    <td>
                                        <?= isset($shtt[$ketquashtt->id_ketquashtt]) ? $shtt[$ketquashtt->id_ketquashtt]['so_luong'] : 0 ?>

                                    </td>
                                <?php endforeach; ?>

                            </tr>
                        <?php endforeach; ?>
                    <?php endif ?>
                </table>
            </div>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php if($model['phongthinghiem']->taikhoan_id == Yii::$app->user->id && $model['phongthinghiem']->taikhoan_id != null):?>
    <a href="<?= Yii::$app->urlManager->createUrl('user/phongthinghiem/update').'?id='.$model['phongthinghiem']->id_ptn?>" class="btn btn-warning pull-left">Thay đổi thông tin</a>
    <?php endif;?>
    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
</div>
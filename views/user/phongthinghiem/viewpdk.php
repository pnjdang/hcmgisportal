<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/12/2017
 * Time: 8:37 PM
 */
use yii\helpers\ArrayHelper;

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Chi tiết phiếu đăng ký phòng thí nghiệm</h4>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <table class="table table-scrollable-borderless table-responsive">
            <tr>
                <th width="15%">Tên tiếng Việt</th>
                <td colspan="3"
                    class="uppercase"><?= ($model['pdk']->ten_tv != null) ? $model['pdk']->ten_tv : '<i>Chưa cập nhật</i>' ?></td>
            </tr>
            <tr>
                <th width="15%">Tên tiếng Anh</th>
                <td colspan="3"
                    class="uppercase"><?= ($model['pdk']->ten_ta != null) ? $model['pdk']->ten_ta : '<i>Chưa cập nhật</i>' ?></td>
            </tr>
            <tr>
                <th width="15%">Cơ quan chủ quản</th>
                <td colspan="3"><?= ($model['pdk']->coquan_chuquan != null) ? $model['pdk']->coquan_chuquan : '<i>Chưa cập nhật</i>' ?></td>
            </tr>
            <tr>
                <th width="15%">Địa chỉ</th>
                <td colspan="3"><?= ($model['pdk']->dia_chi != null) ? $model['pdk']->dia_chi : '<i>Chưa cập nhật</i>' ?></td>
            </tr>
            <tr>
                <th width="20%">Điện thoại</th>
                <td width="30%"><?= ($model['pdk']->dien_thoai != null) ? $model['pdk']->dien_thoai : '' ?></td>
                <th width="20%">Fax</th>
                <td width="30%"><?= ($model['pdk']->fax != null) ? $model['pdk']->fax : '' ?></td>
            </tr>
            <tr>
                <th width="20%">Email</th>
                <td width="30%"><?= ($model['pdk']->email != null) ? $model['pdk']->email : '' ?></td>
                <th width="20%">Website</th>
                <td width="30%"><?= ($model['pdk']->website != null) ? $model['pdk']->website : '' ?></td>
            </tr>
            <tr>
                <th width="20%">Người phụ trách</th>
                <td width="30%"><?= ($model['pdk']->phu_trach != null) ? $model['pdk']->phu_trach : '' ?></td>
                <th width="20%">Người đại diện</th>
                <td width="30%"><?= ($model['pdk']->dai_dien != null) ? $model['pdk']->dai_dien : '' ?></td>
            </tr>
            <tr>
                <th>Đặc trưng hoạt động</th>
                <td colspan="3" style="text-align: justify">
                    <?= ($model['pdk']->dactrung_hoatdong != null) ? nl2br($model['pdk']->dactrung_hoatdong) : '<i>Chưa cập nhật</i>' ?>
                </td>
            </tr>
            <tr>
                <th>Lĩnh vực thử nghiệm</th>
                <td colspan="3" style="text-align: justify">
                    <?php if ($model['pdk']->phongthinghiemLinhvucs == null): ?>
                        <i>Chưa cập nhật</i>
                    <?php else: ?>
                        <?php foreach ($model['pdk']->phongthinghiemLinhvucs as $i => $lvtn): ?>
                            - <?= $lvtn->lv->ten_lv ?> <br>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Vật liệu và sản phẩm thử nghiệm</th>
                <td colspan="3" style="text-align: justify">
                    <?php if ($model['pdk']->phongthinghiemChungloais == null): ?>
                        <i>Chưa cập nhật</i>
                    <?php else: ?>
                        <?php foreach (ArrayHelper::index($model['pdk']->phongthinghiemChungloais, 'pl_id', 'cl_id') as $i => $cl): ?>
                            <?php $chungloai = array_shift($cl) ?>
                            <label class="uppercase"><?= $chungloai->cl->ten_cl ?></label> <br>
                            <?php array_unshift($cl, $chungloai) ?>
                            <?php foreach ($cl as $k => $pl): ?>
                                <?= ($k + 1) . '. ' . $pl->pl->ten_pl ?> <br>
                            <?php endforeach ?>
                            <br>
                        <?php endforeach ?>

                        <label class="uppercase">CÁC CHỦNG LOẠI VẬT LIỆU VÀ SẢN PHẨM KHÁC</label><br>
                        <?= $model['pdk']->ghichu_chungloai ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Phương pháp thử chủ yếu</th>
                <td colspan="3" style="text-align: justify">
                    <?php if ($model['pdk']->phongthinghiemTieuchuans == null): ?>
                        <i>Chưa cập nhật</i>
                    <?php else: ?>
                        <?php foreach ($model['pdk']->phongthinghiemTieuchuans as $i => $pptcy): ?>
                            - <?= $pptcy->tc->ten_tc ?> <br>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <th>Nhân sự</th>
                <td colspan="3" style="text-align: justify">
                    <label class="col-lg-12">Tiến
                        sĩ: <?= ($model['pdk']->tien_si == null) ? 0 : $model['pdk']->tien_si ?></label>

                    <label class="col-lg-12">Thạc
                        sĩ: <?= ($model['pdk']->thac_si == null) ? 0 : $model['pdk']->thac_si ?></label>

                    <label class="col-lg-12">Kỹ sư/Cử
                        nhân: <?= ($model['pdk']->cu_nhan == null) ? 0 : $model['pdk']->cu_nhan ?></label>
                    <label class="col-lg-12">Kỹ thuật
                        viên: <?= ($model['pdk']->ky_thuat == null) ? 0 : $model['pdk']->ky_thuat ?></label>

                </td>
            </tr>
            <tr>
                <th width="20%">Diện tích</th>
                <td width="30%"><?= ($model['pdk']->dien_tich != null) ? $model['pdk']->dien_tich . ' m<sup>2</sup>' : '<i>Chưa cập nhật</i>' ?></td>
                <th width="20%">Giá trị ước tính</th>
                <td width="30%"><?= ($model['pdk']->gia_tri_uoc_tinh != null) ? $model['pdk']->gia_tri_uoc_tinh : '<i>Chưa cập nhật</i>' ?></td>
            </tr>
            <tr>
                <th>PTN được Công nhận và/hoặc được Chỉ định</th>
                <td colspan="3" style="text-align: justify">
                    <?php if ($model['pdk']->phongthinghiemChatluongs == null): ?>
                        <i>Chưa cập nhật</i>
                    <?php else: ?>
                        <?php foreach ($model['pdk']->phongthinghiemChatluongs as $i => $cncl): ?>
                            - <?= $cncl->cncl->tieu_chuan ?> <br>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </td>
            </tr>
            <tr>
                <th>PTN là hội viên của</th>
                <td colspan="3" style="text-align: justify">
                    <?php if ($model['pdk']->phongthinghiemHoptacs == null): ?>
                        <i>Chưa cập nhật</i>
                    <?php else: ?>
                        <?php foreach ($model['pdk']->phongthinghiemHoptacs as $i => $hv): ?>
                            - <?= $hv->tcht->ten_tc ?> <br>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </td>
            </tr>
            <tr>
                <th>Đối tượng phục vụ</th>
                <td colspan="3" style="text-align: justify">
                    <?= ($model['pdk']->dtpv != null) ? $model['pdk']->dtpv->ten_dtpv : '<i>Chưa cập nhật</i>' ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-lg-12">
        <b class=" uppercase font-blue-steel">Danh sách thiết bị </b>
        <table class="table table-scrollable table-bordered table-responsive">
            <?php if ($model['danhsachthietbi'] != null): ?>
                <tr>
                    <th>STT</th>
                    <th>Tên thiết bị</th>
                    <th>Số hiệu</th>
                    <th>Năm sản xuất</th>
                    <th>Hãng sản xuất</th>
                    <th>Nước sản xuất</th>
                    <th>Đặc tính kỹ thuật</th>
                    <th>Số lượng</th>
                    <th>Tình trạng</th>
                    <th>Ghi chú</th>
                </tr>
                <?php foreach ($model['danhsachthietbi'] as $i => $thietbi): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= ($thietbi['ten_tb'] != null) ? $thietbi['ten_tb'] : '' ?></td>
                        <td><?= ($thietbi['so_hieu'] != null) ? $thietbi['so_hieu'] : '' ?></td>
                        <td><?= ($thietbi['nam_sx'] != null) ? $thietbi['nam_sx'] : '' ?></td>
                        <td><?= ($thietbi['hang_sx'] != null) ? $thietbi['hang_sx'] : '' ?></td>
                        <td><?= ($thietbi['nuoc_sx'] != null) ? $thietbi['nuoc_sx'] : '' ?></td>
                        <td><?= ($thietbi['dactinh_kythuat'] != null) ? $thietbi['dactinh_kythuat'] : '' ?></td>
                        <td><?= ($thietbi['so_luong'] != null) ? $thietbi['so_luong'] : '' ?></td>
                        <td><?= ($thietbi['tinh_trang'] != null) ? $thietbi['tinh_trang'] : '' ?></td>
                        <td><?= ($thietbi['ghi_chu'] != null) ? $thietbi['ghi_chu'] : '' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
    <div class="col-lg-12">
        <b class=" uppercase font-blue-steel">Sở hữu trí tuệ </b>
        <table class="table table-scrollable table-bordered table-responsive">
            <?php if ($model['sohuutritue'] != null): ?>
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
            <?php endif; ?>
        </table>
    </div>
    <div style="clear: both"></div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
</div>



<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/7/2017
 * Time: 3:17 PM
 */

?>

<div id="tab_userthietbi">

    <table class="table table-bordered table-responsive">
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
            <th width="80px"></th>
        </tr>
        <?php if ($model['danhsachthietbi'] != null): ?>
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
                    <td><a class="btn btn-warning btn-xs custom-element-load-ajax-div"
                           data-target-div="#ajaxModalContentTb1" data-toggle="modal" data-target="#ajaxModalTb1"
                           data-url="<?= Yii::$app->homeUrl ?>user/userupdatethietbi?id=<?= $thietbi['id_thietbithunghiem'] ?>"><i
                                class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs custom-element-load-ajax-div"
                           data-target-div="#ajaxModalContentTb1" data-toggle="modal" data-target="#ajaxModalTb1"
                           data-url="<?= Yii::$app->homeUrl ?>user/userdeletethietbi?id=<?= $thietbi['id_thietbithunghiem'] ?>"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>

            <?php endforeach; ?>

        <?php endif; ?>
    </table>
    <div class="col-lg-12 form-group">
        <a class="btn btn-success pull-right custom-element-load-ajax-div"
           data-target-div="#ajaxModalContentTb1" data-toggle="modal" data-target="#ajaxModalTb1"
           data-url="<?= Yii::$app->homeUrl ?>user/usercreatethietbi?id=<?= $model['id_pdk'] ?>">Thêm
            thiết bị</a>
    </div>
    <div class="modal fade" id="ajaxModalTb1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="ajaxModalContentTb1">

            </div>
        </div>
    </div>
    <div style="clear: both"></div>
</div>

<script>
    $(document).ready(function () {
        uiEventUpdate('#tab_userthietbi ');
    });

</script>
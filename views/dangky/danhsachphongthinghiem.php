<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/23/2017
 * Time: 8:52 AM
 */
?>

<div class="row">
    <div class="col-lg-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">Danh sách đăng ký thông tin phòng thí nghiệm</div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-striped table-responsive">
                    <tr>
                        <th>STT</th>
                        <th>Tên phòng thí nghiệm</th>
                        <th>Cơ quan chủ quản</th>
                        <th>Đại diện </th>
                        <th>Phụ trách</th>
                        <th></th>
                    </tr>
                    <?php if($model['pdk'] != null):?>
                        <?php foreach($model['pdk'] as $i => $pdk):?>
                            <tr>
                                <td><?= $pages->page*30 + $i + 1?></td>
                                <td><?= $pdk['ten_tv']?></td>
                                <td><?= $pdk['coquan_chuquan']?></td>
                                <td><?= $pdk['dai_dien']?></td>
                                <td><?= $pdk['phu_trach']?></td>
                                <td>
                                    <?php if($pdk['ket_qua'] == 1):?>
                                    <a class="btn btn-info" href="<?= Yii::$app->homeUrl ?>dangky/phongthinghiem?id=<?=$pdk['id_pdkptn']?>">Chi tiết phiếu đăng ký</a>
                                    <?php endif;?>

                                    <?php if($pdk['ket_qua'] == null):?>
                                    <a class="btn btn-info" href="<?= Yii::$app->homeUrl ?>dangky/kiemduyetphongthinghiem?id=<?=$pdk['id_pdkptn']?>">Kiểm duyệt</a>
                                <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach?>
                    <?php else:?>
                        <tr>
                            <td colspan="8" style="text-align: center"><i>Không có phiếu đăng ký</i></td>
                        </tr>
                    <?php endif?>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: auto">
        <div class="modal-content container" id="ajaxModalContent" style="padding: 0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Chi tiết') ?></h4>
            </div>
            <div class="modal-body" id="ajaxModalBody" style="padding-top: 0">
            </div>
        </div>
    </div>
</div>
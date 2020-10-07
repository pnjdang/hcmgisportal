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
                <div class="caption">Danh sách đăng ký thông tin chuyên gia</div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-striped table-responsive">
                    <tr>
                        <th>STT</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Năm sinh</th>
                        <th>Điện thoại</th>
                        <th>Chuyên môn</th>
                        <th>Lĩnh vực</th>
                        <th>Đơn vị công tác</th>
                        <th></th>
                    </tr>
                    <?php if($model['pdk'] != null):?>
                        <?php foreach($model['pdk'] as $i => $pdk):?>
                            <tr>
                                <td><?= $pages->page*30 + $i + 1?></td>
                                <td><?= $pdk['ho_ten']?></td>
                                <td><?= $pdk['ngay_sinh']?></td>
                                <td><?= $pdk['nam_sinh']?></td>
                                <td><?= $pdk['dien_thoai']?></td>
                                <td><?= $pdk['chuyen_mon']?></td>
                                <td></td>
                                <td><?= $pdk['donvi_congtac']?></td>
                                <td>
                                    <?php if(is_null($pdk['ket_qua'])):?>

                                <a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl('dangky/kiemduyetchuyengia').'?id='.$pdk['id_pdkcg']?>">Kiểm duyệt</a>
                                <?php else:?>
                                        <a class="btn btn-info custom-element-load-ajax-div"
                                           data-target-div="#ajaxModalBody" data-toggle="modal" data-target="#ajaxModal"
                                           data-url="<?= Yii::$app->homeUrl ?>dangky/chuyengia?id=<?=$pdk['id_pdkcg']?>">Chi tiết phiếu đăng ký</a>
                                    <?php endif?>

                                </td>
                            </tr>
                        <?php endforeach?>
                    <?php else:?>
                        <tr>
                            <td colspan="9" style="text-align: center"><i>Không có phiếu đăng ký</i></td>
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
            <div class="modal-body" id="ajaxModalBody">
            </div>
        </div>
    </div>
</div>
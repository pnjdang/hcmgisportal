<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/22/2017
 * Time: 10:18 AM
 */
?>

<div class="row">
    <div class="col-lg-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">Danh sách liên hệ</div>
            </div>
            <div class="portlet-body">
                <table class="table table-responsive table-bordered table-striped">
                    <tr>
                        <th>STT</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <th></th>
                    </tr>
                    <?php if ($model['lienhe'] != null): ?>
                        <?php foreach ($model['lienhe'] as $i => $lienhe): ?>
                            <tr>
                                <td><?= $pages->page * 30 + $i + 1 ?></td>
                                <td><?= $lienhe->ho_ten ?></td>
                                <td><?= $lienhe->email ?></td>
                                <td><?= $lienhe->dien_thoai ?></td>
                                <td><?= $lienhe->noi_dung ?></td>
                                <td><?= $lienhe->created_at ?></td>
                                <td>
                                    <a class="btn btn-info custom-element-load-ajax-div"
                                       data-target-div="#ajaxModalBody" data-toggle="modal" data-target="#ajaxModal"
                                       data-url="<?= Yii::$app->homeUrl ?>admin/reply?id=<?=$lienhe->id_lienhe?>"><i class="fa fa-reply"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif; ?>
                </table>
                <?php if ($model['lienhe'] != null): ?>
                    <div style="text-align: center">
                        <?= \yii\widgets\LinkPager::widget(['pagination' => $pages,]) ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Phản hồi') ?></h4>
            </div>
            <div class="modal-body" id="ajaxModalBody">
            </div>
        </div>
    </div>
</div>
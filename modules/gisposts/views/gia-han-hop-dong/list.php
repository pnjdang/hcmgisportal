<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/19/2021
 * Time: 3:37 PM
 */
use yii\bootstrap\Modal;
use yii\helpers\Html;
use app\modules\DCrud\DCrudAsset;

DCrudAsset::register($this);
?>
<?php if (Yii::$app->request->isAjax): ?>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Ngày gia hạn</th>
                    <th>Thời hạn thuê</th>
                    <th>Người gia hạn</th>
                </tr>
                <?php if ($model['giahan'] != null): ?>
                    <?php foreach ($model['giahan'] as $i => $giahan): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $giahan->ngay_gia_han ?></td>
                            <td><?= $giahan->thoi_han_thue ?></td>
                            <td><?= $giahan->nguoi_gia_han ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4"><i>Chưa có gia hạn hợp đồng</i></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
<?php else: ?>
    <?php
    $requestedAction = Yii::$app->requestedAction;
    $this->title = $const['actions'][$requestedAction->id]['label'];
    $this->params['breadcrumbs'][] = ['label' => 'Danh sách hợp đồng', 'url' => Yii::$app->urlManager->createUrl(['quan-ly/hopdong/index'])];
    $this->params['breadcrumbs'][] = ['label' => $model['hopdong']->so_hop_dong . ' - ' . $model['hopdong']->nguoi_thue, 'url' => Yii::$app->urlManager->createUrl(['quan-ly/hopdong/view','id' => $model['hopdong']->id_hopdong])];
    $this->params['breadcrumbs'][] = $const['actions']['list']['label'];
    ?>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption"><span><?= $this->title?></span></div>
                <div class="caption pull-right">
                    <a class="btn btn-success" role="modal-remote" href="<?= Yii::$app->urlManager->createUrl(['quan-ly/gia-han-hop-dong/create','id' => $model['hopdong']->id_hopdong]) ?>"><i class="fa fa-plus"></i> Gia hạn</a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-lg-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Số hợp đồng</th>
                                <td><?= Html::a($model['hopdong']->so_hop_dong,Yii::$app->urlManager->createUrl(['quan-ly/hopdong/view','id' => $model['hopdong']->id_hopdong]),['class' => 'btn btn-info'])?></td>
                            </tr>
                            <tr>
                                <th>Người thuê</th>
                                <td><?= $model['hopdong']->nguoi_thue ?></td>
                            </tr>
                            <tr>
                                <th>Ngày bắt đầu</th>
                                <td><?= $model['hopdong']->ngay_bat_dau ?></td>
                            </tr>
                            <tr>
                                <th>Ngày hết hạn</th>
                                <td><?= $model['hopdong']->ngay_het_han ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Thời hạn thuê</th>
                                <td><?= $model['hopdong']->thoi_han_thue . ' tháng' ?></td>
                            </tr>
                            <tr>
                                <th>Giá thuê</th>
                                <td align="right"><?= number_format($model['hopdong']->gia_thue,0,'.',',' )?></td>
                            </tr>
                            <tr>
                                <th>Giá giảm</th>
                                <td align="right"><?= number_format($model['hopdong']->gia_giam,0,'.',',' )?></td>
                            </tr>
                            <tr>
                                <th>Giá thuê thực tế</th>
                                <td align="right"><?= number_format($model['hopdong']->gia_phai_tra,0,'.',',' )?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Ngày gia hạn</th>
                                <th>Người gia hạn</th>
                                <th>Thời hạn</th>
                                <th>Giá thuê</th>
                                <th>Giá giảm</th>
                                <th>Giá phải trả</th>
                                <th></th>
                            </tr>
                            <?php if ($model['giahan'] != null): ?>
                                <?php foreach ($model['giahan'] as $i => $giahan): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= $giahan->ngay_gia_han ?></td>
                                        <td><?= $giahan->nguoi_gia_han ?></td>
                                        <td><?= $giahan->thoi_han_thue ?></td>
                                        <td><?= number_format($giahan->gia_thue,0,'.',',' ) ?></td>
                                        <td><?= number_format($giahan->gia_giam,0,'.',',' ) ?></td>
                                        <td><?= number_format($giahan->gia_tra,0,'.',',' ) ?></td>
                                        <td>
                                            <a class="btn btn-warning" role="modal-remote" href="<?= Yii::$app->urlManager->createUrl(['quan-ly/gia-han-hop-dong/update','id' => $giahan->id_giahan])?>"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" role="modal-remote" href="<?= Yii::$app->urlManager->createUrl(['quan-ly/gia-han-hop-dong/delete','id' => $giahan->id_giahan])?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8"><i>Chưa có gia hạn hợp đồng</i></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php Modal::begin([
        "id" => "ajaxCrudModal",
        'size' => Modal::SIZE_LARGE,
        "footer" => "",// always need it for jquery plugin
    ]) ?>
    <?php Modal::end(); ?>
<?php endif; ?>

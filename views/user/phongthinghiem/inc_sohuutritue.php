<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/7/2017
 * Time: 3:18 PM
 */
use yii\helpers\Html;

?>

<div class="col-lg-12" id="tab_usersohuutritue">
    <table class="table table-bordered table-responsive" id="sohuutritue">
        <tr>
            <th>Năm</th>
            <?php foreach ($model['ketquashtt'] as $i => $ketquashtt): ?>
                <th><?= $ketquashtt->ten_ketquashtt ?></th>
            <?php endforeach; ?>
            <th></th>
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
                    <td>
                        <a class="btn btn-warning btn-xs custom-element-load-ajax-div"
                           data-target-div="#ajaxModalContentShtt1" data-toggle="modal" data-target="#ajaxModalShtt1"
                           data-url="<?= Yii::$app->homeUrl ?>user/userupdatesohuutritue?id=<?= $model['id_pdk']?>&nam=<?= $nam ?>"><i
                                class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs custom-element-load-ajax-div"
                           data-target-div="#ajaxModalContentShtt1" data-toggle="modal" data-target="#ajaxModalShtt1"
                           data-url="<?= Yii::$app->homeUrl ?>user/userdeletesohuutritue?id=<?= $model['id_pdk']?>&nam=<?= $nam ?>"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif ?>
    </table>
    <div class="col-lg-12 form-group">
        <a class="btn btn-success pull-right custom-element-load-ajax-div"
           data-target-div="#ajaxModalContentShtt1" data-toggle="modal" data-target="#ajaxModalShtt1"
           data-url="<?= Yii::$app->homeUrl ?>user/usercreatesohuutritue?id=<?= $model['id_pdk'] ?>">Thêm sở hữu
            trí tuệ</a>
    </div>
</div>
<div style="clear: both"></div>
<div class="modal fade" id="ajaxModalShtt1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" >
        <div class="modal-content" id="ajaxModalContentShtt1">

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        uiEventUpdate('#tab_usersohuutritue ');
    });
</script>
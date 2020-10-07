<div style="font-family: Tahoma" class="phongthinghiem-item" data-point-x="<?= $model["geo_x"] ?>" data-point-y="<?= $model["geo_y"] ?>">
    <div class="ten"> <?= $model['ten_tv'] ?> </div>
    <div class="diachi"><i class="fa fa-map-marker"></i> <?=$model['dia_chi']  ?></div>
    <div class="dienthoai"><i class="fa fa-phone"></i> <?= (($model['dien_thoai'] == NULL) ? '(Chưa có)' : $model['dien_thoai'] ) ?> - <i class="fa fa-fax"></i> <?= (($model['fax'] == NULL) ? '(Chưa có)' : $model['fax'] ) ?>  </div>
    <div class="email"><i class="fa fa-envelope"></i> <?= (($model['email'] == NULL) ? '(Chưa có)' : $model['email'] ) ?> - <i class="fa fa-internet-explorer"></i> <?= (($model['website'] == NULL) ? '(Chưa có)' : $model['website'] ) ?> </div>
    <div class="daidien"><i class="fa fa-user"></i> <?= $model['dai_dien'] ?></div>
    <?php if(!Yii::$app->user->isGuest):?>
    <div><a class="btn btn-default btn-xs custom-element-load-ajax-div pull-right" data-target-div="#ajaxModalContent" onclick="PhongthinghiemView(<?= $model['id_ptn'] ?>)"  data-toggle="modal" data-target="#ajaxModal">Xem chi tiết</a></div>
    <?php endif?>
</div>
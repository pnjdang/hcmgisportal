<div class="col-lg-12 border-bottom-1px-solid border-bottom-blue-soft">
    <div style="font-size: 11px; margin-bottom: 10px" class="font-red-haze pull-right"><b>Có <?= $totalcount ?> kết quả</b></div>
</div>
<div class="mt-element-list phongthinghiem-list">
    <div class="mt-list-container list-simple ext-1 phongthinghiem-list" style='max-height: 549px; overflow: auto'>
        <?php foreach ($models as $model): ?>
            <div class="phongthinghiem-item border-bottom-1px-solid border-bottom-blue-soft" style="font-family: Tahoma" data-point-x="<?= $model["geo_x"] ?>"
                 data-point-y="<?= $model["geo_y"] ?>">
                <div class="col-lg-12">
                    <div class="ten"> <a class="custom-element-load-ajax-div" data-target-div="#ajaxModalContent" onclick="PhongthinghiemView(<?= $model['id_ptn'] ?>)"  data-toggle="modal" data-target="#ajaxModal"><?= (($model['ten_tv'] == NULL) ? '(Chưa có)' : $model['ten_tv']) ?></a>

                    </div>
                    <div class="daidien"><i class="fa fa-user"></i> <?= $model['dai_dien'] ?></div>
                    <div class="cmnd"><?php if ($model["geo_x"] != null): ?>
                            <span style='color: blue'><i class="fa fa-map-marker"></i></span>
                        <?php else: ?>
                            <span style=''><i style='color: red' class="fa fa-map-marker"></i></span>
                        <?php endif; ?> <?= (($model['dia_chi'] == NULL) ? '(Chưa có)' : $model['dia_chi']) ?>
                    </div>
                    <div class="email" title="<?= $model['email'] ?>"><i
                            class="fa fa-envelope"></i> <?= $model['email'] ?></div>
                  
                      <div class="dienthoai"><i
                            class="fa fa-phone"></i> <?= (($model['dien_thoai'] == NULL) ? '(Chưa có)' : $model['dien_thoai']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="modal fade" id="ajaxModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="ajaxModalContent">

        </div>
    </div>
</div>
<?= yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
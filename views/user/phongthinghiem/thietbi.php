<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/7/2017
 * Time: 3:17 PM
 */
use kartik\grid\GridView;
\kartik\form\ActiveFormAsset::register($this);

?>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="font-blue-steel">Đăng ký thông tin phòng thí nghiệm</span>
                </div>
            </div>
            <div class="portlet-body">
                <h4 style="text-align: center">Danh sách thiết bị thử nghiệm</h4>

                <div class="col-lg-12" id="tab_userthietbi">


                </div>

                <div class="col-lg-12" style="text-align: center">
                    <a href="<?=Yii::$app->homeUrl?>user/usersohuutritue?id=<?=$model['id_pdk']?>" class="btn btn-primary"><i class="fa fa-angle-double-right"></i> Tiếp tục</a>
                </div>
                <div style="clear: both"></div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        reloadTable('#tab_userthietbi','<?= Yii::$app->urlManager->createUrl('user/userlistthietbi?id=').$model['id_pdk']?>');
    });
</script>
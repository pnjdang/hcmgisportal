<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 2:16 PM
 */
?>


<div class="page-content-inner">
    <div class="portlet light portlet-fit bordered">
        <div class="portlet-body">
            <div class="input-group">
                <form method="post" class="input-group" action="<?= Yii::$app->homeUrl ?>user/search">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                    <select class="form-control" name="chon_lop">
                     
                        <option value="0" selected>Phòng thí nghiệm</option>
                    </select>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary"><i
                                class="fa fa-search"></i></button>
                    </span>
                    <input type="text" id="input1-group2" name="ho_ten" class="form-control"
                           placeholder="Tìm kiếm"
                           style="background-repeat: no-repeat;background-attachment: scroll;background-size: 16px 18px;width: 350px;background-position: 98% 50%;cursor: auto;"
                           autocomplete="off">
                </form>
            </div>
            <div id="map" style="width:100%;height: 550px;margin-top: 5px">
            </div>

            <!-- END MARKERS PORTLET-->

        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="ajaxModalContent">

        </div>
    </div>
</div>
<script>
    initializeMap('map');
    function PTNView(id_ptn) {
        var url_cg = "<?= Yii::$app->homeUrl ?>user/phongthinghiem/viewptn?id=" + id_ptn;
       // var name = "Chi tiết phòng thí nghiệm";
        $.get(url_cg, function (res) {
            $('#ajaxModalContent').empty().html(res);
           // $('#myPTNLabel').empty().html(name);
        })
    }

</script>
<?php

use yii\bootstrap\Modal;
?>
<div class="row">

    <!-- BEGIN MARKERS PORTLET-->
    <div class="portlet light portlet-fit bordered">
        <div class="portlet-body">
            <div class="input-group">
                <form method="post" class="input-group" action="<?= Yii::$app->homeUrl ?>site/search">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                    <select class="form-control" name="chon_lop">
                        <option value="1">Chuyên gia</option>
                        <option value="0">Phòng thí nghiệm</option>
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
    <div class="modal-dialog" role="document" style="width: auto">
        <div class="modal-content container" id="ajaxModalContent" style="padding: 0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Thêm mới Phòng thí nghiệm</h4>
            </div>
            <div class="modal-body custom-ajax-form" id="ajaxModalBody">

            </div>
        </div>
    </div>
</div>
<style>
    /*
     * These CSS rules affect the tooltips within maps with the custom-popup
     * class. See the full CSS for all customizable options:
     * https://github.com/mapbox/mapbox.js/blob/001754177f3985c0e6b4a26e3c869b0c66162c99/theme/style.css#L321-L366
     */
    .custom-popup .leaflet-popup-content-wrapper {
        background: #2c3e50;
        color: #fff;
        font-size: 16px;
        line-height: 24px;
    }

    .custom-popup .leaflet-popup-content-wrapper a {
        color: rgba(255, 255, 255, 0.5);
    }

    .custom-popup .leaflet-popup-tip-container {
        width: 30px;
        height: 15px;
    }

    .custom-popup .leaflet-popup-tip {
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-top: 15px solid #2c3e50;
    }

    .search-tip b {
        color: #fff;
    }

    .search-tip {
        white-space: nowrap;
    }

    .search-tip b {
        display: inline-block;
        clear: left;
        float: right;
        padding: 0 4px;
        margin-left: 4px;
    }

</style>
<script>

    initializeMap('map');

    function aside_detail(id_cg) {
        //var id = id_dn;
        //$("body").removeClass("aside-menu-hidden");


        var url = "<?= Yii::$app->homeUrl ?>dschuyengia/viewmap?id=" + id_cg;
        $("body").removeClass("page-quick-sidebar");
        document.getElementById("timeline").className = "tab-pane";
        document.getElementById("messages").className = "tab-pane active";
        document.getElementById("timeline_nav").className = "nav-item";
        document.getElementById("messages_nav").className = "nav-item active";
        $.get(url, function (res) {
            document.getElementById("messages").innerHTML = res;
        })


    }
    function PhongthinghiemView(id_ptn) {
        var url_cg = "<?= Yii::$app->homeUrl?>admin/phongthinghiem/viewptn?id="+id_ptn;
        var name = "Chi tiết phòng thí nghiệm";
        $.get(url_cg, function (res) {
            $('#ajaxModalBody').empty().html(res);
            $('#myModalLabel').empty().html(name);
        })
    }
    function ChuyengiaView(id_cg) {
        var url_cg = "<?= Yii::$app->homeUrl?>dschuyengia/viewchuyengia?id="+id_cg;
        var name = "Chi tiết chuyên gia";
        $.get(url_cg, function (res) {
            $('#ajaxModalBody').empty().html(res);
            $('#myModalLabel').empty().html(name);
        })
    }
</script>
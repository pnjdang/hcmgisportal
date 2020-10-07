<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 3:07 PM
 */
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use yii\bootstrap\Modal;
CrudAsset::register($this);
?>
<div class="page-content-inner" style="padding-top: 20px">

    <div class="row">
        <div class="col-lg-12 form-group">
            <div class="portlet box">
                <div class="portlet-title bg-primary">
                    <div class="caption">
                        <span><i class="fa fa-search"></i> Tìm kiếm</span>
                    </div>
                    <div class="tools">
                        <button type="button"
                                class="btn btn-circle btn-default"
                                data-target-div="#ajaxModalBody"
                                data-toggle="modal"
                                data-target="#ajaxModal" title="Thêm mới chuyên gia"
                                onclick="ChuyengiaCreate()"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    <form role="form" class="form-horizontal" id="ChuyengiaSearchUser">
                        <div class="form-body col-md-8">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Họ tên</label>

                                <div class="col-md-8">
                                    <div class="input-icon right">
                                        <input id="cg_hotensearch" name="ChuyengiaSearchUser[ten_tv]" type="text"
                                               class="form-control"></div>
                                </div>
                            </div>
                            <div id="adv-search" aria-expanded="false" style="height: 0px;" class="collapse">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Đơn vị công tác</label>

                                <div class="col-md-8">
                                    <div class="input-icon right">
                                        <input type="text" id="cg_donvisearch" name="ChuyengiaSearchUser[don_vi]"
                                               class="form-control"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Chuyên ngành</label>

                                <div class="col-md-8">
                                    <div class="input-icon right">
                                        <input type="text" id="cg_chuyenmonsearch"
                                               name="ChuyengiaSearchUser[chuyen_mon]"
                                               class="form-control"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Định hướng nghiên cứu</label>

                                <div class="col-md-8">
                                    <div class="input-icon right">
                                        <input type="text" id="cg_dinhhuongsearch"
                                               name="ChuyengiaSearchUser[dinh_huong]"
                                               class="form-control"></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-actions col-md-4">
                            <div class="row">
                                <button type="button" id="cgsearch_btn" onclick="ChuyengiaSearch()" class="btn btn-info">Tìm kiếm</button>
                                <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#adv-search">nâng cao</button>
                                <button type="button" class="btn btn-danger" onclick="ChuyengiaSearch(0)">Xoá</button>

                            </div>
                        </div>
                    </form>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="cg-table">
        <div class="col-md-12 col-sm-12">
            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?=
                    GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $dataProvider,
                        'pjax' => true,
                        'columns' => require(__DIR__ . '/chuyengia/_columns.php'),
                        'toolbar' => [

                        ],
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'type' => 'primary',
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách chuyên gia',
                        ]
                    ])
                    ?>
                    <?php
                    Modal::begin([
                        "id" => "ajaxCrudModal",
                        'size' => Modal::SIZE_LARGE,

                    ])
                    ?>
                    <?php Modal::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="width: auto">
            <div class="modal-content container" id="ajaxModalContent" style="padding: 0">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Chi tiết') ?></h4>
                </div>
                <div class="modal-body custom-ajax-form" id="ajaxModalBody">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">


    $('#ChuyengiaSearchUser').keypress(function (event) {
        if (event.keyCode == 13) {
            console.log("1");
            $('#cgsearch_btn').click();
        }
    });


    function ChuyengiaCreate() {
        var url_cg = "<?= Yii::$app->homeUrl?>user/createchuyengia";
        var name = "Tạo mới chuyên gia";
        $.get(url_cg, function (res) {
            $('#ajaxModalBody').empty().html(res);
            $('#myModalLabel').empty().html(name);
        })
    }


    function ChuyengiaSearch(data) {
        var cg_hotensearch = $("#cg_hotensearch").val();
        var cg_donvisearch = $("#cg_donvisearch").val();
        var cg_chuyenmonsearch = $("#cg_chuyenmonsearch").val();
        var cg_dinhhuongsearch = $("#cg_dinhhuongsearch").val();
        if (data == 0) {
            $("#cg_hotensearch").val('');
            $("#cg_donvisearch").val('');
            $("#cg_chuyenmonsearch").val('');
            $("#cg_dinhhuongsearch").val('');
            cg_hotensearch = cg_donvisearch = cg_chuyenmonsearch = cg_dinhhuongsearch = '';
        }
        var url = "<?= Yii::$app->homeUrl ?>user/userchuyengia?hoten=" + cg_hotensearch + "&donvi=" + cg_donvisearch + "&chuyenmon=" + cg_chuyenmonsearch + "&dinhhuong=" + cg_dinhhuongsearch;


        $.get(url, function (res) {
            $('#cg-table').empty().html(res)
        })


//        $.ajax({
//            url: url,
//            type: 'GET',
//            dataType: 'json',
//
//        }).done(function (res) {
//            console.log(11111)
//        })
    }
</script>



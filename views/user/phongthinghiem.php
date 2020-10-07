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
        <div class="col-lg-12">
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
                                data-target="#ajaxModal" title="Thêm mới phòng thí nghiệm"
                                onclick="PhongthinghiemCreate()"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    <form role="form" class="form-horizontal" id="PhongthinghiemSearchUser">
                        <div class="form-body col-md-8">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tên tiếng việt</label>

                                <div class="col-md-8">
                                    <div class="input-icon right">
                                        <input id="ptn_tentv" name="PhongthinghiemSearch[ten_tv]"
                                               type="text" class="form-control"></div>
                                </div>
                            </div>
                            <div id="adv-search" aria-expanded="false" style="height: 0px;" class="collapse">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tên tiếng anh</label>

                                <div class="col-md-8">
                                    <div class="input-icon right">
                                        <input type="text" id="ptn_tenta" name="PhongthinghiemSearch[ten_ta]"
                                               class="form-control"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Cơ quan chủ quản</label>

                                <div class="col-md-8">
                                    <div class="input-icon right">
                                        <input type="text" id="ptn_cqcq" name="PhongthinghiemSearch[coquan_chuquan]"
                                               class="form-control"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Người đại diện</label>

                                <div class="col-md-8">
                                    <div class="input-icon right">
                                        <input type="text" id="ptn_daidien" name="PhongthinghiemSearch[dai_dien]"
                                               class="form-control"></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-actions col-md-4">
                            <div class="row">
                                <button type="button" id="ptnsearch_btn" onclick="PhongthinghiemSearch()" class="btn btn-info">Tìm kiếm</button>
                                <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#adv-search">nâng cao</button>
                                <button type="button" class="btn btn-danger" onclick="PhongthinghiemSearch(0)">Xoá</button>
                            </div>
                        </div>
                    </form>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="ptn-table">
        <div class="col-md-12 col-sm-12">
            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?=
                    GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $dataProvider,
                        'pjax' => true,
                        'columns' => require(__DIR__ . '/phongthinghiem/_columns.php'),
                        'toolbar' => [],
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'type' => 'primary',
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách phòng thí nghiệm',
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
                            aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Thêm mới Phòng thí nghiệm</h4>
                </div>
                <div class="modal-body custom-ajax-form" id="ajaxModalBody">

                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    $('#PhongthinghiemSearchUser').keypress(function (event) {
        if (event.keyCode == 13) {
            $('#ptnsearch_btn').click();
        }
    });


    function PhongthinghiemCreate() {
        var url_cg = "<?= Yii::$app->homeUrl?>user/usercreatephongthinghiem";
        var name = "Tạo mới phòng thí nghiệm";
        $.get(url_cg, function (res) {
            $('#ajaxModalBody').html(res);
            $('#myModalLabel').empty().html(name);
        })
    }

    function PhongthinghiemSearch(data) {
        var ptn_tentv = $("#ptn_tentv").val();
        var ptn_tenta = $("#ptn_tenta").val();
        var ptn_cqcq = $("#ptn_cqcq").val();
        var ptn_daidien = $("#ptn_daidien").val();
        if (data == 0) {
            $("#ptn_tentv").val('');
            $("#ptn_tenta").val('');
            $("#ptn_cqcq").val('');
            $("#ptn_daidien").val('');
            ptn_tentv = ptn_tenta = ptn_cqcq = ptn_daidien = '';
        }
        var url = "<?= Yii::$app->homeUrl ?>user/phongthinghiem?tentv=" + ptn_tentv + "&tenta=" + ptn_tenta + "&cqcq=" + ptn_cqcq + "&daidien=" + ptn_daidien;
        //console.log(url);

        $.get(url, function (res) {
            $('#ptn-table').html(res)
        })
    }
</script>


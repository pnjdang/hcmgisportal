<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="row">
       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-red-haze">
                        <span data-counter="counterup" data-value="1349"><?= $chuyengia?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index')?>">Chuyên gia</a></small>
                </div>
                <div class="icon">
                    <i class="fa fa-user-circle-o"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="567"><?= $pdk?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->urlManager->createUrl('admin/dangky/chuyengia')?>">Phiếu đăng ký mới</a></small>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
            </div>
        </div>
    </div>
  
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Theo Lĩnh vực nghiên cứu</span>
                </div>
                <div class="actions">
<!--                    <a class="btn btn-circle btn-icon-only btn-default" href="#">-->
<!--                        <i class="icon-cloud-upload"></i>-->
<!--                    </a>-->
<!--                    <a class="btn btn-circle btn-icon-only btn-default" href="#">-->
<!--                        <i class="icon-wrench"></i>-->
<!--                    </a>-->
<!--                    <a class="btn btn-circle btn-icon-only btn-default" href="#">-->
<!--                        <i class="icon-trash"></i>-->
<!--                    </a>-->
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                    <button type="button" class="btn btn-circle btn-icon-only btn-success" onclick="tableToExcel('linhvucTable', 'W3C Example Table')"><i class="fa fa-file-excel-o"></i></button>

                </div>
            </div>
            <div class="portlet-body">
                <table id="linhvucTable" class="table table-bordered table-striped">
                    <tr>
                        <th>Lĩnh vực nghiên cứu 1</th>
                        <th>Lĩnh vực nghiên cứu 2</th>
                        <th>Lĩnh vực nghiên cứu 3</th>
                        <th>Số lượng chuyên gia</th>
                    </tr>
                    <?php if($thongke['linhvuc'] != null):?>
                        <?php foreach($thongke['linhvuc'] as $i => $linhvuc):?>
                            <tr>
                                <th rowspan="<?= (isset($linhvuc['cap2s'])) ? sizeof($linhvuc['cap2s']) + $linhvuc['sl_cap3'] + 1 : 1?>"><span class="uppercase"><?= $linhvuc['ten_cap1']?></span></th>
                                <td colspan="2"></td>
                                <td align="right"><?= $linhvuc['so_luong']?></td>
                            </tr>
                            <?php if(isset($linhvuc['cap2s'])):?>
                            <?php foreach($linhvuc['cap2s'] as $k => $cap2s):?>
                                <tr>
                                    <th rowspan="<?= sizeof($cap2s['cap3s']) + 1?>"><?= $cap2s['ten_cap2']?></th>
                                    <td></td>
                                    <td align="right"><?= $cap2s['so_luong']?></td>
                                </tr>
                                    <?php foreach($cap2s['cap3s'] as $l => $cap3s):?>
                                        <tr>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/chuyennganhchitiet').'?id='.$cap3s['id_cap3']?>"><?= $cap3s['ten_cap3']?></a></td>
                                            <td align="right"><?= $cap3s['so_luong']?></td>
                                        </tr>
                                    <?php endforeach?>
                            <?php endforeach?>
                            <?php endif?>
                        <?php endforeach?>
                    <?php endif?>
                </table>
            </div>
        </div>
    </div>
   <div class="col-md-6 col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Theo học hàm</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="chart2" class="" style="height: 400px;width: 100%"></div>
            </div>
        </div>
    </div>
     <div class="col-md-6 col-sm-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Theo học vị</span>
                </div>
                <div class="actions">

                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="chart3" class="" style="height: 400px;width: 100%"></div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
<script>


    var chart2 = AmCharts.makeChart( "chart2", {
        "type": "pie",
        "theme": "light",
        "legend":{
            "position":"right",
            "marginRight":100,
            "autoMargins":false
        },
        "innerRadius": "30%",
        "defs": {
            "filter": [{
                "id": "shadow",
                "width": "200%",
                "height": "200%",
                "feOffset": {
                    "result": "offOut",
                    "in": "SourceAlpha",
                    "dx": 0,
                    "dy": 0
                },
                "feGaussianBlur": {
                    "result": "blurOut",
                    "in": "offOut",
                    "stdDeviation": 5
                },
                "feBlend": {
                    "in": "SourceGraphic",
                    "in2": "blurOut",
                    "mode": "normal"
                }
            }]
        },
        "labelsEnabled": false,
        "dataProvider": <?= json_encode($thongke['hocham'], JSON_UNESCAPED_UNICODE)?> ,
        "valueField": "so_luong",
        "titleField": "ten_hh",
        "balloon":{
            "fixedPosition":true
        },
        "export": {
            "enabled": true
        }
    } );
     var chart3 = AmCharts.makeChart( "chart3", {
        "type": "pie",
        "theme": "light",
        "legend":{
            "position":"right",
            "marginRight":100,
            "autoMargins":false
        },
        "defs": {
            "filter": [{
                "id": "shadow",
                "width": "200%",
                "height": "200%",
                "feOffset": {
                    "result": "offOut",
                    "in": "SourceAlpha",
                    "dx": 0,
                    "dy": 0
                },
                "feGaussianBlur": {
                    "result": "blurOut",
                    "in": "offOut",
                    "stdDeviation": 5
                },
                "feBlend": {
                    "in": "SourceGraphic",
                    "in2": "blurOut",
                    "mode": "normal"
                }
            }]
        },
        "labelsEnabled": false,
        "dataProvider": <?= json_encode($thongke['hocvi'], JSON_UNESCAPED_UNICODE)?> ,
        "valueField": "so_luong",
        "titleField": "ten_hv",
        "balloon":{
            "fixedPosition":true
        },
        "export": {
            "enabled": true
        }
    } );
</script>
<script type="text/javascript">
    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
        }
    })()
</script>
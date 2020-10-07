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
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="7800"><?= $ptn?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->homeUrl?>dsphongthinghiem">Phòng thí nghiệm</a></small>
                </div>
                <div class="icon">
                    <i class="fa fa-flask"></i>
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
                    <small><a href="<?= Yii::$app->urlManager->createUrl('admin/dangky/phongthinghiem')?>">Phiếu đăng ký mới</a></small>
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
                    <span class="caption-subject bold uppercase font-dark">Theo Quận/Huyện</span>
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
                </div>
            </div>
            <div class="portlet-body">
                <div id="chart2" class="" style="height: 400px;width: 100%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Theo lĩnh vực thử nghiệm</span>
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

    var chart1 = AmCharts.makeChart( "chart1", {
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
        "valueField": "sl_chuyengia",
        "titleField": "ten_lvql",
        "balloon":{
            "fixedPosition":true
        },
        "export": {
            "enabled": true
        }
    } );
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
        "dataProvider": <?= json_encode($tkptnqh, JSON_UNESCAPED_UNICODE)?> ,
        "valueField": "sl_ptn",
        "titleField": "quan_huyen",
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
        "dataProvider": <?= json_encode($tkptnlv, JSON_UNESCAPED_UNICODE)?> ,
        "valueField": "sl_ptn",
        "titleField": "ten_lv",
        "balloon":{
            "fixedPosition":true
        },
        "export": {
            "enabled": true
        }
    } );
</script>
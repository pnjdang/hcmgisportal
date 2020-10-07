<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<!-- BEGIN PAGE HEAD-->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Tổng quan
        </h1>
    </div>
    <!-- END PAGE TITLE -->

</div>
<!-- END PAGE HEAD-->

<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="7800"><?= $ptn ?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->homeUrl ?>dsphongthinghiem">Phòng thí nghiệm</a></small>
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
                    <h3 class="font-red-haze">
                        <span data-counter="counterup" data-value="1349"><?= $chuyengia ?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index') ?>">Chuyên
                            gia</a></small>
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
                        <span data-counter="counterup" data-value="567"><?= $pdkphongthinghiem ?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->urlManager->createUrl('admin/dangky/phongthinghiem') ?>">Phiếu đăng
                            ký phòng thí nghiệm</a></small>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-purple-soft">
                        <span data-counter="counterup" data-value="276"><?= $pdkchuyengia ?></span>
                    </h3>
                    <small><a href="<?= Yii::$app->urlManager->createUrl('admin/dangky/chuyengia') ?>">Phiếu đăng ký
                            chuyên gia</a></small>
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
                    <span class="caption-subject bold uppercase font-dark">Chuyên gia lĩnh vực</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="chart1" class="" style="height: 500px;width: 100%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Chuyên gia chuyên ngành</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="chart2" class="" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>

<!-- END PAGE BASE CONTENT -->
<script>

    var chart = AmCharts.makeChart("chart1", {
        "type": "serial",
        "theme": "light",
        "marginRight": 70,
        "dataProvider": <?= json_encode($model['chuyengialinhvuc'], JSON_UNESCAPED_UNICODE)?>,
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": ""
        }],
        "rotate": true,
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<b>Số lượng chuyên gia hoạt động trong lĩnh vực [[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "soluong"
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "ten_linhvuc",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
        },
        "export": {
            "enabled": true
        }



    });
    var chart2 = AmCharts.makeChart("chart2", {
        "type": "pie",
        "theme": "light",
        "legend": {
            "position": "right",
            "marginRight": 100,
            "autoMargins": false
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
        "dataProvider": <?= json_encode($model['chuyengiachuyennganh'], JSON_UNESCAPED_UNICODE)?>,
        "valueField": "soluong",
        "titleField": "ten_chuyennganh",
        "balloon": {
            "fixedPosition": true
        },
        "export": {
            "enabled": true
        }
    });
    var chart3 = AmCharts.makeChart("chart3", {
        "type": "pie",
        "theme": "light",
        "legend": {
            "position": "right",
            "marginRight": 100,
            "autoMargins": false
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
        "dataProvider": <?= json_encode($model['chuyengiachuyennganh'], JSON_UNESCAPED_UNICODE)?>,
        "valueField": "soluong",
        "titleField": "ten_chuyennganh",
        "balloon": {
            "fixedPosition": true
        },
        "export": {
            "enabled": true
        }
    });
</script>
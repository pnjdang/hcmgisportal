<?php ?>

<style>
    #map {
        width: 100%;
        height: 100%;
        min-height: 700px;
    }

    .height100 {
        height: 100%;
    }

    .no-padding {
        padding: 0px !important;
    }

    #geocomplete-wrapper {
        position: absolute;
        top: 10px;
        left: 40px;
        z-index: 1000;
        width: 500px;
    }
    #geocomplete { background-color: rgba(255,255,255,0.8); }



</style>
<div class="page-content-inner">
    <div class="portlet light portlet-fit bordered" >
        <div class="col-md-12 height100 no-padding">
            <div class="col-md-9 height100 no-padding">
              
                <div id="map"></div>
            </div>
            <div class="col-md-3 no-padding">
                <div class="portlet light bordered no-padding" style="margin-bottom: 0">
                    <div id='list_extend'></div>
                    <div class="portlet-title">
                        <div class="col-lg-12">
                            <div class="caption" style='width: 100%; padding-top: 7px'>
                                <input class="form-control" id='search-box' placeholder='Nhập thông tin cần tìm'>
                                <span class="caption-subject font-dark bold uppercase"></span>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id='list_phongthinghiem'></div>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>
</div>

<div class="modal fade" id="ajaxModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="ajaxModalContent">

        </div>
    </div>
</div>
<script>
    var defined = {
        layer_phongthinghiem: "Phòng thí nghiệm"
    };
    var DATA = {
        HomeUrl: "",
        MapConfig: {
            mapId: "map",
            defaultCenter: [10.774165, 106.699478],
            defaultZoom: 15,
            defaultConfig: {maxZoom: 18},
            baseLayers: ["Bản đồ Google", "HCMGIS", "Ảnh vệ tinh", "MapBox"],
            overLayers: [],
            activeLayers: ["Bản đồ Google"],
            initOthers: [initPhongthinghiemGeojsonLayer, initFocusCircleLayer, initMapZoomEvent],
//            control: {
//                geocomplete: {
//                    InputId: "#geocomplete",
//                    config: {
//                        country: "vn"
//                    }
//                }
//            }
        },
        MapLayer: {
            baselayer: {},
            overlayers: {},
        },
        MapControl: {},
        Refs: {
            Markers: [],
            LeafletLayers: {
                "HCMGIS": L.tileLayer.wms('http://pcd.hcmgis.vn/geoserver/ows?', {
                    layers: 'hcm_map:hcm_map'
                }),
                "Ảnh vệ tinh": L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                    maxZoom: 24,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                }),
                "MapBox": L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2thZGFtYmkiLCJhIjoiY2lqdndsZGg3MGNua3U1bTVmcnRqM2xvbiJ9.9I5ggqzhUVrErEQ328syYQ#3/0.00/0.00', {
                    maxZoom: 18,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    id: 'streets-v9',
                    //  accessToken: 'pk.eyJ1Ijoic2thZGFtYmkiLCJhIjoiY2lqdndsZGg3MGNua3U1bTVmcnRqM2xvbiJ9.9I5ggqzhUVrErEQ328syYQ'
                }),
                "Bản đồ Google": L.tileLayer('http://{s}.google.com/vt/lyrs=' + 'r' + '&x={x}&y={y}&z={z}', {
                    maxZoom: 24,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }),
            }
        }
    };
    $(document).ready(function () {
        initMap();
        initListPhongthinghiem();
    })

    function initMap(config) {
        if (typeof (config) == 'undefined') {
            config = DATA.MapConfig;
        }

        DATA[config.mapId] = {};
        DATA[config.mapId].Map = new L.Map(config.mapId, config.defaultConfig);
        DATA[config.mapId].Map.setView(config.defaultCenter, config.defaultZoom);
        DATA[config.mapId].Map.on('click', function (e) {
            console.log(e);
        });
        DATA[config.mapId].MapControl = {};
        DATA[config.mapId].MapLayer = {baseLayers: {}, overLayers: {}};
        initOther(config);
        initMapLayer(config);
        initMapControl(config);
    }

    function initOther(config) {
        config = DATA.MapConfig;
        config.initOthers.map(function (func) {
            func(config)
        });
    }

    function initMapControl(config) {
        initControlMapLayer(config);
        //  initControlGeocomplete(config);
    }

    function initMapLayer(config) {
        config.baseLayers.map(function (layer) {
            DATA[config.mapId].MapLayer.baseLayers[layer] = DATA.Refs.LeafletLayers[layer];
        });
        config.overLayers.map(function (layer) {
            DATA[config.mapId].MapLayer.overLayers[layer] = DATA.Refs.LeafletLayers[layer];
        });
        config.activeLayers.map(function (layer) {
            DATA.Refs.LeafletLayers[layer].addTo(DATA[config.mapId].Map);
        });
    }

    function initControlMapLayer(config) {
        DATA[config.mapId].MapControl.layercontrol = L.control.layers(DATA[config.mapId].MapLayer.baseLayers, DATA[config.mapId].MapLayer.overLayers);
        DATA[config.mapId].MapControl.layercontrol.addTo(DATA[config.mapId].Map);
    }

    function initControlGeocomplete(config) {
        if (typeof (config.control.geocomplete) == 'undefined')
            return;
        $(config.control.geocomplete.InputId)
                .geocomplete(config.control.geocomplete.config)
                .bind("geocode:result", function (event, result) {
                    DATA[config.mapId].Map.panTo([result.geometry.location.lat(), result.geometry.location.lng()]);
                    var marker = L.marker([result.geometry.location.lat(), result.geometry.location.lng()]);
                    marker.addTo(DATA[config.mapId].Map);
                });
    }

    function initPhongthinghiemGeojsonLayer(config) {
        $.ajax({
            url: DATA.HomeUrl + 'user/bando/phongthinghiem-geojson',
            dataType: 'json',
            success: function (data) {
                var pruneCluster = new PruneClusterForLeaflet();
                data.map(function (item) {
                    var prunemarker = new PruneCluster.Marker(item.geo_y, item.geo_x);
                    prunemarker.data = item;
                    pruneCluster.RegisterMarker(prunemarker);
                });
                DATA.Refs.LeafletLayers[defined.layer_phongthinghiem] = pruneCluster;
                DATA[config.mapId].Map.addLayer(pruneCluster);
                pruneCluster.PrepareLeafletMarker = function (leafletMarker, data) {
                    var popupid = 'marker-popup-' + data.id;
                    leafletMarker.bindPopup('<div id="' + popupid + '"></div>');

                    leafletMarker.on('click', function () {
                        var popupid = 'marker-popup-' + data.id;
                        mapZoomAndPanTo(data.geo_y, data.geo_x);
                        $.ajax({
                            url: DATA.HomeUrl + 'user/bando/phongthinghiem-get/?slug=' + data.id,
                            success: function (html) {
                                $('#' + popupid).empty().append(html);
                            }
                        })
                    })
                    var myIcon = L.divIcon({
                        iconSize: new L.Point(40, 40),
                        html: '<div style="background: white;width: 40px;height: 40px;border-radius: 100%;padding-left: 8px;font-size: 26px;"><i class="fa fa-flask"></i></div>'
                    });
                    leafletMarker.setIcon(myIcon);
                    DATA.Refs.Markers[data.id] = leafletMarker;
                }
                DATA[config.mapId].Map.setView(config.defaultCenter, config.defaultZoom - 1);
            }
        });
    }
    function convertDataToHokihdoanhGeojson(list) {
        var geojson = [];
        list.map(function (item) {
            geojson.push({
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: [item.geo_y, item.geo_x]
                },
                properties: {
                    id: item.id,
                    id_nn: item.id_nn
                }
            });
        });
        return geojson;
    }

    function initListPhongthinghiem() {
        loadAjaxToDivListPhongthinghiem(DATA.HomeUrl + 'user/bando/list-phongthinghiem');
        initSearchPhongthinghiem();
    }


    function initPagAjaxDivListPhongthinghiem() {
        $('.pagination li a').on('click', function (e) {
            e.preventDefault();
            var _this = $(this);
            var url = _this.attr('href');
            loadAjaxToDivListPhongthinghiem(url);
            return false;
        });
    }

    function initPhongthinghiemClickEvent() {
        $('.phongthinghiem-item').on('click', function () {
            var _this = $(this);
            var x = _this.attr('data-point-x');
            var y = _this.attr('data-point-y');
            if (typeof (x) != 'undefined')
                mapZoomAndPanTo(y, x);
        });
    }

    function initDrawControl(config) {
        DATA.MapLayer.drawlayer = new L.FeatureGroup();
        DATA[config.mapId].Map.addLayer(DATA.MapLayer.drawlayer);
        DATA[config.mapId].MapControl.drawcontrol = new L.Control.Draw({
            draw: {
                polygon: false,
                marker: false,
                polyline: false,
                rectangle: false
            },
            edit: {
                featureGroup: DATA.MapLayer.drawlayer
            }
        });
        DATA[config.mapId].MapControl.drawcontrol.addTo(DATA[config.mapId].Map);
        DATA[config.mapId].Map.on('draw:created', function (e) {
            DATA.MapLayer.drawlayer.clearLayers();
            DATA.MapLayer.drawlayer.addLayer(e.layer);
            callPhongthinghiemInCircle(e.layer._latlng.lat, e.layer._latlng.lng, e.layer._mRadius);
        });
    }

    function callPhongthinghiemInCircle(lat, lng, radius) {
        $.ajax({
            url: DATA.HomeUrl + 'user/bando/phongthinghiem-incircle?lat={0}&lng={1}&radius={2}'.replace('{0}', lat).replace('{1}', lng).replace('{2}', radius),
            success: function (html) {
                $('#list_extend').empty().append(html);
            }
        })
    }

    function initSearchPhongthinghiem() {
        $('#search-box').on('keypress', function (e) {
            if (e.keyCode == 13) {
                var q = $(this).val();
                loadAjaxToDivListPhongthinghiem(DATA.HomeUrl + 'user/bando/list-phongthinghiem?q=' + q);
            }
        })
    }

    function loadAjaxToDivListPhongthinghiem(url) {
        var div = $('#list_phongthinghiem');
        $.ajax({
            url: url,
            success: function (html) {
                div.empty().append(html);
                initPagAjaxDivListPhongthinghiem();
                initPhongthinghiemClickEvent();
            }
        });
    }

    function PhongthinghiemView(id_ptn) {
        var url_cg = "<?= Yii::$app->homeUrl ?>user/phongthinghiem/viewptn?id=" + id_ptn;
        $.get(url_cg, function (res) {
            $('#ajaxModalContent').empty().html(res);
            //  $('#myModalLabel').empty().html(name);
        })
    }

    function initFocusCircleLayer(config) {
        DATA.MapLayer.focuscirclelayer = L.circleMarker([0, 0], {radius: 20});
        DATA[DATA.MapConfig.mapId].Map.addLayer(DATA.MapLayer.focuscirclelayer);
    }

    function initMapZoomEvent(config) {

        DATA[DATA.MapConfig.mapId].Map.on('zoomstart', function (e) {
            DATA.MapLayer.focuscirclelayer.zoomstart = DATA[DATA.MapConfig.mapId].Map.getZoom();
        });
        DATA[DATA.MapConfig.mapId].Map.on('zoomend', function (e) {
            DATA.MapLayer.focuscirclelayer.zoomend = DATA[DATA.MapConfig.mapId].Map.getZoom();
            var diff = DATA.MapLayer.focuscirclelayer.zoomend - DATA.MapLayer.focuscirclelayer.zoomstart;
            if (diff > 0) {
                DATA.MapLayer.focuscirclelayer.setRadius(30);
            }
            if (diff < 0) {
                DATA.MapLayer.focuscirclelayer.setRadius(30);
            }
            if (DATA.MapLayer.focuscirclelayer.zoomend < 20) {
                DATA.MapLayer.focuscirclelayer.setRadius(0);
            }
            DATA.Refs.LeafletLayers[defined.layer_phongthinghiem].Cluster.Size = (DATA[DATA.MapConfig.mapId].Map.getZoom() >= 26) ? -1 : 100;
            DATA.Refs.LeafletLayers[defined.layer_phongthinghiem].ProcessView(); // looks like it works OK without this line
        });
    }

    function mapZoomAndPanTo(x, y) {
        DATA[DATA.MapConfig.mapId].Map.setView([x, y], 18);
        DATA.MapLayer.focuscirclelayer.setLatLng([x, y]);
    }
</script>
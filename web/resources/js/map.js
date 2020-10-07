var map;
var diems = 0;
// Cấu hình dùng cho khởi tạo WMS layer.
var interval_created = false;
var features_time_counter = 0;
var VERSION = "1.1.0";
var layerOpenStreetMap;
//var googleRoad;
var layerHCMMap;
var layerChuyengia, layerPTN;
var BASE_URL = 'http://tlkhcn.hcmgis.vn'
var maplayers = [];
//console.log(diems);

// proj4.defs("urn:ogc:def:crs:EPSG::32648", "+proj=utm +zone=48 +ellps=WGS84
// +datum=WGS84 +units=m +no_defs");

var CRS = L.CRS.EPSG4326;
/**
 * Tọa độ trung tâm của bản đồ khi load lần đầu tiên
 */
//lat: 10.916204452514648
//lng: 106.7636775970459
var CENTER = L.latLng(10.7828475, 106.6980600);

/**
 * Mức zoom khi lần đầu tiên load bản đồ
 */
var ZOOM = 13;


// call init function 
//$(document).ready(function () {
//    initializeMap();
//});



/**
 * Hàm dùng để add 1 WMS layer mới, lu
 * 
 * @map biến lưu giữ bản đồ
 * @param layername
 *            Tên lớp, bao gồm workspace:layername
 */
function getCurrentBoundStr() {
    var boundStr = '';
    var mapBound = map.getBounds();
    var leftbottom = mapBound._southWest;
    var righttop = mapBound._northEast;
    boundStr += righttop.lng + ' ' + righttop.lat + ',';
    boundStr += leftbottom.lng + ' ' + righttop.lat + ',';
    boundStr += leftbottom.lng + ' ' + leftbottom.lat + ',';
    boundStr += righttop.lng + ' ' + leftbottom.lat + ',';
    boundStr += righttop.lng + ' ' + righttop.lat;
    return boundStr;
}

function panTo(lat, lng, zoom) {
    zoom = typeof (zoom) == 'undefined' ? 17 : zoom;
    map.panTo(L.latLng(lat, lng), {
        animation: true
    });
    map.setZoom(zoom);
    map.fireEvent('click', {latlng: [lat, lng]});
}

function panToNotFire(lat, lng, zoom) {
    zoom = typeof (zoom) == 'undefined' ? 17 : zoom;
    map.panTo(L.latLng(lat, lng), {
        animation: true
    });
    map.setZoom(zoom);
}

function panToLatlng(latlng) {
    map.panTo(latlng, {
        animation: true
    });
    map.setZoom(17);
    map.fireEvent('click', {latlng: [latlng.lat, latlng.lng]});
}

/**
 * @description split POINT(x y) to get x y
 * @param {type} input
 * @returns {undefined}
 */
var marker_group_onpan = null;

function getLatLng(input) {
    try {
        // split ( to get "x y)"
        var splitedString = input.split("(");
        // split ) to get x y
        splitedString = splitedString[1].split(")");
        // split to get x y
        splitedString = splitedString[0].split(" ");
        var lat = splitedString[1];
        var lng = splitedString[0];

        return [lat, lng];
    } catch (ex) {
        return [];
    }
}

function getStringFromLatLngs(latlngs) {
    var resStr = '';
    for (var i = 0; i < latlngs.length; i++) {
        resStr += ' ' + latlngs[i].lng + ' ' + latlngs[i].lat;
        //if (i < latlngs.length - 1) {
        resStr += ',';
        //}
    }

    resStr += latlngs[0].lng + ' ' + latlngs[0].lat;

    return resStr;
}

var marker_group_onpan = null;
function panToByGeometry(input, remove_group) {
//    try {
    // split ( to get "x y)"
    var splitedString = input.split("(");
    // split ) to get x y
    splitedString = splitedString[1].split(")");
    // split to get x y
    splitedString = splitedString[0].split(" ");

    var lat = splitedString[1];
    var lng = splitedString[0];
    var latlng = convertUTMToLatLng(lat, lng);

    panToLatlng(latlng);

    if (marker_group_onpan === null) {
        marker_group_onpan = L.featureGroup().addTo(map);
    }
    remove_group = typeof (remove_group) === 'undefined' ? false : remove_group;
    if (remove_group) {
        marker_group_onpan.clearLayers();
    }
    marker_group_onpan.addLayer(L.marker(L.latLng(latlng)));
}


function initializeMap(id) {

    map = new L.Map(id, {minZoom: 9, maxZoom: 17, zoomControl: false});
    //var mc = new MarkerClusterer(map);
    //add zoom control with your options
    L.control.zoom({
        position: 'topright'
    }).addTo(map);
    map.setView(CENTER, ZOOM);
    // Init map layer
    initMapLayer();
    //
    map.setMaxBounds([[11.945288193567402, 110.511474609375], [9.652200164514822, 104.15863037109375]]);
//        map.on('click', function(e){
//            console.log(e.latlng)
//        })
}

function initMapLayer() {
    var i = 0;
    var j = 9;
    var p = 1;
    var rightwap = '';

    layerOpenStreetMap = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 22,
        maxNativeZoom: 22,
        attribution: '© OpenStreetMap contributors'
    });
    var owsrootUrl = 'http://tlkhcn.hcmgis.vn/geonhk/ows';
    var cql_filter = getParameterByName('key');
    if (cql_filter == null) {
        cql_filter = '1=1';
    }
    var defaultParameters = {
        service: 'WFS',
        version: '1.0.0',
        request: 'GetFeature',
        typeNames: 'dbtl_khcn:chuyen_gia',
        outputFormat: 'application/json',
        CQL_FILTER: cql_filter,
    };
    var parameters = L.Util.extend(defaultParameters);
    var URL = owsrootUrl + L.Util.getParamString(parameters);
    var markers = L.markerClusterGroup({
        showCoverageOnHover: false
    });
    var ajax = $.ajax({
        url: URL,
        dataType: 'json',
        jsonpCallback: 'getJson',
        success: function (response) {
            layerChuyengia = L.geoJson(response, {
                onEachFeature: function (feature, layer) {
                    var _icon = L.divIcon({
                        html: '<img src="' + BASE_URL + '/resources/img/layout/people.png">',
                        iconSize: [40, 48],
                        iconAnchor: [20, 48],
                        popupAnchor: [0, -48]
                    });
                    var title = feature.properties.ho_ten;
                    var marker = L.marker(new L.LatLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), {
                        title: title,
                        icon: _icon
                    });
                    var popupString =
                        '<div><b>' + '<a class="custom-element-load-ajax-div" data-target-div="#ajaxCGBody" onclick="ChuyengiaView(' + feature.properties.id_cg + ')"  data-toggle="modal" data-target="#ajaxModal">' + feature.properties.ho_ten +
                            '</b></a>' +
                            '</br> Địa chỉ: ' + feature.properties.dia_chi +
                            '</br> Chuyên môn: ' + feature.properties.chuyen_mon +
                            '</div>'
                    marker.bindPopup(popupString);
                    markers.addLayer(marker);
                    diems++;
                    //TimKiem
                    rightwap += '<li class="media"> <div onclick="selectGeoname(' + feature.properties.id_cg + ',' + feature.properties.geo_x + ',' + feature.properties.geo_y + ')" >';
                    rightwap += '<div class="media-body" ><h4 class="media-heading"><i class="fa fa-user"></i> ' + feature.properties.ho_ten + '</h4>';
                    rightwap += '<div class="media-heading-sub"><i class="fa fa-star"></i> ' + feature.properties.chuyen_mon + '</div>';
                    //  rightwap += '<div class="cont-col2> '+feature.properties.chuyen_mon+'</div>';
                    //rightwap += '<small class="text-muted mr-1"><i class="fa fa-user"></i> '+feature.properties.dai_dien+'</small><br>';
                    rightwap += '<div class="media-heading-sub"><i class="fa fa-map-marker"></i> ' + feature.properties.dia_chi + '</div>';
                    rightwap += '</div></li>';
                }
            });
            map.addLayer(markers);
            $("#quick_sidebar_tab_1").empty().append(rightwap);
            $('body').addClass('page-quick-sidebar-open');
            $("#count").text(diems);
        }
    });
    var defaultParameters = {
        service: 'WFS',
        version: '1.0.0',
        request: 'GetFeature',
        typeNames: 'dbtl_khcn:phong_thi_nghiem',
        outputFormat: 'application/json',
        CQL_FILTER: cql_filter,
    };
    var parameters = L.Util.extend(defaultParameters);
    var URL = owsrootUrl + L.Util.getParamString(parameters);
    var markerPTN = L.markerClusterGroup({
        showCoverageOnHover: false
    });
    var ajax = $.ajax({
        url: URL,
        dataType: 'json',
        jsonpCallback: 'getJson',
        success: function (response) {
            layerPTN = L.geoJson(response, {
                onEachFeature: function (feature, layer) {
                    var _icon = L.divIcon({
                        html: '<img src="' + BASE_URL + '/resources/img/flask.png">',
                        iconSize: [40, 48],
                        iconAnchor: [20, 48],
                        popupAnchor: [0, -48]
                    });
                    var title = feature.properties.ho_ten;
                    var marker = L.marker(new L.LatLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), {
                        title: title,
                        icon: _icon
                    });
                    var popupString =
                            '<div><b>' + '<a class="custom-element-load-ajax-div" data-target-div="#ajaxPTNBody" onclick="PhongthinghiemView(' + feature.properties.id_ptn + ')"  data-toggle="modal" data-target="#ajaxModal">' + feature.properties.ten_tv +
                            '</b></a>' +
                            '</br> Địa chỉ: ' + feature.properties.dia_chi +
                            '</br> Người phụ trách: ' + feature.properties.dai_dien +
                            '</div>'
                    marker.bindPopup(popupString);
                    markerPTN.addLayer(marker);
                    diems++;
                    //TimKiem
                    rightwap += '<li class="media"> <div class="" onclick="selectGeoname(' + feature.properties.id_ptn + ',' + feature.properties.geo_x + ',' + feature.properties.geo_y + ')" >';
                    rightwap += '<div class="media-body" ><i class="fa fa-home"></i> ' + feature.properties.ten_tv;
                    rightwap += '<div class="media-heading-sub"><i class="fa fa-user"></i> ' + feature.properties.dai_dien + '</div>';
                    //  rightwap += '<div class="cont-col2> '+feature.properties.chuyen_mon+'</div>';
                    //rightwap += '<small class="text-muted mr-1"><i class="fa fa-user"></i> '+feature.properties.dai_dien+'</small><br>';
                    rightwap += '<div class="media-heading-sub"><i class="fa fa-map-marker"></i> ' + feature.properties.dia_chi + '</div>';
                    rightwap += '</div></li>';

                }
            });


            map.addLayer(markerPTN);
            $("#quick_sidebar_tab_1").empty().append(rightwap);
            $('body').addClass('page-quick-sidebar-open');
            $("#count").text(diems);
        }
    });

    var layerHCMMap = L.tileLayer.wms('http://maps.hcmgis.vn/geoserver/ows?', {
        layers: 'hcm_map:hcm_map'
    });
    var googlelayer = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
        maxZoom: 24,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    });
    var mapbox = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2thZGFtYmkiLCJhIjoiY2lqdndsZGg3MGNua3U1bTVmcnRqM2xvbiJ9.9I5ggqzhUVrErEQ328syYQ#3/0.00/0.00', {
            maxZoom:18,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            id: 'streets-v9',
          //  accessToken: 'pk.eyJ1Ijoic2thZGFtYmkiLCJhIjoiY2lqdndsZGg3MGNua3U1bTVmcnRqM2xvbiJ9.9I5ggqzhUVrErEQ328syYQ'
        });
    var baseLayers = {
        "HCMGIS": layerHCMMap,
        "OpenStreetMap": layerOpenStreetMap,
        "Ảnh vệ tinh": googlelayer,
        "MapBox": mapbox

    };

    var overLayers = {
        'Chuyên gia': markers,
        'Phòng thí nghiệm': markerPTN,
    };

    map.addLayer(layerOpenStreetMap, true);
    L.control.layers(baseLayers, overLayers).addTo(map);

}

// show marker được chọn
function selectGeoname(id, Lng, Lat) {
    //aside_detail(id);
    panToNotFire(Lat, Lng, 20);
}

function callPopup(content) {
    if (features_time_counter > 0) {
        return;
    }
    if (content != '') {
        //features_time_counter = 1;
        //L.popup().setLatLng(latlng).setContent(content).openOn(map);
        //uiUpdate('.leaflet-popup-content-wrapper');
        document.getElementById("info").innerHTML = content;
        uiUpdate('.leaflet-popup-content-wrapper');
        $("#feature_infos").stop();
        $("#feature_infos").fadeIn("fast");
        uiUpdate('#feature_infos');
    }
}

function convertUTMToLatLng(lat, lng) {
    var UTM48 = "+proj=utm +zone=48 +ellps=WGS84 +datum=WGS84 +units=m +no_defs";
    var LATLNG = "+proj=longlat +ellps=WGS84 +datum=WGS84 +no_defs ";
    var result = proj4(LATLNG, LATLNG, [lng, lat]);
    var latlng = L.latLng(result[1], result[0]);
    //console.log(latlng);
    return latlng;
}


function ajaxclose() {
    $(".ajaxloading").addClass("hidden");
}
;
function ajaxopen() {
    $(".ajaxloading").removeClass("hidden");
}
;

$(document).on({
    ajaxStart: function () {
        $(".ajaxloading").removeClass("hidden");
    },
    ajaxStop: function () {
        $(".ajaxloading").addClass("hidden");
    }
});


function getParameterByName(name, url) {
    if (!url) {
        url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
function createLayers(typeNames, url) {

}

<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/30/2019
 * Time: 10:16 AM
 */

namespace app\modules\quanly\base;

use app\services\DebugService;
use app\vendor_custom\dosamigos\leaflet\src\layers\CustomTileLayer;
use app\vendor_custom\dosamigos\leaflet\src\layers\LayerGroup;

class Constants
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_TEMP = 5;

    const CHUYEN_DEN = 1;
    const CHUYEN_DI = 0;

    const CHU_HO = 1;

    const THUONG_TRU = 1;
    const TAM_TRU = 2;

    const TAT_CA = 0;

    const CHUA_GOI = 1;
    const TAM_HOAN = 2;
    const DA_KHAM_SUC_KHOE = 3;
    const TAI_NGU = 4;
    const XUAT_NGU = 5;

    public function createBaseMaps()
    {
        $hcmgis_layer = new CustomTileLayer([
            'urlTemplate' => 'http://pcd.hcmgis.vn/geoserver/ows?',
            'service' => CustomTileLayer::WMS,
            'layerName' => 'HCMGIS',
            'clientOptions' => [
                'layers' => 'hcm_map:hcm_map'
            ],
        ]);

        $osm_layer = new CustomTileLayer([
            'urlTemplate' => 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            'layerName' => 'OSM',
            'clientOptions' => [
                'attribution' => '© OpenStreetMap contributors',
                'maxZoom' => 22,
            ],
        ]);

        $google_layer = new CustomTileLayer([
            'urlTemplate' => 'http://{s}.google.com/vt/lyrs=r&x={x}&y={y}&z={z}',
            'layerName' => 'GMAP',
            'clientOptions' => [
                'attribution' => '© GoogleMap contributors',
                'maxZoom' => 22,
                'subdomains' => ['mt0', 'mt1', 'mt2', 'mt3']
            ],
        ]);

        return [$hcmgis_layer, $google_layer];
    }

    public function createOverlays(){
        $overlays = [];
        $user = \Yii::$app->user->identity;

        switch ($user->xa_id){
            case 0:
                $ranhthua_longthoi = new CustomTileLayer([
                    'urlTemplate' => 'http://nhknhabe.hcmgis.vn/geo113/nhanhokhau_nhabe/wms?',
                    'service' => CustomTileLayer::WMS,
                    'layerName' => 'Long Thới',
                    'clientOptions' => [
                        'layers' => 'nhanhokhau_nhabe:ranhthua_longthoi',
                        'transparent' => true,
                        'format' => 'image/png8',
                        'maxZoom' => 22,
                    ],
                ]);

                $ranhthua_nhonduc = new CustomTileLayer([
                    'urlTemplate' => 'http://nhknhabe.hcmgis.vn/geo113/nhanhokhau_nhabe/wms?',
                    'service' => CustomTileLayer::WMS,
                    'layerName' => 'Nhơn Đức',
                    'clientOptions' => [
                        'layers' => 'nhanhokhau_nhabe:ranhthua_nhonduc',
                        'transparent' => true,
                        'format' => 'image/png8',
                        'maxZoom' => 22,
                    ],
                ]);

                $ranhthua_phuocloc = new CustomTileLayer([
                    'urlTemplate' => 'http://nhknhabe.hcmgis.vn/geo113/nhanhokhau_nhabe/wms?',
                    'service' => CustomTileLayer::WMS,
                    'layerName' => 'Phước Lộc',
                    'clientOptions' => [
                        'layers' => 'nhanhokhau_nhabe:ranhthua_phuocloc',
                        'transparent' => true,
                        'format' => 'image/png8',
                        'maxZoom' => 22,
                    ],
                ]);

                $layerLongThoi = new LayerGroup();
                $layerLongThoi->addLayer($ranhthua_longthoi);
                $layerNhonDuc = new LayerGroup();
                $layerNhonDuc->addLayer($ranhthua_nhonduc);
                $layerPhuocLoc = new LayerGroup();
                $layerPhuocLoc->addLayer($ranhthua_phuocloc);

                array_push($overlays, $layerLongThoi);
                array_push($overlays, $layerNhonDuc);
                array_push($overlays, $layerPhuocLoc);
                break;
            case 4:
                $ranhthua_nhonduc = new CustomTileLayer([
                    'urlTemplate' => 'http://nhknhabe.hcmgis.vn/geo113/nhanhokhau_nhabe/wms?',
                    'service' => CustomTileLayer::WMS,
                    'layerName' => 'Nhơn Đức',
                    'clientOptions' => [
                        'layers' => 'nhanhokhau_nhabe:ranhthua_nhonduc',
                        'transparent' => true,
                        'format' => 'image/png8',
                        'maxZoom' => 22,
                    ],
                ]);
                $layerNhonDuc = new LayerGroup();
                $layerNhonDuc->addLayer($ranhthua_nhonduc);
                array_push($overlays, $layerNhonDuc);

                break;
        }

        return $overlays;
    }

}
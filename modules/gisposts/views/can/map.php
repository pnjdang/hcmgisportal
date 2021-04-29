<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/2/2021
 * Time: 2:01 PM
 */

use app\widgets\maps\LeafletMap;
use app\widgets\maps\types\LatLng;
use app\widgets\maps\layers\TileLayer;
use app\widgets\maps\controls\Layers;
use app\widgets\maps\controls\Scale;
use app\widgets\maps\layers\Marker;

use app\services\MapService;
use app\widgets\maps\layers\DraggableMarker;
use yii\helpers\Html;
use kartik\form\ActiveForm;

$requestedAction = Yii::$app->requestedAction;
$this->title = $const['actions'][$requestedAction->id]['label'];
$this->params['breadcrumbs'][] = ['label' => $const['actions']['index']['label'] . ' ' . $const['title'], 'url' => [$const['actions']['index']['url']]];
$this->params['breadcrumbs'][] = ['label' => $model['fulldiachi'], 'url' => [$const['actions']['view']['url'],'id' => $model['id']]];
$this->params['breadcrumbs'][] = 'Cập nhật vị trí';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="portlet box blue-steel">
            <div class="portlet-title">
                <div class="caption"><span>Cập nhật vị trí</span></div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-lg-12 form-group">
                        <?php
                        $latlng = ['geo_x' => (($model['geo_x'] == null) ? 106.6411483 : $model['geo_x']), 'geo_y' => (($model['geo_y'] == null) ? 10.7974803 : $model['geo_y'])];
                        $center = new LatLng(['lat' => isset($latlng['geo_y']) ? $latlng['geo_y'] : 10.6554327, 'lng' => isset($latlng['geo_x']) ? $latlng['geo_x'] : 106.7226793]);

                        $hcmgis_layer = new TileLayer([
                            'urlTemplate' => 'https://maps.hcmgis.vn/geoserver/ows',
                            'service' => TileLayer::WMS,
                            'layerName' => 'HCMGIS',
                            'clientOptions' => [
                                'layers' => 'hcm_map:hcm_map_all'
                            ],
                        ]);

                        $leaflet = new LeafletMap([
                            'center' => $center, // set the center
                        ]);

                        $layers_control = new Layers();
                        $layers_control->setBaseLayers(MapService::createBaseMaps());
                        $leaflet->addControl($layers_control);

                        $scale_control = new Scale();
                        $leaflet->addControl($scale_control);
                        $leaflet->addLayer($hcmgis_layer);

                        echo $leaflet->widget([
                            'id' => 'mapCan',
                            'styleOptions' => [
                                'height' => '345px',
                                'width' => '100%',
                                'z-index' => '0'
                            ],
                            'draggableMarker' => new DraggableMarker([
                                'center' => $center,
                                'name' => 'draggableMarker',
                                'inputX' => '#can-geo_x',
                                'inputY' => '#can-geo_y',
                            ]),
                        ]);
                        ?>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-9">
                        <label class="control-label">Tìm kiếm địa chỉ</label>
                        <?= \yii\helpers\Html::textInput('search', null, ['class' => 'form-control searchMap']) ?>
                    </div>
                    <div class="col-lg-3" style="margin-top: 24px">
                        <button type="button" id="searchButton" class="btn btn-info">Tìm kiếm</button>
                    </div>
                </div>

                <?php $form = ActiveForm::begin()?>
                <div class="row">
                    <div class="col-lg-6">
                        <?= Html::label('Kinh độ','can-geo_y',['class' => 'control-label'])?>
                        <?= Html::input('number','geo_y',(($model['geo_y'] == null) ? 10.7974803 : $model['geo_y']),['class' => 'form-control','id' => 'can-geo_y', 'step' => "0.000000000000001"])?>
                    </div>
                    <div class="col-lg-6">
                        <?= Html::label('Vĩ độ','can-geo_x',['class' => 'control-label'])?>
                        <?= Html::input('number','geo_x',(($model['geo_x'] == null) ? 106.6411483 : $model['geo_x']),['class' => 'form-control','id' => 'can-geo_x', 'step' => "0.000000000000001"])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= Html::submitButton('Cập nhật',['class' => 'btn btn-warning pull-left'])?>
                        <?= Html::a('Quay lại','javascript:history.back()',['class' => 'btn btn-default pull-right'])?>
                    </div>
                </div>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>
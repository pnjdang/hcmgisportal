<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 3/31/2021
 * Time: 9:58 AM
 */

use app\widgets\maps\LeafletMap;
use app\widgets\maps\types\LatLng;
use app\widgets\maps\layers\TileLayer;
use app\widgets\maps\controls\Layers;
use app\widgets\maps\controls\Scale;
use app\widgets\maps\layers\Marker;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use app\services\MapService;
use app\modules\DCrud\DCrudAsset;

DCrudAsset::register($this);

$requestedAction = Yii::$app->requestedAction;
$this->title = $const['actions'][$requestedAction->id]['label'];
$this->params['breadcrumbs'][] = ['label' => $const['actions']['index']['label'] . ' ' . $const['title'], 'url' => [$const['actions']['index']['url']]];
$this->params['breadcrumbs'][] = $model['can']->fulldiachi;
?>

    <div class="row">
        <div class="col-lg-6">
            <div class="portlet box blue-steel">
                <div class="portlet-title">
                    <div class="caption"><span>Thông tin chi tiết căn</span></div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">
                                <tr>
                                    <th>Số nhà</th>
                                    <td><?= $model['can']->so_nha ?></td>
                                </tr>
                                <tr>
                                    <th>Tên đường</th>
                                    <td><?= $model['can']->ten_duong ?></td>
                                </tr>
                                <tr>
                                    <th>Tên phường</th>
                                    <td><?= (($model['can']->phuong != null) ? $model['can']->phuong->tenphuong : '') ?></td>
                                </tr>
                                <tr>
                                    <th>Loại nhà</th>
                                    <td><?= ($model['can']->loainha != null) ? $model['can']->loainha->ten_loainha : '' ?></td>
                                </tr>
                                <tr>
                                    <th>Diện tích khuôn viên</th>
                                    <td colspan="3"><?= $model['can']->dien_tich_khuon_vien . ' m<sup>2</sup>' ?></td>
                                </tr>
                                <tr>
                                    <th>Số tờ bản đồ</th>
                                    <td><?= $model['can']->so_to_bd ?></td>
                                </tr>
                                <tr>
                                    <th>Số thửa đất</th>
                                    <td colspan="3"><?= $model['can']->so_thua ?></td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td colspan="5"><?= $model['can']->ghichu_can ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= Html::a('Cập nhật thông tin', Yii::$app->urlManager->createUrl(['quan-ly/can/update', 'id' => $model['can']->id_can]), ['class' => 'btn btn-warning', 'role' => 'modal-remote']) ?>
                            <?php if($model['can']->thongTinHos == null):?>
                                <?= Html::a('Thanh lý căn', Yii::$app->urlManager->createUrl(['quan-ly/can/thanhly', 'id' => $model['can']->id_can]), ['class' => 'btn btn-primary', 'role' => 'modal-remote']) ?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="portlet box blue-steel">
                <div class="portlet-title">
                    <div class="caption"><span>Vị trí</span></div>
                </div>
                <div class="portlet-body">
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <?php
                            $latlng = $model['can']->latlng;
                            $center = new LatLng(['lat' => isset($latlng['geo_y']) ? $latlng['geo_y'] : 10.7974803, 'lng' => isset($latlng['geo_x']) ? $latlng['geo_x'] : 106.6411483]);
                            $marker = new Marker(['latLng' => $center]);

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
//                            'clientOptions' => ['height' => '305px',]
                            ]);

                            $layers_control = new Layers();
                            $layers_control->setBaseLayers(MapService::createBaseMaps());
                            $leaflet->addControl($layers_control);

                            $scale_control = new Scale();
                            $leaflet->addControl($scale_control);
                            $leaflet->addLayer($hcmgis_layer);
                            $leaflet->addLayer($marker);

                            echo $leaflet->widget([
                                'id' => 'map1',

                                'styleOptions' => ['height' => '305px',
                                    'z-index' => '0'],
                            ]);
                            ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= Html::a('Cập nhật vị trí', Yii::$app->urlManager->createUrl(['quan-ly/can/map', 'id' => $model['can']->id_can]), ['class' => 'btn btn-warning']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= GridView::widget([
                'id' => 'crud-datatable',
                'dataProvider' => $model['danhsachho'],
                'pjax' => false,
                'columns' => [
                    [
                        'class' => 'kartik\grid\SerialColumn',
                        'width' => '30px',
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'cap_nha',
                        'label' => 'Cấp nhà',
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'vi_tri',
                        'label' => 'Vị trí',
                        'format' => 'raw'
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'dien_tich_su_dung',
                        'label' => 'Diện tích sử dụng',
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'nguoi_thue',
                        'label' => 'Người thuê hiện tại',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return ($model->hopdonghientai != null) ? $model->hopdonghientai->nguoi_thue : '';
                        }

                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'hopdonghientai_id',
                        'label' => 'Hợp đồng hiện tại',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return ($model->hopdonghientai != null) ? '<a href="' . Yii::$app->urlManager->createUrl(['quan-ly/hopdong/view', 'id' => $model->hopdonghientai_id]) . '">' . $model->hopdonghientai->so_hop_dong . '</a>' : '';
                        }
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'so_luu_kho',
                        'label' => 'Số lưu kho',
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'attribute' => 'ghi_chu',
                        'label' => 'Ghi chú',
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'vAlign' => 'middle',
                        'width' => '200px',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            return Url::to(['ho/' . $action, 'id' => $key]);
                        },
                        'template' => '{view}{update}{file}{delete}',
                        'buttons' => [
                            'file' => function ($url) {
                                return Html::a("<span class='fa fa-file'></span>", $url, ['class' => " btn btn-xs purple", 'title' => 'Tài liệu', 'data-pjax' => 0]);
                            },
                            'view' => function ($url) {
                                return Html::a("<span class='fa fa-eye'></span>", $url, ['class' => " btn btn-xs btn-info", 'title' => 'Chi tiết']);
                            },
                            'map' => function ($url) {
                                return Html::a("<span class='fa fa-map-marker'></span>", $url, ['class' => " btn btn-xs yellow-mint", 'title' => 'Bản đồ', 'data-pjax' => 0]);
                            },
                            'update' => function ($url) {
                                return Html::a("<span class='fa fa-pencil'></span>", $url, ['class' => " btn btn-xs btn-warning", 'title' => 'Cập nhật', 'role' => 'modal-remote']);
                            },
                            'delete' => function ($url) {
                                return Html::a("<span class='fa fa-trash'></span>", $url, ['class' => " btn btn-xs btn-danger", 'title' => 'Xóa', 'role' => 'modal-remote', 'data-pjax' => 0]);
                            }
                        ],
                    ],
                ],
                'toolbar' => [
                    ['content' =>
                        Html::a('Thêm mới vị trí có thể cho thuê', Yii::$app->urlManager->createUrl(['quan-ly/ho/create', 'id' => $model['can']->id_can]),
                            ['title' => 'Thêm mới vị trí có thể cho thuê', 'class' => 'btn btn-success',
                                'role' => 'modal-remote',
                            ])
                    ],
                ],
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'panel' => [
                    'type' => 'primary',
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách vị trí có thể cho thuê',
                    'after' => false,
                ]
            ]) ?>
        </div>
    </div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    'size' => Modal::SIZE_LARGE,
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>
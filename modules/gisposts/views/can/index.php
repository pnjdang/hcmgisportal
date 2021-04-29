<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 3/30/2021
 * Time: 3:31 PM
 */

use app\modules\DCrud\DCrudAsset;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\grid\GridView;
use yii\bootstrap\Modal;

$this->title = (isset($const['title'])) ? $const['title'] : 'Danh sách căn';
$this->params['breadcrumbs'][] = $this->title;
$explodeUrl = explode('?', Yii::$app->request->url);
$paramString = (isset($explodeUrl[1])) ? $explodeUrl[1] : '';
DCrudAsset::register($this);
?>

    <div class="row">
        <div class="col-lg-9">
            <div class="portlet box blue-steel">
                <div class="portlet-title">
                    <div class="caption"><span>Tìm kiếm</span></div>
                </div>
                <div class="portlet-body">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'search_can'
                    ])
                    ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model['search'], 'so_nha')->input('text')->label('Số nhà') ?>
                        </div>
                        <div class="col-lg-6">
                            <?=
                            $form->field($model['search'], 'ten_duong')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map($model['duong'], 'ten_duong', 'ten_duong'),
                                'options' => ['placeholder' => 'Chọn tên đường ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Tên đường')
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?=
                            $form->field($model['search'], 'ma_phuong')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map($model['ranh_phuong'], 'maphuong', 'tenphuong'),
                                'options' => ['placeholder' => 'Chọn phường ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Phường')
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <?=
                            $form->field($model['search'], 'id_loainha')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map($model['dm_loainha'], 'id_loainha', 'ten_loainha'),
                                'options' => ['placeholder' => 'Chọn loại nhà ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Loại nhà')
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="portlet box blue-steel">
                <div class="portlet-title bg-primary">
                    <div class="caption"><span>Kết quả tìm kiếm</span></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-scrollable-borderless table-responsive">
                        <tr>
                            <th>
                                <a href="<?= Yii::$app->urlManager->createUrl('quan-ly/can/index?sonha=&tenduong=&phuong=&loainha=1') ?>">Nhà
                                    phố riêng lẻ</a></th>
                            <td><?= isset($model['total'][1]) ? $model['total'][1] : 0 ?></td>
                        </tr>
                        <tr>
                            <th>
                                <a href="<?= Yii::$app->urlManager->createUrl('quan-ly/can/index?sonha=&tenduong=&phuong=&loainha=3') ?>">Nhà
                                    phố tập thể</a></th>
                            <td><?= isset($model['total'][3]) ? $model['total'][3] : 0 ?></td>
                        </tr>
                        <tr>
                            <th>
                                <a href="<?= Yii::$app->urlManager->createUrl('quan-ly/can/index?sonha=&tenduong=&phuong=&loainha=2') ?>">Chung
                                    cư</a></th>
                            <td><?= isset($model['total'][2]) ? $model['total'][2] : 0 ?></td>
                        </tr>
                        <tr>
                            <th>
                                <a href="<?= Yii::$app->urlManager->createUrl('quan-ly/can/index?sonha=&tenduong=&phuong=&loainha=4') ?>">Nhà
                                    xưởng</a></th>
                            <td><?= isset($model['total'][4]) ? $model['total'][4] : 0 ?></td>
                        </tr>
                        <tr>
                            <th>
                                <a href="<?= Yii::$app->urlManager->createUrl('quan-ly/can/index?sonha=&tenduong=&phuong=&loainha=5') ?>">Cơ
                                    quan</a></th>
                            <td><?= isset($model['total'][5]) ? $model['total'][5] : 0 ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet box blue-steel">
                <div class="portlet-title bg-primary">
                    <div class="caption"><span>Danh sách căn thanh lý</span></div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="">
                            <?=
                            GridView::widget([
                                'id' => 'crud-datatable',
                                'dataProvider' => $model['dataProvider'],
                                'pjax' => true,
                                'columns' => [
                                    [
                                        'class' => 'kartik\grid\SerialColumn',
                                        'width' => '30px',
                                    ],
                                    [
                                        'class' => '\kartik\grid\DataColumn',
                                        'attribute' => 'id_loainha',
                                        'label' => 'Loại nhà',
                                        'value' => function ($model) {
                                            return ($model->loainha != null) ? $model->loainha->ten_loainha : '';
                                        }
                                    ],
                                    [
                                        'class' => '\kartik\grid\DataColumn',
                                        'attribute' => 'so_nha',
                                        'label' => 'Số nhà',
                                        'format' => 'raw'
                                    ],
                                    [
                                        'class' => '\kartik\grid\DataColumn',
                                        'attribute' => 'ten_duong',
                                        'label' => 'Tên đường',
                                    ],
                                    [
                                        'class' => '\kartik\grid\DataColumn',
                                        'attribute' => 'ma_phuong',
                                        'label' => 'Tên phường',
                                        'value' => function ($model) {

                                            return ($model->phuong != null) ? $model->phuong->tenphuong : '';
                                        }
                                    ],
                                    [
                                        'class' => '\kartik\grid\DataColumn',
                                        'attribute' => 'dien_tich_khuon_vien',
                                        'label' => 'Diện tích khuôn viên',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            return ($model->dien_tich_khuon_vien != null) ? $model->dien_tich_khuon_vien . ' m<sup>2</sup>' : '';
                                        }
                                    ],
                                    [
                                        'class' => '\kartik\grid\DataColumn',
//                'attribute' => 'nguoi_thue',
                                        'label' => 'Số hộ thuê',
                                        'value' => function ($model) {
                                            return sizeof($model->thongTinHos);
                                        }
                                    ],
                                    [
                                        'class' => '\kartik\grid\DataColumn',
                                        'attribute' => 'stt_can',
                                        'label' => 'Số lưu kho',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            if ($model->thongTinHos == null) {
                                                return '';
                                            } elseif (sizeof($model->thongTinHos) > 1) {
                                                return 'Nhà chung cư';
                                            } else {
                                                return $model->thongTinHos[0]->so_luu_kho;
                                            }
                                        }
                                    ],
                                    [
                                        'label' => 'Thao tác',
                                        'value' => function ($model) {
                                            $viewButton = Html::a('<span class="fa fa-eye"></span>', Yii::$app->urlManager->createUrl(['quan-ly/can/view', 'id' => $model->id_can]), ['class' => 'btn btn-info btn-xs', 'title' => 'Thông tin chi tiết']);
                                            $fileButton = Html::a('<span class="fa fa-file"></span>', Yii::$app->urlManager->createUrl(['quan-ly/can/file', 'id' => $model->id_can]), ['class' => 'btn btn-primary btn-xs', 'title' => 'Tài liệu']);
                                            $updateButton = Html::a('<span class="fa fa-pencil"></span>', Yii::$app->urlManager->createUrl(['quan-ly/can/update', 'id' => $model->id_can]), ['class' => 'btn btn-warning btn-xs', 'role' => 'modal-remote', 'title' => 'Cập nhật']);
                                            $locationButton = Html::a('<span class="fa fa-map-marker"></span>', Yii::$app->urlManager->createUrl(['quan-ly/can/map', 'id' => $model->id_can]), ['class' => 'btn btn-info btn-xs', 'title' => 'Bản đồ']);
                                            $deleteButton = Html::a('<span class="fa fa-trash"></span>', Yii::$app->urlManager->createUrl(['quan-ly/can/delete', 'id' => $model->id_can]), ['class' => 'btn btn-danger btn-xs', 'role' => 'modal-remote', 'title' => 'Xóa']);
                                            return $viewButton . $updateButton . $fileButton . $locationButton . $deleteButton;
                                        },
                                        'format' => 'raw'
                                    ],
                                ],
                                'toolbar' => [
                                    ['content' =>
                                        Html::a('Thêm mới', Yii::$app->urlManager->createUrl('quan-ly/can/create'), ['class' => 'btn btn-success', 'role' => 'modal-remote']) .
                                        "<a target='_blank' title='Xuất danh sách nhà' data-pjax='0' href='" . Yii::$app->urlManager->createUrl('quan-ly/can/export?' . $paramString) . "' class='btn btn-default'><span class='fa fa-file-excel-o'></span> Xuất file</a>"
                                    ],
                                ],
                                'striped' => true,
                                'condensed' => true,
                                'responsive' => true,
                                'panel' => [
                                    'type' => '',
                                    'heading' => false,
                                    'after' => false,
                                ]
                            ])
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php Modal::begin([
    "id" => "ajaxCrudModal",
    'size' => Modal::SIZE_LARGE,
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>
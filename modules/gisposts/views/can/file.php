<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/6/2021
 * Time: 5:00 PM
 */
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\modules\DCrud\DCrudAsset;

DCrudAsset::register($this);

$requestedAction = Yii::$app->requestedAction;
$this->title = $const['actions'][$requestedAction->id]['label'];
$this->params['breadcrumbs'][] = ['label' => $const['actions']['index']['label'] . ' ' . $const['title'], 'url' => [$const['actions']['index']['url']]];
$this->params['breadcrumbs'][] = $model['can']->fulldiachi;
?>

<div class="row">

    <div class="col-lg-12">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $model['tailieu'],
            'pjax' => true,
            'columns' => [
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'width' => '30px',

                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'ten_tai_lieu',
                    'label' => 'Người thuê',
                    'format' => 'raw',
                    'group'=>true,  // enable grouping
                    'value' => function ($model) {
                        return ($model->ho->hopdong != null) ? $model->ho->hopdong->nguoi_thue : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'label' => 'Vị trí',
                    'format' => 'raw',

                    'value' => function ($model) {
                        return ($model->ho != null) ? $model->ho->vi_tri : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'ten_tai_lieu',
                    'label' => 'Tên',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->ten_tai_lieu != null) ? $model->ten_tai_lieu : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'loai_tai_lieu',
                    'label' => 'Loại',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->loai_tai_lieu != null) ? $model->loai_tai_lieu : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'so_tai_lieu',
                    'label' => 'Số',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->so_tai_lieu != null) ? $model->so_tai_lieu : '';
                    }
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'ngay_tai_lieu',
                    'label' => 'Ngày',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->ngay_tai_lieu != null) ? date('d-m-Y', strtotime($model->ngay_tai_lieu)) : '';
                    }
                ],

                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'noi_dung',
                    'label' => 'Nội dung',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ($model->noi_dung != null) ? $model->noi_dung : '';
                    }
                ],
                [
                    'label' => 'Thao tác',
                    'width' => '80px',
                    'value' => function ($model) {
                        $viewButton = "<a href='" . Yii::$app->homeUrl . $model->duong_dan . "' target='_blank' class='btn btn-info btn-xs' data-pjax='0'><i class='fa fa-eye'></i></a>";
                        $updateButton = "<a class='btn btn-warning btn-xs custom-element-load-ajax-div' data-toggle='modal' data-target='#ajaxModal' data-target-div='#ajaxModalContent' data-url='" . Yii::$app->urlManager->createUrl('ho/update') . '?id=' . $model->id_tailieu . "'><i class='fa fa-pencil'></i></a>";
                        $deleteButton = Html::a('<span class="fa fa-trash"></span>', Yii::$app->urlManager->createUrl(['quan-ly/tailieu/delete','id' => $model->id_tailieu]),['class' => 'btn btn-danger btn-xs', 'role' => 'modal-remote','title' => 'Xóa']);
                        return $viewButton . $deleteButton ;
                    },
                    'format' => 'raw'
                ],
            ],
            'toolbar' => [
                ['content' =>
                    Html::a('Thêm mới', Yii::$app->urlManager->createUrl(['quan-ly/tailieu/create','id' => $model['can']->id_can]),
                        ['title' => 'Thêm mới', 'class' => 'btn btn-success','role' => 'modal-remote'])
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Tài liệu căn '. $model['can']->fulldiachi,
                'after' => false,
            ]
        ]) ?>
    </div>
    <div class="col-lg-12">
        <a class="btn btn-default" href="<?= Yii::$app->request->referrer?>">Quay lại</a>
    </div>
</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    'size' => Modal::SIZE_LARGE,
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

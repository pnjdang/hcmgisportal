<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DschuyengiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Chuyên gia';

$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#notice').delay(5000).fadeOut();
    });
</script>
<?php $deleted = Yii::$app->session->getFlash('deleted') ?>
<?php if (isset($deleted)): ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet box green" id="notice">
                <div class="portlet-title">
                    <div class="caption"><span class="fa fa-check-circle-o"></span> Xóa phòng thí nghiệm thành công!
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $updated = Yii::$app->session->getFlash('updated') ?>
<?php if (isset($updated)): ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet box green" id="notice">
                <div class="portlet-title">
                    <div class="caption"><span class="fa fa-check-circle-o"></span> Cập nhật phòng thí nghiệm thành công!
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $created = Yii::$app->session->getFlash('created') ?>
<?php if (isset($created)): ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet box green" id="notice">
                <div class="portlet-title">
                    <div class="caption"><span class="fa fa-check-circle-o"></span> Tạo mới phòng thí nghiệm thành công!
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?=
                    GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'pjax' => false,
                        'columns' => require(__DIR__ . '/_columns.php'),
                        'toolbar' => [
                            ['content' =>
                                Html::a('Thêm mới',Yii::$app->urlManager->createUrl('admin/phongthinghiem/create'), ['title' => 'Thêm mới phòng thí nghiệm', 'class' => 'btn btn-success']) .
//                                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Reset Grid']) .
                                '{toggleData}' .
                                '{export}'
                            ],
                        ],
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'type' => 'primary',
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách phòng thí nghiệm',
                            'after' => false,
                        ]
                    ])
                    ?>
                   <?php
                    Modal::begin([
                        "id" => "ajaxCrudModal",
                        'size' => Modal::SIZE_LARGE,
                        "footer" => "", // always need it for jquery plugin
                    ])
                    ?>
                    <?php Modal::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="ajaxModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 40%">
        <div class="modal-content" id="ajaxModalContent" style="padding: 0">

        </div>
    </div>
</div>
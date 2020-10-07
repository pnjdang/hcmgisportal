<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 3:07 PM
 */
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\helpers\Html;
?>

    <div class="col-md-12 col-sm-12">
        <div class="portlet-body">
            <div id="ajaxCrudDatatable">
                <?=
                GridView::widget([
                    'id' => 'crud-datatable',
                    'dataProvider' => $dataProvider,
                    'pjax' => true,
                    'columns' => require(__DIR__ . '/_columns.php'),
                    'toolbar' => [],
                    'striped' => true,
                    'condensed' => true,
                    'responsive' => true,
                    'panel' => [
                        'type' => 'primary',
                        'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách phòng thí nghiệm',
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
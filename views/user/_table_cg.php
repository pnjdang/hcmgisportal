<?php

use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DschuyengiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

\johnitvn\ajaxcrud\CrudAsset::register($this);
?>

    <div class="col-md-12 col-sm-12">
        <div class="portlet-body">
            <div id="ajaxCrudDatatable">
                <?=
                \kartik\grid\GridView::widget([
                    'id' => 'crud-datatable',
                    'dataProvider' => $dataProvider,
                    'pjax' => true,
                    'columns' => require(__DIR__ . '/chuyengia/_columns.php'),
                    'toolbar' => [

                    ],
                    'striped' => true,
                    'condensed' => true,
                    'responsive' => true,
                    'panel' => [
                        'type' => 'primary',
                        'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách chuyên gia',
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
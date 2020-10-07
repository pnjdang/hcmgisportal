<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 3:07 PM
 */
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use johnitvn\ajaxcrud\CrudAsset;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

CrudAsset::register($this);
$urlCN = \yii\helpers\Url::to(['danhmuc/chuyengia/linhvucnghiencuucap3/linhvuccap3']);
$urlLV = \yii\helpers\Url::to(['danhmuc/chuyengia/linhvucnghiencuucap1/linhvuccap1']);
$urlDV = \yii\helpers\Url::to(['danhmuc/chuyengia/donvi/donvi']);
//\app\services\DebugService::dumpdie($model['search']);
?>
<div class="page-content-inner" style="padding-top: 20px">

    <div class="row">
        <div class="portlet box">
            <div class="portlet-title bg-primary">
                <div class="caption">
                    <span><i class="fa fa-search"></i> Tìm kiếm</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php $form = ActiveForm::begin() ?>
                <div class="col-lg-6">
                    <?= $form->field($model['search'], 'ho_ten')->input('text')->label('Họ tên') ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model['search'], 'hoc_ham')->dropDownList(ArrayHelper::map($model['hocham'],'id_hh','ten_hh'),['prompt' => 'Chọn học hàm'])->label('Học hàm') ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model['search'], 'hoc_vi')->dropDownList(ArrayHelper::map($model['hocvi'],'id_hv','ten_hv'),['prompt' => 'Chọn học vị'])->label('Học vị') ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model['search'], 'linh_vuc')->widget(Select2::className(),[
                        'initValueText' => ($model['cap1'] != null) ? $model['cap1'] : '',
                        'options' => [
                            'placeholder' => 'Chọn lĩnh vực',
                        ],
                        'pluginOptions' => [
                            'maximumInputLength' => 10,
                            'allowClear' => true,
                            'language' => [
                                'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                            ],
                            'ajax' => [
                                'url' => $urlLV,
                                'dataType' => 'json',
                                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                                //'delay' => 1000,
                            ],
                            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                            'templateSelection' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
                            'templateResult' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
//
                        ],
                    ])->label('Lĩnh vực hoạt động') ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model['search'], 'chuyen_nganh')->widget(Select2::className(),[
                        'initValueText' => ($model['cap3'] != null) ? $model['cap3'] : '',
                        'options' => [
                            'placeholder' => 'Chọn chuyên ngành',
                        ],
                        'pluginOptions' => [
                            'maximumInputLength' => 10,
                            'allowClear' => true,
                            'language' => [
                                'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                            ],
                            'ajax' => [
                                'url' => $urlCN,
                                'dataType' => 'json',
                                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                                //'delay' => 1000,
                            ],
                            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                            'templateSelection' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
                            'templateResult' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
//
                        ],
                    ])->label('Chuyên ngành') ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model['search'], 'ten_congtrinh')->input('text')->label('Tên công trình nghiên cứu') ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model['search'], 'loai_congtrinh')->dropDownList(ArrayHelper::map($model['congtrinh'],'id_loaicongtrinh','ten_loaicongtrinh'),['prompt' => 'Chọn loại công trình nghiên cứu'])->label('Loại công trình nghiên cứu') ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model['search'], 'donvi_id')->widget(Select2::className(),[
                        'initValueText' => ($model['donvi'] != null) ? $model['donvi'] : '',
                        'options' => [
                            'placeholder' => 'Chọn đơn vị',
                        ],
                        'pluginOptions' => [
                            'maximumInputLength' => 10,
                            'allowClear' => true,
                            'language' => [
                                'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                            ],
                            'ajax' => [
                                'url' => $urlDV,
                                'dataType' => 'json',
                                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                                //'delay' => 1000,
                            ],
                            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                            'templateSelection' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
                            'templateResult' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
//
                        ],
                    ])->label('Đơn vị') ?>
                </div>
                <div class="col-lg-12">
                    <button type="submit"class="btn btn-info">Tìm kiếm</button>
                </div>
                <div style="clear: both"></div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="chuyengiaDatatable">
            <?= GridView::widget([
                'id' => 'crud-datatable',
                'dataProvider' => $dataProvider,
                'pjax' => false,
                'columns' => require(__DIR__ . '/_columns.php'),
                'toolbar' => [
                    ['content' =>
                        "<a class='btn btn-success custom-element-load-ajax-div' href='".Yii::$app->urlManager->createUrl('user/chuyengia/create')."' title='Đăng ký chuyên gia'>Đăng ký chuyên gia</a>".
                        ((!Yii::$app->user->isGuest) ? "
                            <form class='pull-right' method='post' action='".Yii::$app->urlManager->createUrl('user/chuyengia/exportexcel')."'>
                                <input type='hidden' name='_csrf' value='".Yii::$app->request->getCsrfToken()."'>
                                <input type='hidden' name='SearchChuyengia[ho_ten]' value='".$model['search']->ho_ten."'>
                                <input type='hidden' name='SearchChuyengia[hoc_ham]' value='".$model['search']->hoc_ham."'>
                                <input type='hidden' name='SearchChuyengia[hoc_vi]' value='".$model['search']->hoc_vi."'>
                                <input type='hidden' name='SearchChuyengia[linh_vuc]' value='".$model['search']->linh_vuc."'>
                                <input type='hidden' name='SearchChuyengia[chuyen_nganh]' value='".$model['search']->chuyen_nganh."'>
                                <input type='hidden' name='SearchChuyengia[ten_congtrinh]' value='".$model['search']->ten_congtrinh."'>
                                <input type='hidden' name='SearchChuyengia[loai_congtrinh]' value='".$model['search']->loai_congtrinh."'>
                                <input type='hidden' name='SearchChuyengia[donvi_id]' value='".$model['search']->donvi_id."'>
                                <button class='btn btn-default' type='submit'  title='Xuất file'>Xuất file</button>
                                </form>
                                ":'{toggleData}{export}')

                    ],
                ],
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'panel' => [
                    'type' => 'primary',
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách chuyên gia',
                    'after' => false,
                ]
            ]) ?>
        </div>

    </div>
</div>


<div class="modal fade" id="chuyengiaModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:900px;">
        <div class="modal-content" id="chuyengiaModalContent">

        </div>
    </div>
</div>



<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 3:07 PM
 */
use johnitvn\ajaxcrud\CrudAsset;
use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$urlTB = \yii\helpers\Url::to(['danhmuc/phongthinghiem/thietbi/thietbi']);
\kartik\select2\Select2Asset::register($this);
CrudAsset::register($this);
?>
<div class="page-content-inner" style="padding-top: 20px">

    <?php $success = Yii::$app->session->getFlash('send_success') ?>
    <?php if (isset($success)): ?>
        <div class="portlet box green-haze" id="notice">
            <div class="portlet-title">
                <div class="caption">
                    <span><i class="fa fa-check-circle"></i> Gửi yêu cầu cập nhật dữ liệu thành công!</span>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#notice').delay(5000).fadeOut();
        });
    </script>
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet box">
                <div class="portlet-title bg-primary">
                    <div class="caption">
                        <span><i class="fa fa-search"></i> Tìm kiếm</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php $form = ActiveForm::begin() ?>
                    <div class="col-lg-6">
                        <?= $form->field($model['search'], 'ten_tv')->input('text')->label('Tên tiếng Việt') ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model['search'], 'ten_ta')->input('text')->label('Tên tiếng Anh') ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model['search'], 'coquan_chuquan')->input('text')->label('Cơ quan chủ quản') ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model['search'], 'dai_dien')->input('text')->label('Người đại diện') ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model['search'], 'lvtn_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map($model['linhvucthunghiem'], 'id_lv', 'ten_lv'),
                            'options' => ['placeholder' => 'Chọn lĩnh thử nghiệm ...',],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'language' => [
                                    'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                                ],
                                'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                                'templateSelection' => new \yii\web\JsExpression('function(chunhiem) { return chunhiem.text; }'),
                                'templateResult' => new \yii\web\JsExpression('function(chunhiem) { return chunhiem.text; }'),
                            ],
                        ])->label('Lĩnh vực thử nghiệm'); ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model['search'], 'pl_id')->widget(Select2::classname(), [
                            'data' => $model['vatlieuthunghiem'],
                            'options' => ['placeholder' => 'Chọn vật liệu thử nghiệm ...',],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'language' => [
                                    'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                                ],
                                'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                                'templateSelection' => new \yii\web\JsExpression('function(chunhiem) { return chunhiem.text; }'),
                                'templateResult' => new \yii\web\JsExpression('function(chunhiem) { return chunhiem.text; }'),
                            ],
                        ])->label('Vật liệu thử nghiệm'); ?>
                    </div>
                    <div class="col-lg-12">
                        <?= $form->field($model['search'], 'thietbi_id')->widget(Select2::className(), [
                            'data' => (isset($model['thietbi']) && $model['thietbi'] != null) ? ArrayHelper::map($model['thietbi'], 'id_tb', 'ten_tb') : null,
                            'options' => ['placeholder' => 'Chọn thiết bị ...',],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 1,
                                'language' => [
                                    'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                                ],
                                'ajax' => [
                                    'url' => $urlTB,
                                    'dataType' => 'json',
                                    'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                                    'delay' => 1000,
                                ],
                                'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                                'templateSelection' => new \yii\web\JsExpression('function(chunhiem) { return chunhiem.text; }'),
                                'templateResult' => new \yii\web\JsExpression('function(chunhiem) { return chunhiem.text; }'),
                            ],
                        ])->label('Thiết bị') ?>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" id="cgsearch_btn" class="btn btn-info">Tìm kiếm</button>
                    </div>
                    <div style="clear: both"></div>

                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="ptn-table">
        <div class="col-md-12 col-sm-12">
            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <?=
                    GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $dataProvider,
                        'pjax' => false,
                        'columns' => require(__DIR__ . '/_columns.php'),
                        'toolbar' => [
                            ['content' =>
                                "<a class='btn btn-success' href='" . Yii::$app->urlManager->createUrl('user/phongthinghiem/create') . "'>Đăng ký phòng thí nghiệm</a>" .

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
                        ]
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="phongthinghiemModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:900px;">
        <div class="modal-content" id="phongthinghiemModalContent">

        </div>
    </div>
</div>
<script type="application/javascript">
    $('#PhongthinghiemSearchUser').keypress(function (event) {
        if (event.keyCode == 13) {
            $('#ptnsearch_btn').click();
        }
    });


    function PhongthinghiemCreate() {
        var url_cg = "<?= Yii::$app->homeUrl?>user/createphongthinghiem";
        var name = "Tạo mới phòng thí nghiệm";
        $.get(url_cg, function (res) {
            $('#ajaxModalBody').html(res);
            $('#myModalLabel').empty().html(name);
        })
    }

    function PhongthinghiemSearch(data) {
        var ptn_tentv = $("#ptn_tentv").val();
        var ptn_tenta = $("#ptn_tenta").val();
        var ptn_cqcq = $("#ptn_cqcq").val();
        var ptn_daidien = $("#ptn_daidien").val();
        if (data == 0) {
            $("#ptn_tentv").val('');
            $("#ptn_tenta").val('');
            $("#ptn_cqcq").val('');
            $("#ptn_daidien").val('');
            ptn_tentv = ptn_tenta = ptn_cqcq = ptn_daidien = '';
        }
        var url = "<?= Yii::$app->homeUrl ?>user/userphongthinghiem?tentv=" + ptn_tentv + "&tenta=" + ptn_tenta + "&cqcq=" + ptn_cqcq + "&daidien=" + ptn_daidien;
        //console.log(url);

        $.get(url, function (res) {
            $('#ptn-table').html(res)
        })
    }
</script>


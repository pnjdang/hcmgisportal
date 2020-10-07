<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/15/2017
 * Time: 9:00 AM
 */
use kartik\form\ActiveForm;
use kartik\select2\Select2;
$urlTB = \yii\helpers\Url::to(['thietbi/thietbi']);

?>

<div class="row">
    <div class="col-lg-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="font-blue-steel uppercase">Tìm kiếm thiết bị thử nghiệm</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php $form = ActiveForm::begin()?>

                <div class="col-lg-12 form-group">
                    <?= $form->field($model['search'], 'id_thietbithunghiem')->widget(Select2::classname(), [
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
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                </div>
                <div style="clear:both;"></div>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>

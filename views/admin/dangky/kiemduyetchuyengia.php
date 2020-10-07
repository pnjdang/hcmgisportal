<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/31/2017
 * Time: 8:52 AM
 */
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-lg-12">
        <div class="portlet box blue-steel">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-check"></i>
                    <span class="">Kiểm duyệt thông tin đăng ký chuyên gia</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php $form = ActiveForm::begin() ?>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['chuyengia'], 'ho_ten')->input('text', ['value' => $model['phieudangky']['ho_ten']])->label('Họ tên') ?>
                </div>
                <div class="col-lg-3 form-group">
                    <?= $form->field($model['chuyengia'], 'nam_sinh')->input('number', ['value' => $model['phieudangky']['nam_sinh']])->label('Giới tính') ?>
                </div>
                <div class="col-lg-3 form-group">
                    <?= $form->field($model['chuyengia'], 'gioi_tinh')->dropDownList([1 => 'Nam', 0 => 'Nữ'], ['prompt' => 'Chọn giới tính', 'options' => [$model['phieudangky']['gioi_tinh'] => ['Selected' => true]]])->label('Giới tính') ?>
                </div>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['chuyengia'], 'id_lvql')->dropDownList(ArrayHelper::map($model['linhvucquanly'], 'id_lvql', 'ten_lvql'), ['options' => [$model['phieudangky']['lvql_id'] => ['Selected' => true]]])->label('Lĩnh vực') ?>
                </div>
                <div class="col-lg-3 form-group">
                    <?= $form->field($model['chuyengia'], 'id_hh')->dropDownList(ArrayHelper::map($model['hocham'], 'id_hh', 'ten_hh'), ['prompt' => 'Chọn học hàm', 'options' => [$model['phieudangky']['hh_id'] => ['Selected' => true]]])->label('Học hàm') ?>
                </div>
                <div class="col-lg-3 form-group">
                    <?= $form->field($model['chuyengia'], 'id_hv')->dropDownList(ArrayHelper::map($model['hocvi'], 'id_hv', 'ten_hv'), ['prompt' => 'Chọn học vị', 'options' => [$model['phieudangky']['hv_id'] => ['Selected' => true]]])->label('Học vị') ?>
                </div>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['chuyengia'], 'chuyen_mon')->input('text', ['value' => $model['phieudangky']['chuyen_mon']])->label('Chuyên ngành') ?>
                </div>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['chuyengia'], 'chuc_vu')->input('text', ['value' => $model['phieudangky']['chuc_vu']])->label('Chức vụ') ?>
                </div>
                <div class="col-lg-12 form-group">
                    <?= $form->field($model['chuyengia'], 'dinh_huong')->textarea(['value' => $model['phieudangky']['dinh_huong']])->label('Định hướng nghiên cứu') ?>
                </div>
                <div class="col-lg-12 form-group">
                    <?= $form->field($model['chuyengia'], 'congtrinh_nghiencuu')->textarea(['value' => $model['phieudangky']['congtrinh_nghiencuu']])->label('Công trình nghiên cứu') ?>
                </div>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['chuyengia'], 'donvi_id')->widget(Select2::className(),[
                        'pluginOptions' => [
                            'allowClear' => true,
                            'language' => [
                                'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                            ],
                            'ajax' => [
                                'url' => Url::to(['donvi/donvi']),
                                'dataType' => 'json',
                                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                                'delay' => 1000,
                            ],
                            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                            'templateSelection' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
                            'templateResult' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
//
                        ],
                    ])->label('Đơn vị công tác') ?>
                </div>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['chuyengia'], 'id_dvct')->widget(Select2::className(),[
                        'pluginOptions' => [
                            'allowClear' => true,
                            'language' => [
                                'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                            ],
                            'ajax' => [
                                'url' => Url::to(['donvicongtac/loaihinhdonvi']),
                                'dataType' => 'json',
                                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                                'delay' => 1000,
                            ],
                            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                            'templateSelection' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
                            'templateResult' => new \yii\web\JsExpression('function(donvi) { return donvi.text; }'),
//
                        ],
                    ])->label('Loại hình tổ chức') ?>
                </div>
                <div class="col-lg-6 form-group">
                    <label class="control-label">Đơn vị công tác</label>
                    <?= Html::input('text','donvi',$model['phieudangky']['donvi_congtac'],['class' => 'form-control','disabled' => true]) ?>
                </div>

                <div class="col-lg-12 form-group">
                    <?= $form->field($model['chuyengia'], 'dia_chi')->input('text')->label('Địa chỉ') ?>
                </div>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['chuyengia'], 'dien_thoai')->input('text')->label('Điện thoại') ?>
                </div>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['chuyengia'], 'email')->input('email')->label('Email') ?>
                </div>

                <div class="col-lg-6 form-group">
                    <?= $form->field($model['phieudangky'],'ket_qua')->dropDownList([1 => 'Duyệt',2=>'Không duyệt'])->label('Kết quả')?>
                </div>
                <div class="col-lg-6 form-group">
                    <?= $form->field($model['phieudangky'],'ghi_chu')->textarea()->label('Ghi chú')?>
                </div>
                <div class="col-lg-12 form-group">
                    <button class="btn btn-success pull-left" type="submit">Duyệt</button>
                    <a class="btn btn-default pull-right" href="<?= Yii::$app->urlManager->createUrl('dangky/danhsachchuyengia')?>">Quay lại</a>
                </div>
                <div style="clear: both"></div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>

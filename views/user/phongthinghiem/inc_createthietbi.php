<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/7/2017
 * Time: 4:30 PM
 */
use kartik\form\ActiveForm;
use kartik\select2\Select2;
$urlTB = \yii\helpers\Url::to(['thietbi/thietbi']);
\kartik\select2\Select2Asset::register($this);
\kartik\form\ActiveFormAsset::register($this);
//\yii\widgets\ActiveFormAsset::register($this);
?>
<?php $form = ActiveForm::begin([
    'id' => 'usercreate-thietbi',
    'enableClientValidation' => true, 'enableAjaxValidation' => false,
])?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Thêm mới thiết bị thử nghiệm') ?></h4>
</div>
<div class="modal-body">
    <?= $form->field($model['thietbi'], 'thietbi_id')->widget(Select2::classname(), [
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
    ])->label('Thiết bị'); ?>
    <?= $form->field($model['thietbi'],'so_hieu')->input('text')->label('Số hiệu')?>
    <?= $form->field($model['thietbi'],'nam_sx')->input('text')->label('Năm sản xuất')?>
    <?= $form->field($model['thietbi'],'hang_sx')->input('text')->label('Hãng sản xuất')?>
    <?= $form->field($model['thietbi'],'nuoc_sx')->input('text')->label('Nước sản xuất')?>
    <?= $form->field($model['thietbi'],'so_luong')->input('text')->label('Số lượng')?>
    <?= $form->field($model['thietbi'],'tinh_trang')->input('text')->label('Tình trạng')?>
    <?= $form->field($model['thietbi'],'dactinh_kythuat')->textarea()->label('Đặc tính kỹ thuật')?>
    <?= $form->field($model['thietbi'],'ghi_chu')->textarea()->label('Ghi chú')?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
    <button type="submit" class="btn btn-success pull-left">Thêm mới</button>
</div>

<?php ActiveForm::end()?>



<script>
    $('#usercreate-thietbi').on('beforeSubmit', function(e) {
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: '<?=Yii::$app->urlManager->createUrl('user/usercreatethietbi?id=').$_GET['id']?>',
            type: 'POST',
            data: formData,
            success: function (data) {
                reloadTable('#tab_userthietbi','<?= Yii::$app->urlManager->createUrl('user/userlistthietbi?id=').$model['id_pdk']?>');
                $('#ajaxModalThietbi1').remove();
                $('.modal-backdrop').remove();
            },
            error: function () {
                alert("Xin lỗi, đã xảy ra lỗi trong quá trình thực hiện, vui lòng kiểm tra lại");
            }
        });
    }).on('submit', function(e){
        e.preventDefault();
        return false;
    });
</script>
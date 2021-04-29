<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 5/25/2017
 * Time: 9:18 AM
 */

use kartik\form\ActiveForm;

?>
<?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
    ]
]) ?>
<?= \yii\helpers\Html::csrfMetaTags() ?>
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model['file'], 'a')->fileInput(['accept' => 'pdf/*'])->label('Tài liệu') ?>
    </div>
    <div class="col-sm-6">
        <label class='control-label'>Mã</label>
        <select name="ma" class="form-control" id="ma">
            <option>Chọn mã</option>
            <option value="1">1 - Quyết định xác lập sở hữu nhà nước</option>
            <option value="2">2 - Quyết định cấp nhà</option>
            <option value="3">3 - Quyết định hợp thức hóa quyền thuê nhà</option>
            <option value="4">4 - Hợp đồng thuê nhà cuối cùng</option>
            <option value="5">5 - Các giấy chuyển nhượng nhà</option>
            <option value="6">6 - Các văn bản khác</option>
            <option value="7">7 - Bản vẽ</option>
            <option value="78">8 - Khác</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model['tailieu'], 'ten_tai_lieu')->input('text', ['id' => 'ten_tai_lieu'])->label('Tên tài liệu') ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model['tailieu'], 'so_tai_lieu')->input('text')->label('Số tài liệu') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model['tailieu'], 'ngay_tai_lieu')->input('date')->label('Ngày tài liệu') ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model['tailieu'], 'noi_dung')->textarea()->label('Nội dung') ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<script>
    var select = document.getElementById('ma');
    var input = document.getElementById('ten_tai_lieu');
    var value = "";

    select.onchange = function () {
        switch (select.value) {
            case "1":
                value = "Quyết định xác lập sở hữu nhà nước";
                break;

            case "2":
                value = "Quyết định cấp nhà";
                break;
            case "3":
                value = "Quyết định hợp thức hóa quyền thuê nhà";
                break;
            case "4":
                value = "Hợp đồng thuê nhà cuối cùng";
                break;
            case "5":
                value = "Các giấy chuyển nhượng nhà";
                break;
            case "6":
                value = "Các văn bản khác";
                break;
            case "7":
                value = "Bản vẽ";
                break;
            case "8":
                value = "Khác";
                break;
        }
        input.value = value;
    }
</script>
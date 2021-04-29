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
<div class="row">
    <div class="col-lg-12">
        <h4>Bạn chắc chắn muốn xóa tài liệu này?</h4>
    </div>
</div>
<?php ActiveForm::end()?>

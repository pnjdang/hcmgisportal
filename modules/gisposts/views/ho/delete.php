<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/6/2021
 * Time: 10:12 AM
 */
use kartik\form\ActiveForm;
?>

<?php $form = ActiveForm::begin()?>
<div class="row">
    <div class="col-lg-12">
        <h4>Bạn chắc chắn muốn xóa hộ <?= $model->vi_tri . ' ' . $model->cap_nha . ', ' . $model->thongtincan->fulldiachi?>?</h4>
    </div>
</div>
<?php ActiveForm::end()?>
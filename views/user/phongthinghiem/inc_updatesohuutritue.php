<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/7/2017
 * Time: 4:30 PM
 */
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php $form = ActiveForm::begin([
    'id' => 'userupdate-sohuutritue',
    'enableClientValidation' => true,
    'enableAjaxValidation' => false,
])?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Cập nhật sở hữu trí tuệ') ?></h4>
</div>
<div class="modal-body">
    <?php
    foreach ($model['ketquashtt'] as $i => $ketquashtt) {
        echo $form->field($model['sohuutritue'][$ketquashtt->id_ketquashtt], "[$ketquashtt->id_ketquashtt]so_luong")->input('number')->label('Số lượng '.$ketquashtt->ten_ketquashtt);
    }
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
    <button type="submit" class="btn btn-warning pull-left">Cập nhật</button>
</div>

<?php ActiveForm::end()?>

<script>
    $('#userupdate-sohuutritue').on('beforeSubmit', function(e) {
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: '<?=Yii::$app->urlManager->createUrl('user/userupdatesohuutritue').'?id='.$model['id_pdk'].'&nam='.$model['nam']?>',
            type: 'POST',
            data: formData,
            success: function (data) {
                reloadTable('#tab_usersohuutritue','<?= Yii::$app->urlManager->createUrl('user/userlistsohuutritue?id=').$model['id_pdk']?>');
                $('#ajaxModalShtt').remove();
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

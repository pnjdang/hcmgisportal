<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 9/7/2017
 * Time: 4:30 PM
 */
use kartik\form\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'id' => 'userdelete-sohuutritue',
    'enableClientValidation' => true, 'enableAjaxValidation' => false,
])?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Xóa sở hữu trí tuệ') ?></h4>
</div>
<div class="modal-body">
    <h4>Bạn có chắc chắn muốn xóa?</h4>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
    <button type="submit" class="btn btn-danger pull-left">Xóa</button>
</div>

<?php ActiveForm::end()?>



<script>
    $('#userdelete-sohuutritue').on('beforeSubmit', function(e) {
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: '<?=Yii::$app->urlManager->createUrl('user/userdeletesohuutritue').'?id='.$model['id_pdk'].'&nam='.$model['nam']?>',
            type: 'POST',
            data: formData,
            success: function (data) {
                reloadTable('#tab_usersohuutritue','<?= Yii::$app->urlManager->createUrl('user/userlistsohuutritue?id=').$model['id_pdk']?>');
                $('#ajaxModalShtt1').remove();
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
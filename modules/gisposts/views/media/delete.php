<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 5/5/2021
 * Time: 4:06 PM
 */
use yii\helpers\Html;
use kartik\form\ActiveForm;
?>
<?php $form = ActiveForm::begin()?>

<?= Html::img(Yii::$app->homeUrl.$model->file_path,['width' => '100%'])?>
<?php ActiveForm::end()?>
<?php

/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 11/28/2016
 * Time: 8:43 PM
 */
use kartik\form\ActiveForm;
use yii\widgets\MaskedInput;
?>
<div class="ho-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
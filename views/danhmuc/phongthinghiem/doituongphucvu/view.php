<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DoituongPhucvu */
?>
<div class="doituong-phucvu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ten_dtpv',
            'ghi_chu',
        ],
    ]) ?>

</div>

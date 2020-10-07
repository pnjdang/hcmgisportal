<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ThietBi */
?>
<div class="thiet-bi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ten_tb',
            'hang_sx',
            'dac_tinh',
            'ghi_chu',
        ],
    ]) ?>

</div>

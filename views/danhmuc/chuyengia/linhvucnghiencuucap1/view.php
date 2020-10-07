<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LinhvucnghiencuuCap1 */
?>
<div class="linhvucnghiencuu-cap1-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ten_cap1',
            'ma_cap1',
            'ghichu_cap1',
        ],
    ]) ?>

</div>

<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HocHam */
?>
<div class="hoc-ham-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Tên học hàm',
                'value' => ($model->ten_hh == null) ? '' : $model->ten_hh,
            ],
            [
                'label' => 'Ghi chú',
                'value' => ($model->ghi_chu == null) ? '' : $model->ghi_chu,
            ],
        ],
    ]) ?>

</div>

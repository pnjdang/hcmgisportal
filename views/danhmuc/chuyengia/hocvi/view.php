<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HocVi */
?>
<div class="hoc-vi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ten_hv',
            [                      // the owner name of the model
                'label' => 'Tên học vị',
                'value' => ($model->ten_hv == null) ? '' : $model->ten_hv,
            ],
            [                      // the owner name of the model
                'label' => 'Ghi chú',
                'value' => ($model->ghi_chu == null) ? '' : $model->ghi_chu,
            ],
        ],
    ]) ?>

</div>

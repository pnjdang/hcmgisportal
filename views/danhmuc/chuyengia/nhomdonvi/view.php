<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nhomdonvi */
?>
<div class="nhomdonvi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [                      // the owner name of the model
                'label' => 'Tên nhóm đơn vị',
                'value' => ($model->ten_nhomdonvi == null) ? '' : $model->ten_nhomdonvi,
            ],
            [                      // the owner name of the model
                'label' => 'Ghi chú',
                'value' => ($model->ghi_chu == null) ? '' : $model->ghi_chu,
            ],
        ],
    ]) ?>

</div>

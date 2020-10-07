<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TochucHoptac */
?>
<div class="tochuc-hoptac-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [                      // the owner name of the model
                'label' => 'Tên tổ chức',
                'value' => ($model->ten_tc == null) ? '' : $model->ten_tc,
            ],
            [                      // the owner name of the model
                'label' => 'Ghi chú',
                'value' => ($model->ghi_chu == null) ? '' : $model->ghi_chu,
            ],
        ],
    ]) ?>

</div>

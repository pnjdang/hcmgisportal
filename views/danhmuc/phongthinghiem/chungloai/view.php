<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ChungLoai */
?>
<div class="chung-loai-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [                      // the owner name of the model
                'label' => 'Chủng loại',
                'value' => ($model->ten_cl == null) ? '' : $model->ten_cl,
            ],
            [                      // the owner name of the model
                'label' => 'Ghi chú',
                'value' => ($model->ghi_chu == null) ? '' : $model->ghi_chu,
            ],
        ],
    ]) ?>

</div>

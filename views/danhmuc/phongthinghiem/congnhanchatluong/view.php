<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CongnhanChatluong */
?>
<div class="congnhan-chatluong-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [                      // the owner name of the model
                'label' => 'Tiêu chuẩn',
                'value' => ($model->tieu_chuan == null) ? '' : $model->tieu_chuan,
            ],
            [                      // the owner name of the model
                'label' => 'Ghi chú',
                'value' => ($model->ghi_chu == null) ? '' : $model->ghi_chu,
            ],
        ],
    ]) ?>

</div>

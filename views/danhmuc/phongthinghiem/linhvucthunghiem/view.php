<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LinhvucThunghiem */
?>
<div class="linhvuc-thunghiem-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [                      // the owner name of the model
                'label' => 'Tên lĩnh vực',
                'value' => ($model->ten_lv == null) ? '' : $model->ten_lv,
            ],
            [                      // the owner name of the model
                'label' => 'Ghi chú',
                'value' => ($model->ghi_chu == null) ? '' : $model->ghi_chu,
            ],
        ],
    ]) ?>

</div>

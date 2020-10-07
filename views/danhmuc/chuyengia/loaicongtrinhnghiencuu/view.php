<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LoaiCongtrinhnghiencuu */
?>
<div class="loai-congtrinhnghiencuu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ten_loaicongtrinh',
            'ghichu_loaicongtrinh',
        ],
    ]) ?>

</div>

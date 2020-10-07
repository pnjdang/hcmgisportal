<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\danhmuc\phongthinghiem\chungloai\PhanLoai */
?>
<div class="phan-loai-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pl',
            'id_cl',
            'ten_pl',
            'ghi_chu',
        ],
    ]) ?>

</div>

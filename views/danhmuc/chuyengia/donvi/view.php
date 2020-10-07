<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Donvi */
?>
<div class="donvi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ten_donvi',
            'dia_chi',
            'nguoidungdau',
            'dien_thoai',
            'fax',
            'website',
        ],
    ]) ?>

</div>

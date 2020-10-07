<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ngoaingu */
?>
<div class="ngoaingu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_ngoaingu',
            'ten_ngoaingu',
            'ghichu_ngoaingu',
        ],
    ]) ?>

</div>

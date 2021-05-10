<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\gisposts\models\LienHe */
?>
<div class="lien-he-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hoten',
            'email:email',
            'dienthoai',
            'chude',
            'noidung:ntext',
            'created_at',
        ],
    ]) ?>

</div>

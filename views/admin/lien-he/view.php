<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LienHe */
?>
<div class="lien-he-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_lienhe',
            'ho_ten',
            'email:email',
            'dien_thoai',
            'noi_dung:ntext',
            'created_at',
            'reply:ntext',
            'replied_at',
            'created_by',
            'replied_by',
            'noi_dung_reply:ntext',
        ],
    ]) ?>

</div>

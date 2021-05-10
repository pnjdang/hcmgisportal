<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\gisposts\models\categories\PostType */
?>
<div class="post-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type_name',
        ],
    ]) ?>

</div>

<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\gisposts\models\media\FileType */
?>
<div class="file-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type_name',
        ],
    ]) ?>

</div>

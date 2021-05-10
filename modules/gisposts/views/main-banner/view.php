<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\gisposts\models\media\MainBanner */
?>
<div class="main-banner-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'file_path',
            'file_name',
            'file_caption',
            'file_description:ntext',
            'uploaded_at',
            'banner_position',
        ],
    ]) ?>

</div>

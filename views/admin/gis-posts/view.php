<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GisPosts */
?>
<div class="gis-posts-view">
<?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?> 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'post_author',
            'post_date',
            //'post_date_gmt',
            'post_title:ntext',
            'post_name',
            //'guid',
            [
                'attribute' => 'Nội dung',
                'value' => $model->getAttribute('post_content', 'text'),
                'format' => 'raw',
            ],
            //'post_content:ntext',
            'post_img:ntext',
            'post_status',
            //'comment_status',
            //'ping_status',
            //'post_password',
            //'to_ping:ntext',
            //'pinged:ntext',
            'post_modified',
            //'post_modified_gmt',
            'post_content_filtered:ntext',
            //'post_parent',
            'menu_order',
            'post_type',
            //'post_mime_type',
            //'comment_count',
        ],
    ]) ?>
<?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
</div>

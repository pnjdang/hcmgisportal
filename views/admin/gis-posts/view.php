<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GisPosts */
?>
<div class="gis-posts-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'post_author',
            'post_date',
            'post_date_gmt',
            'post_content:ntext',
            'post_title:ntext',
            'post_img:ntext',
            'post_status',
            'comment_status',
            'ping_status',
            'post_password',
            'post_name',
            'to_ping:ntext',
            'pinged:ntext',
            'post_modified',
            'post_modified_gmt',
            'post_content_filtered:ntext',
            'post_parent',
            'guid',
            'menu_order',
            'post_type',
            'post_mime_type',
            'comment_count',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\gisposts\models\posts\GisPosts */
$requestedAction = Yii::$app->requestedAction;
$this->title = $const['actions'][$requestedAction->id]['label'];
$this->params['breadcrumbs'][] = ['label' => $const['actions']['index']['label'] . ' ' . $const['title'], 'url' => [$const['actions']['index']['url']]];
$this->params['breadcrumbs'][] = $model->post_title;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet box blue-steel">
            <div class="portlet-title">
                <div class="caption"><span>Thêm mới bài viết</span></div>
            </div>
            <div class="portlet-body">
                <div class="gis-posts-create">
                    <?= $this->render('_form', [
                        'model' => $model,
                        'categories' => $categories,
                        'image' => $image,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>


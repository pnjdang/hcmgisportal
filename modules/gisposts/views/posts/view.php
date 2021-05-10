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
                <div class="caption"><span>Nội dung chi tiết bài viết</span></div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Tiêu đề</th>
                                <td colspan="3"><?= $model->post_title ?></td>
                            </tr>
                            <tr>
                                <th>Alias</th>
                                <td colspan="3"><?= $model->post_name ?></td>
                            </tr>
                            <tr>
                                <th>Tác giả</th>
                                <td colspan="3"><?= $model->post_author ?></td>
                            </tr>
                            <tr>
                                <th>Thời gian tạo bài viết</th>
                                <td><?= $model->post_date ?></td>
                                <th>Thời gian sửa bài viết</th>
                                <td><?= $model->post_modified ?></td>
                            </tr>
                            <tr>
                                <th>Loại bài viết</th>
                                <td><?= $model->post_type ?></td>
                                <th>Trạng thái</th>
                                <td><?= $model->post_status ?></td>
                            </tr>
                            <tr>
                                <th>Ảnh thumbnail</th>
                                <td colspan="3"><?= $model->post_img ?></td>
                            </tr>
                            <tr>
                                <th>Nội dung</th>
                                <td colspan="3"><?= htmlspecialchars_decode($model->post_content) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= Html::a('Cập nhật bài viết',Yii::$app->urlManager->createUrl(['cms/posts/update','id' => $model->id]),['class' => 'btn btn-warning'])?>
                        <?= Html::a('Danh sách bài viết',Yii::$app->urlManager->createUrl(['cms/posts/index']),['class' => 'btn btn-default pull-right'])?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

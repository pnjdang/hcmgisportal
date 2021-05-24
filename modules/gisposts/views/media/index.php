<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 5/4/2021
 * Time: 2:33 PM
 */

use yii\helpers\Html;
use yii\widgets\Pjax;
use app\modules\DCrud\DCrudAsset;
use yii\bootstrap\Modal;
use coderius\lightbox2\Lightbox2;
use yii\widgets\LinkPager;
DCrudAsset::register($this);

$requestedAction = Yii::$app->requestedAction;
$this->title = $const['actions'][$requestedAction->id]['label'] . ' ' . $const['title'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Media</h1>
    </div>
    <!-- END PAGE TITLE -->
    <div class="page-toolbar">
        <!-- BEGIN THEME PANEL -->
        <div class="btn-group">
            <a class="btn btn-success" role="modal-remote" href="<?= Yii::$app->urlManager->createUrl(['cms/media/create'])?>">Thêm mới</a>
        </div>
        <!-- END THEME PANEL -->
    </div>
</div>

<?php Pjax::begin(['id' => 'pjax-media-index'])?>

<?= Lightbox2::widget([
    'clientOptions' => [
        'resizeDuration' => 200,
        'wrapAround' => true,

    ]
]); ?>
<style>
    .img-wrap{
        min-height: 170px;
        background-color: #0b0b0b;
    }
</style>
<div class="portfolio-content">
    <div class="row form-group">
        <div class="col-lg-12">
            <?= Html::a('All',Yii::$app->urlManager->createUrl(['cms/media/index']),['class' => 'btn blue btn-outline'])?>
            <?= Html::a('Images',Yii::$app->urlManager->createUrl(['cms/media/index','file_type' => 'Image']),['class' => 'btn blue btn-outline'])?>
            <?= Html::a('Videos',Yii::$app->urlManager->createUrl(['cms/media/index','file_type' => 'Video']),['class' => 'btn blue btn-outline'])?>
        </div>
    </div>
    <?php if($model == null):?>
        <div class="row form-group">
            <div class="col-lg-12">
                <div class="alert alert-light alert-info">
                    <h4><i class="fa fa-exclamation-triangle"></i> No file!</h4>
                </div>
            </div>
        </div>
    <?php else:?>
    <div class="form-group">
        <?php foreach($model as $i => $item):?>
        <div class="col-lg-2 form-group">
            <div class="cbp-caption">
                <div class="cbp-caption-defaultWrap img-wrap">
                    <img src="../../<?= $item->file_path?>" alt="" width="100%"
                         style="max-height: 170px !important;"
                    > </div>
                <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                        <div class="cbp-l-caption-body">
                            <a href="<?= Yii::$app->urlManager->createUrl(['cms/media/view','id' => $item->id])?>" role="modal-remote" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase" rel="nofollow">more info</a>
                            <a data-pjax='0' href="../../<?= $item->file_path?>" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="Dashboard<br>by Paul Flavius Nechita">view larger</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>

    </div>
    <div class="row form-group">
        <div class="col-lg-12">
            <?= LinkPager::widget([
                'pagination' => $pagination,
            ]);?>
        </div>
    </div>
    <?php endif;?>
</div>


<?php Pjax::end()?>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetAdmin;

AppAssetAdmin::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>HCMGIS</title>
    <?php $this->head() ?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
<?php $this->beginBody() ?>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <?php include('header.php'); ?>
</div>
<!-- END HEADER -->
<div class="clearfix"></div>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <?php include('sidebar.php'); ?>
    </div>
    <div class="page-content-wrapper">
        <div class="page-content">
            <?=
            Breadcrumbs::widget([
                'tag' => 'ol',
                'homeLink' => [
                    'label' => Yii::t('yii', 'Trang chủ'),
                    'url' => Yii::$app->getHomeUrl(),
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'itemTemplate' => "<li>{link}<i class='fa fa-circle'></i></li>",
                'activeItemTemplate' => "<li class='active'>{link}</li>",
                'options' => [
                    'class' => 'page-breadcrumb breadcrumb',
                ]
            ])
            ?>
            <?= $content ?>
        </div>
    </div>
</div>
<div class="page-footer">
    <?php include('footer.php'); ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


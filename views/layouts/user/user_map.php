<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Modal;
use app\assets\AppAssetUser;

AppAssetUser::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" style="background-color: #3b434c">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Tiềm lực khoa học công nghệ</title>
    <?php $this->head() ?>
</head>
<body class="page-container-bg-solid">
<?php $this->beginBody() ?>
<!-- BEGIN HEADER -->
<div class="page-header">
    <?php include('header_user.php'); ?>
</div>
<!-- END HEADER -->
<div class="clearfix"></div>
<div class="page-container">
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<div class="page-footer">
    <?php include('footer_user.php'); ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetError;

AppAssetError::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Tiềm lực khoa học công nghệ</title>
    <?php $this->head() ?>
</head>
<body class=" page-404-3">
<?php $this->beginBody() ?>
<div class="page-inner">
    <img src="<?= Yii::$app->homeUrl?>resources/img/error_earth.jpg" class="img-responsive" alt=""></div>
<div class="container error-404">
    <h1>404</h1>

    <h2>Không tìm thấy trang!</h2>


    <p>
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->id_loaitk == 3):?>
        <a href="<?= Yii::$app->urlManager->createUrl('user/trangchu')?>" class="btn red btn-outline"> Quay lại trang chủ </a>
        <?php endif;?>
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->id_loaitk != 3):?>

            <a href="<?= Yii::$app->homeUrl?>" class="btn red btn-outline"> Quay lại trang chủ </a>
<?php endif;?>
        <br></p>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

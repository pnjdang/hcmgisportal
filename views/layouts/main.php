<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <link rel="shortcut icon" href="<?php echo Yii::$app->getHomeUrl(); ?>images/favicon.ico" type="image/x-icon" />
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>HCMGIS.VN - Nền tảng dịch vụ HCMGIS</title>
    <?php $this->head() ?>
</head>
<body id="default_theme" class="home_page1" style="overflow: visible;">
<?php $this->beginBody() ?>
<!-- BEGIN HEADER -->

    <?php include('header.php'); ?>

<!-- END HEADER -->

            <?= $content ?>
<div class="">
    <?php include('footer.php'); ?>
</div>
<script type="text/javascript">
var _govaq = window._govaq || [];
 _govaq.push(['trackPageView']);
 _govaq.push(['enableLinkTracking']);
 (function () {
  _govaq.push(['setTrackerUrl', 'https://f-emc.ngsp.gov.vn/tracking']);
  _govaq.push(['setSiteId', '271']);
  var d = document,
  g = d.createElement('script'),
  s = d.getElementsByTagName('script')[0];
  g.type = 'text/javascript';
  g.async = true;
  g.defer = true;
  g.src = 'https://f-emc.ngsp.gov.vn/embed/gov-tracking.min.js';
  s.parentNode.insertBefore(g, s);
  })();
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

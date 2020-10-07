<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DschuyengiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Chuyên gia';

$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('admin/site/index') ?>">Tổng quan</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/index') ?>">Danh sách tổng hợp</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active uppercase">Danh sách theo lĩnh vực</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>STT</th>
                        <th>Lĩnh vực</th>
                        <th>Số lượng chuyên gia</th>
                    </tr>
                    <?php if($model['soluong'] != null):?>
                        <?php foreach($model['soluong'] as $i => $soluong):?>
                            <tr>
                                <td><?= $i +1?></td>
                                <td><a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/linhvucchitiet').'?id='.$soluong['id_cap1']?>"><?= $soluong['ten_cap1']?></a></td>
                                <td><?= $soluong['so_luong']?></td>
                            </tr>
                        <?php endforeach?>
                    <?php endif?>
                </table>
            </div>
        </div>
    </div>

</div>
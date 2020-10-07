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
        <span class="active uppercase">Danh sách theo chuyên ngành</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <table id="linhvucTable" class="table table-bordered table-striped">
                    <tr>
                        <th>Lĩnh vực nghiên cứu 1</th>
                        <th>Lĩnh vực nghiên cứu 2</th>
                        <th>Lĩnh vực nghiên cứu 3</th>
                        <th>Số lượng chuyên gia</th>
                    </tr>
                    <?php if($thongke['linhvuc'] != null):?>
                        <?php foreach($thongke['linhvuc'] as $i => $linhvuc):?>
                            <tr>
                                <th rowspan="<?= (isset($linhvuc['cap2s'])) ? sizeof($linhvuc['cap2s']) + $linhvuc['sl_cap3'] + 1 : 1?>"><span class="uppercase"><?= $linhvuc['ten_cap1']?></span></th>
                                <td colspan="2"></td>
                                <td align="right"><?= $linhvuc['so_luong']?></td>
                            </tr>
                            <?php if(isset($linhvuc['cap2s'])):?>
                                <?php foreach($linhvuc['cap2s'] as $k => $cap2s):?>
                                    <tr>
                                        <th rowspan="<?= sizeof($cap2s['cap3s']) + 1?>"><?= $cap2s['ten_cap2']?></th>
                                        <td></td>
                                        <td align="right"><?= $cap2s['so_luong']?></td>
                                    </tr>
                                    <?php foreach($cap2s['cap3s'] as $l => $cap3s):?>
                                        <tr>
                                            <td><a href="<?= Yii::$app->urlManager->createUrl('admin/danhsachchuyengia/chuyennganhchitiet').'?id='.$cap3s['id_cap3']?>"><?= $cap3s['ten_cap3']?></a></td>
                                            <td align="right"><?= $cap3s['so_luong']?></td>
                                        </tr>
                                    <?php endforeach?>
                                <?php endforeach?>
                            <?php endif?>
                        <?php endforeach?>
                    <?php endif?>
                </table>
            </div>
        </div>
    </div>
</div>
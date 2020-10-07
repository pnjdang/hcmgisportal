<?php

use yii\widgets\DetailView;
use kartik\form\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model app\models\VChuyengia */
?>
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="<?= Yii::$app->homeUrl ?>">Trang chủ</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/index') ?>">Danh sách chuyên gia</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active"><?= $model['chuyengia']->ho_ten?></span>
    </li>
</ul>

<div class="row">
    <div class="col-lg-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="uppercase">Thông tin chi tiết</span>
                </div>
                <div class="caption pull-right">
                    <?php if($model['chuyengia']->status == 2):?>
                        <a class="btn btn-default"
                           href="<?= Yii::$app->urlManager->createUrl('user/'.$model['controller'].'/update') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Thông
                            tin chi tiết</a>
                    <?php else:?>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/'.$model['controller'].'/view') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Thông
                        tin chi tiết</a>
                    <?php endif?>

                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/ngoaingu') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Ngoại ngữ</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/congtrinh') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Công
                        trình nghiên cứu</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/congtac') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Công tác</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/daotao') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Đào tạo</a>
                    <a class="btn btn-default"
                       href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/detai') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Đề tài</a>
                    <?php if($model['chuyengia']->created_by == Yii::$app->user->id):?>
                        <a class="btn btn-primary"
                           href="<?= Yii::$app->urlManager->createUrl('user/chuyengia/congbo') . '?id=' . $model['chuyengia']->id_chuyengia ?>">Công bố thông tin</a>
                    <?php endif?>
                </div>
            </div>
            <div class="portlet-body">
                <?php $form = ActiveForm::begin()?>
                <h4>Chọn thông tin công bố</h4>
                <table class="table table-striped table-bordered detail-view">
                    <tr>
                        <th style="width: 20%">Họ tên</th>
                        <td style="width: 70%"><?= ((is_null($model['chuyengia']->ho_ten)) ? '' : $model['chuyengia']->ho_ten )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'ho_ten')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Năm sinh</th>
                        <td><?=((is_null($model['chuyengia']->nam_sinh)) ? '' : $model['chuyengia']->nam_sinh )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'nam_sinh')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Giới Tính</th>
                        <td><?=((is_null($model['chuyengia']->gioi_tinh)) ? 'Nữ' : 'Nam' )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'gioi_tinh')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Học hàm</th>
                        <td><?=((is_null($model['chuyengia']->hocham)) ? '' : $model['chuyengia']->hocham->ten_hh )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'hocham_id')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Học vị</th>
                        <td><?=((is_null($model['chuyengia']->hocvi)) ? '' : $model['chuyengia']->hocvi->ten_hv )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'hocvi_id')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Lĩnh vực hoạt động</th>
                        <td><?=implode(\yii\helpers\ArrayHelper::map($model['chuyengia']->chuyengiaLinhvucs, 'cap1.id_cap1', 'cap1.ten_cap1'))?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'linhvuc_hoatdong')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Chuyên ngành</th>
                        <td><?=implode(\yii\helpers\ArrayHelper::map($model['chuyengia']->chuyengiaChuyennganhs, 'cap3.id_cap3', 'cap3.ten_cap3'))?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'chuyen_nganh')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Đơn vị</th>
                        <td><?=((is_null($model['chuyengia']->donvi)) ? '' : $model['chuyengia']->donvi->ten_donvi )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'donvi_id')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Công việc hiện nay</th>
                        <td><?=((is_null($model['chuyengia']->congviec_hiennay)) ? '' : $model['chuyengia']->congviec_hiennay )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'congviec_hiennay')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Chức vụ hiện tại</th>
                        <td><?=((is_null($model['chuyengia']->chucvu_hientai)) ? '' : $model['chuyengia']->chucvu_hientai )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'chucvu_hientai')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Địa chỉ nhà riêng</th>
                        <td><?=((is_null($model['chuyengia']->diachi_nharieng)) ? '' : $model['chuyengia']->diachi_nharieng )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'diachi_nharieng')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Điện thoại</th>
                        <td><?=((is_null($model['chuyengia']->dien_thoai)) ? '' : $model['chuyengia']->dien_thoai )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'dien_thoai')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Di động</th>
                        <td><?=((is_null($model['chuyengia']->di_dong)) ? '' : $model['chuyengia']->di_dong )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'di_dong')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?=((is_null($model['chuyengia']->email)) ? '' : $model['chuyengia']->email )?></td>
                        <td style="width: 10%"><?= $form->field($model['config'],'email')->widget(CheckboxX::classname(), [
                                'pluginOptions'=>[
                                    'threeState'=>false,
                                    'size' => 'sm',
                                ]
                            ])->label(false);?></td>
                    </tr>
                </table>
                <div class="col-lg-12">
                    <button class="btn btn-warning pull-left" type="submit">Cập nhật</button>
                    <a class="btn btn-default pull-right"
                       href="<?= Yii::$app->urlManager->createUrl('chuyen-gia') ?>">Danh sách chuyên gia</a>
                </div>
                <div style="clear: both"></div>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>

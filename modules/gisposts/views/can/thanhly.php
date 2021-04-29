<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\danhmuc\capnha\Capnha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thanhly-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <tr>
                    <th>Địa chỉ</th>
                    <td><?= $model['can']->fulldiachi?></td>
                </tr>
                <tr>
                    <th>Loại nhá</th>
                    <td><?= $model['can']->loainha->ten_loainha?></td>
                </tr>
                <tr>
                    <th>Diện tích</th>
                    <td><?= ($model['can']->dien_tich_khuon_vien != null) ? $model['can']->dien_tich_khuon_vien .' m<sup>2</sup>' : ''?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?= $form->field($model['can'],'da_ban')->checkbox(['class' => 'form-control'], false)->label('Đã bán')?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model['can'],'ngay_ban')->widget(MaskedInput::class,[
                'clientOptions' => ['alias' =>  'dd/mm/yyyy']
            ])->label('Ngày bán')?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model['can'],'ghichu_ban')->textarea()->label('Ghi chú bán căn')?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <?= $form->field($model['can'],'chuyen_giao')->checkbox(['class' => 'form-control'], false)->label('Chuyển giao')?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model['can'],'ngay_chuyengiao')->widget(MaskedInput::class,[
                'clientOptions' => ['alias' =>  'dd/mm/yyyy']
            ])->label('Ngày chuyển giao')?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model['can'],'ghichu_chuyengiao')->textarea()->label('Ghi chú chuyển giao')?>
        </div>
    </div>


    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model['can']->isNewRecord ? 'Create' : 'Update', ['class' => $model['can']->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

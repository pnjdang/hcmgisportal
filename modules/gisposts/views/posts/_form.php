<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\modules\gisposts\models\posts\GisPosts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gis-posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'post_title')->textarea(['rows' => 3]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <?= $form->field($image, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview' => [
                        ($model->post_img != null) ? Yii::$app->homeUrl.$model->post_img : '',
                    ],
//                    'initialPreviewAsData' => true,
                    'overwriteInitial' => true,
                    'maxFileSize' => 2800
                ]
            ])->label('Upload ảnh thumbnail') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'post_type')->dropDownList(ArrayHelper::map($categories['post_type'], 'type_name', 'type_name'), ['prompt' => '--- Chọn loại bài viết ---']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'post_content')->widget(TinyMce::className(), [
                'options' => ['rows' => 35],
                'language' => 'vi',
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste"
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'post_content_filtered')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'post_status')->dropdownList([1 => 'Publish', 0 => 'Close']) ?>
        </div>
    </div>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
            <?= Html::a('Danh sách bài viết', Yii::$app->urlManager->createUrl(['cms/posts/index']), ['class' => 'btn btn-default pull-right']) ?>

        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

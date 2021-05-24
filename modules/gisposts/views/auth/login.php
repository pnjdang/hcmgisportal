<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/29/2021
 * Time: 11:57 PM
 */

use kartik\form\ActiveForm;

?>

<div class="container-login100 has-background-image">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
        <?php $form = ActiveForm::begin([
            'bsVersion' => 4,
            'options' => [
                'class' => 'login100-form validate-form'
            ]
        ]) ?>
        <span class="login100-form-title p-b-49">
						HCMGIS
					</span>

        <?= $form->field($model, 'ten_dang_nhap', [
            'addon' => [
                'prepend' => [
                    'content' => '<i class="fa fa-user"></i>'
                ]
            ]
        ])->input('text',['placeholder' => 'Username'])->label(false) ?>

        <?= $form->field($model, 'mat_khau', [
            'addon' => [
                'prepend' => [
                    'content' => '<i class="fa fa-key"></i>'
                ]
            ]
        ])->input('password',['placeholder' => 'Password'])->label(false) ?>


        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn">
                    Login
                </button>
            </div>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>

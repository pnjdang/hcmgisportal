<?php

/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/31/2017
 * Time: 3:07 PM
 */
//use kartik\form\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<!-- Nội dung -->
<section class="layout_padding">
    <div class="container">
        <div class="row margin_bottom_30">
               <!-- featured cont -->
               <div class="col-md-12 cont_theme_blog">
                  <div class="full">
                      <h3><?= $model['post_title']?></h3>
                      <div class="post_content">
                          <?php if($model['ping_status'] == 'open'):?>
                            <?= ($model['post_img'] != null) ? '<img src="'.$model['post_img'].'">' : '' ?>  
                          <?php endif;?>
                        <?= $model['post_content'] ?>
                      </div>
                  </div>
               </div>
               <!-- end featured cont -->
            </div>
    </div>
</section>
<!-- end Nội dung -->
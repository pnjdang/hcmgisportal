<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 5/4/2021
 * Time: 10:51 AM
 */

?>

<section class="layout_padding">
    <div class="container">
        <div class="row margin_bottom_30">
            <!-- featured cont -->
            <div class="col-md-12 cont_theme_blog">
                <div class="full">
                    <h3><?= $model['post_title']?></h3>
                    <div class="date"><?= date('D d-m-Y', strtotime($model['post_date']))?></div>
                    <div class="post_content">
                        <?php if($model['ping_status'] == '1'):?>
                            <?= ($model['post_img'] != null) ? '<img class="head_img" src="'.$model['post_img'].'">' : '' ?>
                        <?php endif;?>
                        <?= $model['post_content'] ?>
                    </div>
                </div>
            </div>
            <!-- end featured cont -->
        </div>
    </div>
</section>

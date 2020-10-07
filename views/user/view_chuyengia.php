<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VChuyengia */
?>
<div class="vchuyengia-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ho_ten',
            'nam_sinh',
            // ['attribute'=>'publish_date', 'type'=>DetailView::INPUT_DATE],
            [                      // the owner name of the model
                'label' => 'Giới Tính',
                'value' => ($model->gioi_tinh == null) ? '' : (($model->gioi_tinh == 1) ? 'Nam' : 'Nu'),
            ],
            'ten_hh',
            'ten_hv',
            'chuyen_mon',
            'chuc_vu',
            'dinh_huong',
            'congtrinh_nghiencuu',
            'donvi_congtac',
            'ten_dvct',
            'dia_chi',
            'dien_thoai',
            'email:email',
            'ghi_chu',
          //  'geo_x',
           // 'geo_y',
        ],
    ])
    ?>
    <div class="col-lg-12 form-group">
        <button data-dismiss="modal" type="button" class="btn btn-default pull-right">Đóng</button>
    </div>
    <div style="clear: both"></div>
</div>

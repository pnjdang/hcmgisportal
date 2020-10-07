<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LinhvucnghiencuuCap2 */
?>
<div class="linhvucnghiencuu-cap2-view">
 
    <table class="table table-bordered">
        <tr>
            <th>Tên lĩnh vực nghiên cứu cấp 2</th>
            <td><?= $model->ten_cap2?></td>
        </tr>
        <tr>
            <th>Tên lĩnh vực nghiên cứu cấp 1</th>
            <td><?= $model->idCap1->ten_cap1?></td>
        </tr>
        <tr>
            <th>Mã cấp 2</th>
            <td><?= $model->ma_cap2?></td>
        </tr>
        <tr>
            <th>Ghi chú</th>
            <td><?= $model->ghichu_cap2?></td>
        </tr>
    </table>

</div>

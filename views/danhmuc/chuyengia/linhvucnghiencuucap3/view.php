<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LinhvucnghiencuuCap3 */
?>
<div class="linhvucnghiencuu-cap3-view">

    <table class="table table-bordered">
        <tr>
            <th>Tên lĩnh vực nghiên cứu cấp 3</th>
            <td><?= $model->ten_cap3?></td>
        </tr>
        <tr>
            <th>Tên lĩnh vực nghiên cứu cấp 2</th>
            <td><?= $model->idCap2->ten_cap2?></td>
        </tr>
        <tr>
            <th>Mã cấp 3</th>
            <td><?= $model->ma_cap3?></td>
        </tr>
        <tr>
            <th>Ghi chú</th>
            <td><?= $model->ghichu_cap3?></td>
        </tr>
    </table>

</div>

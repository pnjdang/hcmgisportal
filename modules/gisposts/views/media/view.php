<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 5/5/2021
 * Time: 3:43 PM
 */

?>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <th>File Name</th>
                <td><?= $model->file_name ?></td>
            </tr>
            <tr>
                <th>File Caption</th>
                <td><?= $model->file_caption ?></td>
            </tr>
            <tr>
                <th>File Type</th>
                <td><?= $model->file_type ?></td>
            </tr>
            <tr>
                <th>File Path</th>
                <td><span id="filepath"><?= $model->file_path ?></span>
                    <button type="button" class="btn btn-xs btn-info" id="copyBtn"
                            onclick="copyToClipboard('#filepath')">Copy to clipboard
                    </button>
                </td>
            </tr>
            <tr>
                <th>Uploaded At</th>
                <td><?= $model->uploaded_at ?></td>
            </tr>
        </table>
    </div>
</div>

<script>
    $('#copyBtn').click(function () {

        var text = $("#filepath").get(0)
        var selection = window.getSelection();
        var range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
        //add to clipboard.
        document.execCommand('copy');
    })
</script>
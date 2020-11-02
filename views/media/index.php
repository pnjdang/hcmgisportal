<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = "Media Gallery";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo Html::encode($this->title)?></h1>

<p>
    <?php echo Html::a('Upload File', ['upload'], ['class'=> 'btn btn-primary']) ?>
   
</p>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css"><script src="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox-plus-jquery.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })
</script>
<div class="row">
    <?php
    foreach ($medias as $media){
        $img = $media->filepath;
        if($media->extension == 'doc' || $media->extension == 'docx'){
          $img = 'uploads/word.jpg';  
        } else if($media->extension == 'xls' || $media->extension == 'xlsx'){
          $img = 'uploads/excel.jpg';  
        } else if($media->extension == 'ppt' || $media->extension == 'pptx'){
          $img = 'uploads/powerpoint.jpg';  
        } else if($media->extension == 'pdf'){
          $img = 'uploads/pdf.jpg';  
        }
    ?>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="card">
            <a data-rel="iLightbox[gallery-1]" data-lightbox="lightbox1" data-title="<?php echo Yii::getAlias('@web').'/'.$media->filepath; ?>" data-caption="<?php echo $img; ?>" href="<?php echo Yii::getAlias('@web').'/'.$img; ?>"><img width="300" height="225" src="<?php echo Yii::getAlias('@web').'/'.$img; ?>" class="attachment-medium size-medium card-img-top" alt="" aria-describedby="gallery-1-<?php echo $media->id; ?>"></a>
            
            <div class="card-body">
                <h5 class="card-title" style="word-wrap: break-word"><?php echo $media->filename; ?></h5>
                <div class="text-right">
                    <?php 
                    echo Html::a('Dowload', ['download', 'id'=>$media->id], ['class'=>'btn btn-primary']);
                    echo '&nbsp;';
                    echo Html::a('Delete', ['delete', 'id'=>$media->id], ['class'=>'btn btn-danger']);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
    }
    ?>
</div>

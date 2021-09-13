<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/scroll-pic-list/css/style-3.css" rel="stylesheet">
<div class="col-md-12">
    <div class="swiper-container scroll-pic-list-swiper scroll-pic-list-swiper-3">
        <div class="swiper-wrapper">
            <?php if(is_array(archive(24,0,0,'0,0,0',0,'adddate-desc',6,true,'',1,'','',0,0)))
foreach(archive(24,0,0,'0,0,0',0,'adddate-desc',6,true,'',1,'','',0,0) as $i => $archive) { ?>
            <div class="swiper-slide scroll-pic-list-swiper-item">
                <a title="<?php echo $archive['stitle'];?>" href="<?php echo $archive['url'];?>">
                    <img alt="<?php echo $archive['stitle'];?>" src="<?php echo $archive['thumb'];?>" cmseasy-id="<?php echo $archive['aid'];?>"   class="cmseasyeditimg swiper-lazy" />
                </a>
            </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination scroll-pic-list-swiper-pagination-3"></div>
    </div>
</div>

<script src="<?php echo $template_path;?>/visual/modules/common/scroll-pic-list/js/scroll-pic-list.js" type="text/javascript"></script>
<style type="text/css">
    .scroll-pic-list-swiper-3 .scroll-pic-list-swiper-item {
        border:rgba(255, 255, 255, 0);
    }
    .scroll-pic-list-swiper-3 .scroll-pic-list-swiper-item:hover {
        border:#eeeeee;
    }

</style>
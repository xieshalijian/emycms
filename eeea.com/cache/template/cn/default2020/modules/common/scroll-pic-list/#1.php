<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/scroll-pic-list/css/style-1.css" rel="stylesheet">
<div class="col-md-12">
    <div class="scroll-pic-list-index-title scroll-pic-list-index-title-1">
<?php if(is_array(plugins::categoryinfo(24,20)))
foreach(plugins::categoryinfo(24,20) as $cat) { ?>
<h4>
    <a title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>" target="_blank" cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit ">
        <?php echo $cat['catname'];?>
    </a>
</h4>
        <?php if($cat['subtitle']) { ?>
<p class="scroll-pic-list-p-1">
    <span cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit">
                <?php echo $cat['subtitle'];?>
            </span>
</p>
        <?php } ?>
<?php } ?>
</div>
</div>
<style type="text/css">
    .scroll-pic-list-index-title-1 h4.scroll-pic-list-h4 a {
        font-size:22px;
        color:#333333;
    }
    .scroll-pic-list-index-title-1 h4.scroll-pic-list-h4 a:hover {
        color:#000000;
    }
    .scroll-pic-list-index-title-1 p.scroll-pic-list-p p {
        font-size:14px;
        color:#999999;
    }
    .scroll-pic-list-index-title-1 p.scroll-pic-list-p:hover {
        color:#999999;
    }
</style>
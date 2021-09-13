<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/scroll-pic-list/css/style-2.css" rel="stylesheet">
<div class="col-md-12">
    <ul class="scroll-pic-list-index-title-ul scroll-pic-list-index-title-ul-2">
    <?php if(is_array(plugins::categoryinfo(24,20)))
foreach(plugins::categoryinfo(24,20) as $cat) { ?>
    <?php if(is_array(categories($cat['catid'])))
foreach(categories($cat['catid']) as $cat) { ?>
    <li>
        <a title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>" target="_blank" cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit ">
            <?php echo $cat['catname'];?>
        </a>
    </li>
    <?php } ?>
<?php } ?>
</ul>
</div>
<style type="text/css">
    .scroll-pic-list-index-title-ul-2 li a {
        color:#333333;
        border-color:#efefef;
        background-color:#f6f6f6;
        font-size:14px;
        border-radius:0px;
    }
    .scroll-pic-list-index-title-ul-2 li a:hover {
        color:#ffffff;
        border-color:#efefef;
        background-color:#06276a;
    }

</style>
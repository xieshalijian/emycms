<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/about-columns/css/style-2.css" rel="stylesheet">


<?php if(is_array(plugins::categoryinfo(1)))
foreach(plugins::categoryinfo(1) as $cat) { ?>
<div class="about-columns-img about-columns-img-2">
    <a title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>" target="_blank">
        <img alt="<?php echo $cat['catname'];?>" src="<?php echo $cat['image'];?>" class="cmseasyeditimg" cmseasy-id="<?php echo $cat['catid'];?>"   />
    </a>
</div>
<?php } ?>



<style type="text/css">
    .about-columns-img-2 img {
        height: 250px;
    }
    .about-columns-img:before{
        background: #ffffff;
    }

</style>
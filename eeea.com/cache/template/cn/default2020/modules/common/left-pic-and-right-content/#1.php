<?php defined('ROOT') or exit('Can\'t Access !'); ?>


<link href="<?php echo $template_path;?>/visual/modules/common/left-pic-and-right-content/css/style-1.css" rel="stylesheet">
<div class="left-pic-and-right-content-title left-pic-and-right-content-title-1">
    <?php if(is_array(plugins::categoryinfo(21)))
foreach(plugins::categoryinfo(21) as $cat) { ?>

    <h4>
        <a title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>" cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit ">
            <?php echo $cat['catname'];?>
        </a>
    </h4>
    <?php if($cat['subtitle']) { ?>
    <p>
    <span cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit">
                <?php echo $cat['subtitle'];?>
            </span>
    </p>
<?php } ?>
    <?php } ?>
</div>
<style>
    .left-pic-and-right-content-title-1 h4,
    .left-pic-and-right-content-title-1 h4 a {
        color:#333333;
        border-color:rgba(255, 255, 255, 0);
        background-color:rgba(255, 255, 255, 0);
        font-size:22px;
        border-radius:0px;
    }
    .left-pic-and-right-content-title-1 h4 a:hover {
        color:#000000;
        border-color:rgba(255, 255, 255, 0);
    }
    .left-pic-and-right-content-title-1 p  {
        color:#999999;
        font-size:14px;
    }
    .left-pic-and-right-content-title-1 p:hover {
        color:#999999;
    }
</style>


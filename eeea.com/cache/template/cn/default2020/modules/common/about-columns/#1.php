<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/about-columns/css/style-1.css" rel="stylesheet">


<?php if(is_array(plugins::categoryinfo(1,20,200)))
foreach(plugins::categoryinfo(1,20,200) as $cat) { ?>
<div class="about-columns-text about-columns-text-1">
            <h4>
                <a title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>" cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit">
                    <?php echo $cat['catname'];?>
                </a>
            </h4>

    <?php if($cat['subtitle']) { ?>
            <div cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit subtitle">
                <?php echo $cat['subtitle'];?>
            </div>
<?php } ?>
            <p cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit content">
                <?php echo $cat['categorycontent'];?>
            </p>

    <em></em>
</div>
<?php } ?>



<style type="text/css">
    .shopping-pics-thumbs .shopping-pics-small-item {

    }
    .about-columns-text-1 h4 a {
        font-size:22px;
        color:#ffffff;
    }
    .about-columns-text-1 h4 a:hover {
        color:#ffffff;
    }
    .about-columns-text-1 .subtitle {
        font-size:16px;
        color:#666666;
    }
    .about-columns-text-1 .subtitle:hover {
        color:#666666;
    }
    .about-columns-text-1 p {
        font-size:14px;
        color:#ffffff;
    }
    .about-columns-text-1 p:hover {
        color:#ffffff;
    }
    .about-columns .container {
        background:$_background-color;
    }
</style>



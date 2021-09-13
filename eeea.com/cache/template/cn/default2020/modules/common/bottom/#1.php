<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/bottom/css/style-1.css" rel="stylesheet">
<div class="foot-ul foot-ul-1 foot-ul-1-1">
    <?php if(is_array(plugins::categoryinfo(2,20)))
foreach(plugins::categoryinfo(2,20) as $cat) { ?>
            <h4>
                <a title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>" cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit">
                    <?php echo $cat['catname'];?>
                </a>
            </h4>
            <ul>
                <?php if(is_array(categories($cat['catid'])))
foreach(categories($cat['catid']) as $cat) { ?>
                <li>
                    <a title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>" cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit">
                        <?php echo $cat['catname'];?>
                    </a>
                </li>
                <?php } ?>
            </ul>
    <?php } ?>
</div>
<style type="text/css">
    .foot-ul-1-1 ul h4 a {
        font-size:14px;
        color:#000000;
    }
    .foot-ul-1-1 ul h4 a:hover {
        color:#000000;
    }
    .foot-ul-1-1 ul li a {
        font-size:14px;
        color:#000000;
    }
    .foot-ul-1-1 ul li a:hover {
        color:#000000;
    }
</style>
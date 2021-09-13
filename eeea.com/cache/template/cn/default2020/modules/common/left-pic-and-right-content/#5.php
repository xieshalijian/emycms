<?php defined('ROOT') or exit('Can\'t Access !'); ?>


<link href="<?php echo $template_path;?>/visual/modules/common/left-pic-and-right-content/css/style-5.css" rel="stylesheet">

    <?php if(is_array(plugins::categoryinfo(21)))
foreach(plugins::categoryinfo(21) as $cat) { ?>
    <div class="left-pic-and-right-content-more left-pic-and-right-content-more-5">
        <a title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>">
            <span class=" cmseasyedit"   >
           <?php echo lang('more');?>
            </span>
            <span class="glyphicon glyphicon-menu-right"></span>
        </a>
    </div>
    <?php } ?>
    <style>
        .left-pic-and-right-content-more-5 a {
            border-radius:0px;
            color:#333333;
            font-size:14px;
            background:rgba(255, 255, 255, 0);
            border-color:#999999;
        }
        .left-pic-and-right-content-more-5 a:hover {
            color:#ffffff;
            background:#06276a;
            border-color:#06276a;
        }
    </style>

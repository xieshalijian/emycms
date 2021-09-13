<?php defined('ROOT') or exit('Can\'t Access !'); ?>


<link href="<?php echo $template_path;?>/visual/modules/common/left-pic-and-right-content/css/style-2.css" rel="stylesheet">
<div class="left-pic-and-right-content-title">
<div class="left-pic-and-right-content-title-ul left-pic-and-right-content-title-ul-2">
<ul>
<?php if(is_array(plugins::categoryinfo(21,20,120)))
foreach(plugins::categoryinfo(21,20,120) as $cat) { ?>
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
</div>
<style>
        .left-pic-and-right-content-title-ul-2 ul li a {
            color:#333333;
            border-color:#efefef;
            background-color:#f6f6f6;
            font-size:14px;
            border-radius:0px;
        }
        .left-pic-and-right-content-title-ul-2 ul li a:hover,
        .left-pic-and-right-content-title-ul-2 ul li a.active {
            color:#ffffff;
            border-color:#efefef;
            background-color:#06276a;
        }

        .left-pic-and-right-content-title-ul-2 ul li a:before
        {
            background-color:#ffffff;
        }
        .left-pic-and-right-content-title-ul-2 ul li a:after {
            border-left-color:#ffffff;
        }
    </style>


<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/contact-columns/css/style-1.css" rel="stylesheet">



<?php if(is_array(plugins::categoryinfo(10,20,140)))
foreach(plugins::categoryinfo(10,20,140) as $cat) { ?>
<div class="contact-columns-left contact-columns-left-1">
            <h4>
                <span cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit">
                    <?php echo $cat['catname'];?>
                </span>
            </h4>
    <?php if($cat['subtitle']) { ?>
            <span cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit subtitle">
<?php echo $cat['subtitle'];?>
</span>
<?php } ?>
            <p cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit content">
                <?php echo $cat['categorycontent'];?>
            </p>

            <a class="more" title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>">
                <span class="column-title cmseasyedit"   >
                    <?php echo lang('more');?>
                </span>  &gt;
            </a>
</div>
<?php } ?>



<style type="text/css">

    .contact-columns-left-1 {
        height: 344px;
        background: #ffffff;
    }
    .contact-columns-left-1 h4 span {
        font-size:22px;
        color:#333333;
    }
    .contact-columns-left-1 h4 span:hover {
        color:#000000;
    }
    .contact-columns-left-1 span.subtitle {
        font-size:14px;
        color:#dbdbdb;
    }
    .contact-columns-left-1 span.subtitle:hover {
        color:#dbdbdb;
    }

    .contact-columns-left-1 p {
        font-size:14px;
        color:#000000;
    }
    .contact-columns-left-1 p:hover {
        color:#000000;
    }
    .contact-columns-left-1 a.more
    {
        font-size:14px;
        color:#a2a2a2;
        border-color:#eeeeee;
        border-radius: 50px;
        background-color:#ffffff ;
    }

    .contact-columns-left-1 a.more:hover,
    .contact-columns-left-1:hover a.more {
        color:#ffffff;
        border-color:#06276a;
        background-color:#06276a;
    }


</style>

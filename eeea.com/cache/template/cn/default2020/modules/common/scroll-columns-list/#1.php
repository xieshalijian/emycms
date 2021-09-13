<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/scroll-columns-list/css/style.css" rel="stylesheet">

<div class="col-md-12">
    <div class="swiper-container scroll-columns-list-swiper scroll-columns-list-swiper-1">
        <div class="swiper-wrapper">
            <?php if(is_array(plugins::categoryinfo(7,20,60)))
foreach(plugins::categoryinfo(7,20,60) as $cat) { ?>
            <?php if(is_array(categories($cat['catid'])))
foreach(categories($cat['catid']) as $cat) { ?>
            <div class="swiper-slide scroll-columns-list-item">
                <div class="scroll-columns-list-img">
                    <a title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>" target="_blank">
                        <img alt="<?php echo $cat['catname'];?>" src="<?php echo $cat['image'];?>" class="cmseasyeditimg" cmseasy-id="<?php echo $cat['catid'];?>"   />
                    </a>
                </div>
                <div class="scroll-columns-list-text">
                    <h4>
                        <a title="<?php echo $cat['catname'];?>" href="<?php echo $cat['url'];?>" target="_blank">
                            <span cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit">
                <?php echo $cat['htmldir'];?>
            </span>
                            <strong cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit ">
                                <?php echo $cat['catname'];?>
                            </strong>
                        </a>
                    </h4>
                    <?php if($cat['subtitle']) { ?>
                    <span class="scroll-columns-list-text-subtitle cmseasyedit" cmseasy-id="<?php echo $cat['catid'];?>"   class="cmseasyedit">
                        <?php echo $cat['subtitle'];?>
                    </span>
                    <?php } ?>
                    <div cmseasy-id="<?php echo $cat['catid'];?>"   class="scroll-columns-list-text-p cmseasyedit content ">
                        <?php echo cut(strip_tags($cat['categorycontent']),60);?>
                    </div>

                    <a class="more">
                        <span class=" cmseasyedit"   >
                        <?php echo lang('more');?>
                        </span>
                    </a>

                </div>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
        <div class="swiper-pagination scroll-columns-list-swiper-pagination"></div>
    </div>
</div>
<script src="<?php echo $template_path;?>/visual/modules/common/scroll-columns-list/js/scroll-columns-list.js" type="text/javascript"></script>
<style type="text/css">
    .scroll-columns-list-swiper-1 .scroll-columns-list-item .scroll-columns-list-text h4 a {
        font-size:26px;
        color:#333333;
    }
    .scroll-columns-list-swiper-1 .scroll-columns-list-item .scroll-columns-list-text h4 a:hover {
        color:#000000;
    }
    .scroll-columns-list-swiper-1 .scroll-columns-list-item .scroll-columns-list-text-p {
        font-size:14px;
        color:#555555;
    }
    .scroll-columns-list-swiper-1 .scroll-columns-list-item .scroll-columns-list-text-p:hover {
        color:#555555;
    }
    .scroll-columns-list-swiper-1 .scroll-columns-list-item .scroll-columns-list-text {
        border:$_border
    }
    .scroll-columns-list-swiper-1 .scroll-columns-list-item .scroll-columns-list-text .more {
        font-size:14px;
        color:#ffffff;
        border-color:#06276a;
        border-radius: 50px;
        background-color:#06276a ;
    }
    .scroll-columns-list-swiper-1 .scroll-columns-list-item .scroll-columns-list-text .more:hover,
    .scroll-columns-list-swiper-1 .s1-item-2:hover .scroll-columns-list-text .more  {
        color:#ffffff;
        border-color:#06276a;
        background-color:#06276a;
    }

</style>

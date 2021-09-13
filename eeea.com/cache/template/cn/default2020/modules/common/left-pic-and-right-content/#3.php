<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/left-pic-and-right-content/css/style-3.css" rel="stylesheet">
<div class="left-pic-and-right-content-left left-pic-and-right-content-left-3">
    <?php if(is_array(archive(21,0,0,'0,0,0',20,'adddate-desc',1,false,'',1,'','',60,0)))
foreach(archive(21,0,0,'0,0,0',20,'adddate-desc',1,false,'',1,'','',60,0) as $i => $archive) { ?>
    <div class="left-pic-and-right-content-left-img">
        <a title="<?php echo $archive['stitle'];?>" href="<?php echo $archive['url'];?>">
            <img alt="<?php echo $archive['stitle'];?>" cmseasy-id="<?php echo $archive['aid'];?>"   class="cmseasyeditimg lazy" src="<?php echo $archive['thumb'];?>" />
        </a>
    </div>
    <div class="left-pic-and-right-content-left-text">
        <div class="left-pic-and-right-content-item">
            <div class="left-pic-and-right-content-date">
                <h4><?php echo sdate($archive['adddate'],'Y');?></h4>
                <p><?php echo sdate($archive['adddate'],'m-d');?></p>
            </div>
            <div class="left-pic-and-right-content-text">
                <h4>
                    <a title="<?php echo $archive['stitle'];?>" href="<?php echo $archive['url'];?>"  cmseasy-id="<?php echo $archive['aid'];?>"   class="cmseasyedit ">
                        <?php echo $archive['title'];?>
                    </a>
                </h4>
                <p cmseasy-id="<?php echo $archive['aid'];?>"   class="cmseasyedit content ">
                    <?php echo $archive['intro'];?>
                </p>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<style>
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item .left-pic-and-right-content-text h4,
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item .left-pic-and-right-content-text h4 a {
        color:#000000;
        border-color:rgba(255, 255, 255, 0);
        background-color:rgba(255, 255, 255, 0);
        font-size:20px;
        border-radius:0px;
    }
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item .left-pic-and-right-content-text h4 a:hover,
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item:hover .left-pic-and-right-content-text h4 a  {
        color:#000000;
        border-color:rgba(255, 255, 255, 0);
    }
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item .left-pic-and-right-content-text p {
        color:#000000;
        font-size:14px;
    }
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item .left-pic-and-right-content-text p:hover,
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item:hover .left-pic-and-right-content-text p {
        color:#000000;
    }
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item {
        background:$_background-color;
    }
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item:hover {
        background:$_background-hover-color;
    }
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item .left-pic-and-right-content-text2 .more {
        border-radius:$_btn-border-radius;
        color:$_btn-text-color;
        font-size:$_btn-size;
        background:$_btn-background-color;
        border-color:$_btn-border-color;
    }
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item .left-pic-and-right-content-text2 .more:hover,
    .left-pic-and-right-content-left-3 .left-pic-and-right-content-item:hover .left-pic-and-right-content-text2 .more {
        border-radius:$_btn-border-hover-radius;
        color:#333;
        background:$_btn-background-hover-color;
        border-color:$_btn-border-hover-color;
    }
</style>

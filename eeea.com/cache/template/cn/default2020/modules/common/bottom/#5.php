<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/bottom/css/style-5.css" rel="stylesheet">
<div class="foot-ul foot-ul-5 foot-ul-5-5">
    <div class="erweima">
        <?php if(config::get('qrcodes')=='1') { ?>
        <div id="qrcode">
        </div>
        <p>
                                        <span class="cmseasyedit"   >
                                        <?php echo lang('scanning');?>
                                        </span>
            <br />
            <span class="cmseasyedit"   >
                                        <?php echo lang('sitewap');?>
                                        </span>
        </p>
        <?php } ?>
    </div>
</div>


<style type="text/css">
    .foot-ul-5-5 {
        background:rgba(255, 255, 255, 0);
        border-color:rgba(255, 255, 255, 0);
    }
    .foot-ul-5-5:hover {
        background:rgba(255, 255, 255, 0);
        border-color:rgba(255, 255, 255, 0);
    }
    .foot-ul-5-5 p {
        font-size:14px;
        color:#000000;
    }
    .foot-ul-5-5 p:hover {
        color:#000000;
    }
</style>
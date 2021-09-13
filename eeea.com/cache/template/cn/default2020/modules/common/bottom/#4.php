<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<link href="<?php echo $template_path;?>/visual/modules/common/bottom/css/style-4.css" rel="stylesheet">
<div class="foot-ul foot-ul-4 foot-ul-4-4">
    <ul>
        <div class="foot-tel">
            <h4 class="cmseasyedit"   >
                <?php echo lang('servertel');?>
            </h4>
            <p class="cmseasyedit"  >
                <?php echo get('tel');?>
            </p>
        </div>
        <div class="foot-email">
            <h4 class="cmseasyedit"   >
                <?php echo lang('email');?>
            </h4>
            <p class="cmseasyedit"  >
                <?php echo get('email');?>
            </p>
        </div>
    </ul>
</div>

<style type="text/css">
    .foot-ul-4-4 {
        background:rgba(255, 255, 255, 0);
        border-color:rgba(255, 255, 255, 0);
    }
    .foot-ul-4-4:hover {
        background:rgba(255, 255, 255, 0);
        border-color:rgba(255, 255, 255, 0);
    }
    .foot-ul-4-4 h4 {
        font-size:14px;
        color:#000000;
    }
    .foot-ul-4-4:hover h4 {
        color:#000000;
    }
    .foot-ul-4-4 p {
        font-size:14px;
        color:#000000;
    }
    .foot-ul-4-4 p:hover {
        color:#000000;
    }
</style>
<link href="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/common/wap-qr-code/css/style.css" rel="stylesheet">

{if config::get('qrcodes')=='1'}
<div class="wap-qr-code wap-qr-code-$_id">
    <div id="qrcode"></div>
    <p>
        <span class=" cmseasyedit" cmseasy-id="scanning" cmseasy-table="lang" cmseasy-field="template">
        {lang('scanning')}
        </span>
    </p>
    <div class="clearfix"></div>
    <p>
        <span class=" cmseasyedit" cmseasy-id="access" cmseasy-table="lang" cmseasy-field="template">
        {lang('access')}
        </span>
        <span class=" cmseasyedit" cmseasy-id="sitewap" cmseasy-table="lang" cmseasy-field="template">
        {lang('sitewap')}
        </span>
    </p>
</div>
<script type="text/javascript" src="<?php echo $base_url;?>/common/plugins/qrcode/jquery.qrcode.min.js"></script>
<script type="text/javascript">
    <!--
    $(function() {
        $('#qrcode').qrcode({text: window.location.href});
    });
    //-->
</script>
{else}
{lang('not_enabled')}   <a href="http://cms.com/index.php?case=index&act=index&admin_dir=admin&site=default#">
    <?php echo lang_admin('go_open');?>
</a>
{/if}
<style type="text/css">
    .wap-qr-code-$_id {
        font-size:$_p-size;
        color:$_p-color;
        background:$_background-color;
    }
    .wap-qr-code-$_id:hover {
        color:$_p-hover-color;
        background:$_background-hover-color;
    }
    .wap-qr-code-$_id #qrcode {
        width:$_pic-width;
    }
</style>




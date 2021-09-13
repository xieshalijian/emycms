<link href="{$template_path}/visual/modules/common/wap-qr-code/css/style.css" rel="stylesheet">
{if config::get('qrcodes')=='1'}
<div class="erweima">
    <div id="qrcode"></div>
    <p>
        <span>
        {lang('scanning')}
        </span>
    </p>
    <p>
        <span>
        {lang('access')}
        </span>
        <span>
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
{lang_admin('not_enabled')}
{/if}
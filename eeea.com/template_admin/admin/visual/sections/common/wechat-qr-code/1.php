<link href="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/common/wechat-qr-code/css/style.css" rel="stylesheet">


<div class="wechat-qr-code wechat-qr-code-$_id">
    <img src="{get('weixin_pic')}" class="wechat-qr-code-pic">
    <p>
        <span class=" cmseasyedit" cmseasy-id="attention" cmseasy-table="lang" cmseasy-field="template">
        {lang('attention')}
            </span>
    </p>
    <div class="clearfix"></div>
    <p>
            <span class=" cmseasyedit" cmseasy-id="official" cmseasy-table="lang" cmseasy-field="template">
        {lang('official')}
                </span>
                <span class=" cmseasyedit" cmseasy-id="wechat" cmseasy-table="lang" cmseasy-field="template">
        {lang('wechat')}
                    </span>
    </p>
</div>

<style type="text/css">
    .wechat-qr-code-$_id {
        font-size:$_p-size;
        color:$_p-color;
        background:$_background-color;
    }
    .wechat-qr-code-$_id:hover {
        color:$_p-hover-color;
        background:$_background-hover-color;
    }
    .wechat-qr-code-$_id .wechat-qr-code-pic {
        width:$_pic-width;
    }
</style>




<link href="{$template_path}/visual/modules/common/wechat-qr-code/css/style.css" rel="stylesheet">


<div class="erweima erweima-$_id">
    <img src="{get('weixin_pic')}">
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
    .erweima-$_id {
        font-size:$_p-size;
        color:$_p-color;
        background:$_background-color;
    }
    .erweima-$_id:hover {
        color:$_p-hover-color;
        background:$_background-hover-color;
    }
</style>




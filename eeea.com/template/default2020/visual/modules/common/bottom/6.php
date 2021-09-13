<link href="{$template_path}/visual/modules/common/bottom/css/style-6.css" rel="stylesheet">
<div class="foot-ul foot-ul-6 foot-ul-6-$_id">
    <div class="checkout">
        <img src="{get('weixin_pic')}" class="img-responsive cmseasyeditimg" cmseasy-id="weixin_pic" cmseasy-table="config">
        <p>
                                        <span class="cmseasyedit" cmseasy-id="attention" cmseasy-table="lang" cmseasy-field="template">
                                        {langtemplate_attention}
                                            </span>
            <br />
            <span class="cmseasyedit" cmseasy-id="official_wechat" cmseasy-table="lang" cmseasy-field="template">
                                        {langtemplate_official_wechat}
                                        </span>
        </p>
    </div>
</div>

<style type="text/css">
    .foot-ul-6-$_id {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .foot-ul-6-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .foot-ul-6-$_id p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .foot-ul-6-$_id p:hover {
        color:$_p-hover-color;
    }
</style>
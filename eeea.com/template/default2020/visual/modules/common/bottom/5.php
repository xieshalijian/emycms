<link href="{$template_path}/visual/modules/common/bottom/css/style-5.css" rel="stylesheet">
<div class="foot-ul foot-ul-5 foot-ul-5-$_id">
    <div class="erweima">
        {if config::get('qrcodes')=='1'}
        <div id="qrcode">
        </div>
        <p>
                                        <span class="cmseasyedit" cmseasy-id="scanning" cmseasy-table="lang" cmseasy-field="template">
                                        {langtemplate_scanning}
                                        </span>
            <br />
            <span class="cmseasyedit" cmseasy-id="sitewap" cmseasy-table="lang" cmseasy-field="template">
                                        {langtemplate_sitewap}
                                        </span>
        </p>
        {/if}
    </div>
</div>


<style type="text/css">
    .foot-ul-5-$_id {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .foot-ul-5-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .foot-ul-5-$_id p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .foot-ul-5-$_id p:hover {
        color:$_p-hover-color;
    }
</style>
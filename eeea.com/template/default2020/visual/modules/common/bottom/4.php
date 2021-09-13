<link href="{$template_path}/visual/modules/common/bottom/css/style-4.css" rel="stylesheet">
<div class="foot-ul foot-ul-4 foot-ul-4-$_id">
    <ul>
        <div class="foot-tel">
            <h4 class="cmseasyedit" cmseasy-id="servertel" cmseasy-table="lang" cmseasy-field="template">
                {langtemplate_servertel}
            </h4>
            <p class="cmseasyedit" cmseasy-id="tel" cmseasy-table="config">
                {get('tel')}
            </p>
        </div>
        <div class="foot-email">
            <h4 class="cmseasyedit" cmseasy-id="email" cmseasy-table="lang" cmseasy-field="template">
                {langtemplate_email}
            </h4>
            <p class="cmseasyedit" cmseasy-id="email" cmseasy-table="config">
                {get('email')}
            </p>
        </div>
    </ul>
</div>

<style type="text/css">
    .foot-ul-4-$_id {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .foot-ul-4-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .foot-ul-4-$_id h4 {
        font-size:$_title-size;
        color:$_title-color;
    }
    .foot-ul-4-$_id:hover h4 {
        color:$_title-hover-color;
    }
    .foot-ul-4-$_id p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .foot-ul-4-$_id p:hover {
        color:$_p-hover-color;
    }
</style>
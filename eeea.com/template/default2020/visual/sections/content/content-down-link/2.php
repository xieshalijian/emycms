<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-down-link/css/style.css" rel="stylesheet">

<div class="content-downlink content-downlink-$_id">
        {if $archive['attachment_path']}
        {attachment_js($archive['aid'])}
        {else}
        <a class="cmseasyedit" cmseasy-id="nodownload" cmseasy-table="lang" cmseasy-field="template">{lang('nodownload')}</a>
        {/if}
    </div>

<style type="text/css">
    .content-downlink-$_id {
        display:inline-block;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .content-downlink-$_id a {
        font-size:$_btn-size;
        color:$_btn-text-color;

    }
    .content-downlink-$_id:hover,
    .content-downlink-$_id:hover a {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>

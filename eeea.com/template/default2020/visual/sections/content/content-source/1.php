<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-source/css/style.css" rel="stylesheet">

<div class="content-source content-source-$_id">
                <span class="content-source-title cmseasyedit" cmseasy-id="source" cmseasy-table="lang" cmseasy-field="template">
                    {lang('source')}
                </span>
    <span class="content-source-title">
        ：
        </span>
        <span class="cmseasyedit" cmseasy-id="[#$archive['aid']}" cmseasy-table="archive" cmseasy-field="attr3">
                    {$archive['attr3']}
                </span>
    </div>

<style type="text/css">

    .content-source-$_id {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-source-$_id:hover {
        color:$_p-hover-color;
    }
    .content-source-$_id .content-source-title {
        font-size:$_title-size;
        color:$_title-color;
    }
    .content-source-$_id .content-source-title:hover {
        color:$_title-hover-color;
    }
</style>

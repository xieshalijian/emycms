<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-adddate/css/style.css" rel="stylesheet">

<div class="content-adddate content-adddate-$_id">

                <span class="content-adddate-title cmseasyedit" cmseasy-id="adddate" cmseasy-table="lang" cmseasy-field="template">
                    {lang('adddate')}
                </span>
    <span class="content-adddate-title">
    ：
    </span>
        <span cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="adddate" class="cmseasyedit time">
                    {$archive['adddate']}
                </span>
</div>

<style type="text/css">

    .content-adddate-$_id {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-adddate-$_id:hover {
        color:$_p-hover-color;
    }
    .content-adddate-$_id .content-adddate-title {
        font-size:$_title-size;
        color:$_title-color;
    }
    .content-adddate-$_id .content-adddate-title:hover {
        color:$_title-hover-color;
    }
</style>

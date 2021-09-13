<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-special/css/style.css" rel="stylesheet">
<div class="content-special content-special-$_id">
                <span class="content-special-title cmseasyedit" cmseasy-id="subordinate_special" cmseasy-table="lang" cmseasy-field="template">
                    {lang('subordinate_special')}
                </span>
    <span class="content-special-title">
        ：
        </span>
        {$archive['special']}
    </div>

<style type="text/css">

    .content-special-$_id .content-special-title {
        font-size:$_title-size;
        color:$_title-color;
    }
    .content-special-$_id .content-special-title:hover {
        color:$_title-hover-color;
    }
    .content-special-$_id a
    {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .content-special-$_id a:hover
    {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
</style>

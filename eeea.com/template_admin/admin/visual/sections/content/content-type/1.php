<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-type/css/style.css" rel="stylesheet">
<div class="content-type content-type-$_id">

                    <span class="content-type-title cmseasyedit" cmseasy-id="type" cmseasy-table="lang" cmseasy-field="template">
                        {lang('type')}
                    </span>
    <span class="content-type-title">
          ：
    </span>
            {$archive['type']}

    </div>

<style type="text/css">

    .content-type-$_id .content-type-title {
        font-size:$_title-size;
        color:$_title-color;
    }
    .content-type-$_id .content-type-title:hover {
        color:$_title-hover-color;
    }
    .content-type-$_id a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .content-type-$_id a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
</style>
